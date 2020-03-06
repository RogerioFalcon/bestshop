<?php

if ( ! class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Product Categories Widget.
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class Custom_WC_Widget_Product_Categories extends WC_Widget {

	/**
	 * Category ancestors.
	 *
	 * @var array
	 */
	public $cat_ancestors;

	/**
	 * Current Category.
	 *
	 * @var bool
	 */
	public $current_cat;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_product_categories';
		$this->widget_description = esc_html__( 'A list or dropdown of product categories.', 'bestshop' );
		$this->widget_id          = 'woocommerce_product_categories';
		$this->widget_name        = esc_html__( 'WooCommerce product categories', 'bestshop' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Product categories', 'bestshop' ),
				'label' => esc_html__( 'Title', 'bestshop' ),
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'name',
				'label' => esc_html__( 'Order by', 'bestshop' ),
				'options' => array(
					'order' => esc_html__( 'Category order', 'bestshop' ),
					'name'  => esc_html__( 'Name', 'bestshop' ),
				),
			),
			'dropdown' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => esc_html__( 'Show as dropdown', 'bestshop' ),
			),
			'count' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => esc_html__( 'Show product counts', 'bestshop' ),
			),
			'hierarchical' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => esc_html__( 'Show hierarchy', 'bestshop' ),
			),
			'show_children_only' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => esc_html__( 'Only show children of the current category', 'bestshop' ),
			),
			'hide_empty' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => esc_html__( 'Hide empty categories', 'bestshop' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		global $wp_query, $post;

		$count              = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
		$hierarchical       = isset( $instance['hierarchical'] ) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
		$show_children_only = isset( $instance['show_children_only'] ) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
		$dropdown           = isset( $instance['dropdown'] ) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
		$orderby            = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];
		$hide_empty         = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
		$dropdown_args      = array( 'hide_empty' => $hide_empty );
		$list_args          = array( 'show_count' => $count, 'hierarchical' => $hierarchical, 'taxonomy' => 'product_cat', 'hide_empty' => $hide_empty );
		
		// Menu Order
		$list_args['menu_order'] = false;
		if ( 'order' === $orderby ) {
			$list_args['menu_order'] = 'asc';
		} else {
			$list_args['orderby']    = 'title';
		}

		// Setup Current Category
		$this->current_cat   = false;
		$this->cat_ancestors = array();

		if ( is_tax( 'product_cat' ) ) {

			$this->current_cat   = $wp_query->queried_object;
			$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );

		} elseif ( is_singular( 'product' ) ) {

			$product_category = wc_get_product_terms( $post->ID, 'product_cat', apply_filters( 'woocommerce_product_categories_widget_product_terms_args', array( 'orderby' => 'parent' ) ) );

			if ( ! empty( $product_category ) ) {
				$this->current_cat   = end( $product_category );
				$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
			}
		}

		// Show Siblings and Children Only
		if ( $show_children_only && $this->current_cat ) {

			// Top level is needed
			$top_level = get_terms(
				'product_cat',
				array(
					'fields'       => 'ids',
					'parent'       => 0,
					'hierarchical' => true,
					'hide_empty'   => false,
				)
			);

			// Direct children are wanted
			$direct_children = get_terms(
				'product_cat',
				array(
					'fields'       => 'ids',
					'parent'       => $this->current_cat->term_id,
					'hierarchical' => true,
					'hide_empty'   => false,
				)
			);

			// Gather siblings of ancestors
			$siblings  = array();
			if ( $this->cat_ancestors ) {
				foreach ( $this->cat_ancestors as $ancestor ) {
					$ancestor_siblings = get_terms(
						'product_cat',
						array(
							'fields'       => 'ids',
							'parent'       => $ancestor,
							'hierarchical' => false,
							'hide_empty'   => false,
						)
					);
					$siblings = array_merge( $siblings, $ancestor_siblings );
				}
			}

			if ( $hierarchical ) {
				$include = array_merge( $top_level, $this->cat_ancestors, $siblings, $direct_children, array( $this->current_cat->term_id ) );
			} else {
				$include = array_merge( $direct_children );
			}

			$dropdown_args['include'] = implode( ',', $include );
			$list_args['include']     = implode( ',', $include );

			if ( empty( $include ) ) {
				return;
			}
		} elseif ( $show_children_only ) {
			$dropdown_args['depth']        = 1;
			$dropdown_args['child_of']     = 0;
			$dropdown_args['hierarchical'] = 1;
			$list_args['depth']            = 1;
			$list_args['child_of']         = 0;
			$list_args['hierarchical']     = 1;
		}

		$this->widget_start( $args, $instance );

		// Dropdown
		if ( $dropdown ) {
			$dropdown_defaults = array(
				'show_count'         => $count,
				'hierarchical'       => $hierarchical,
				'show_uncategorized' => 0,
				'orderby'            => $orderby,
				'selected'           => $this->current_cat ? $this->current_cat->slug : '',
			);
			$dropdown_args = wp_parse_args( $dropdown_args, $dropdown_defaults );

			// Stuck with this until a fix for https://core.trac.wordpress.org/ticket/13258
			wc_product_dropdown_categories( apply_filters( 'woocommerce_product_categories_widget_dropdown_args', $dropdown_args ) );

			wc_enqueue_js( "
				jQuery( '.dropdown_product_cat' ).change( function() {
					if ( jQuery(this).val() != '' ) {
						var this_page = '';
						var home_url  = '" . esc_js( home_url( '/' ) ) . "';
						if ( home_url.indexOf( '?' ) > 0 ) {
							this_page = home_url + '&product_cat=' + jQuery(this).val();
						} else {
							this_page = home_url + '?product_cat=' + jQuery(this).val();
						}
						location.href = this_page;
					}
				});
			" );

		// List
		} else {
			$bestshop_pnumber_item 	= ( swg_options( 'product_number_item' ) ) ? swg_options( 'product_number_item' ) : 0;
			$bestshop_pmore_text 		= ( swg_options( 'product_more_text' ) )	  ? swg_options( 'product_more_text' )		: esc_html__( 'See More', 'bestshop' );
			$bestshop_pless_text 		= ( swg_options( 'product_less_text' ) )	  ? swg_options( 'product_less_text' )		: esc_html__( 'See Less', 'bestshop' );
			
			include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

			$list_args['walker']                     = new WC_Product_Cat_List_Walker;
			$list_args['title_li']                   = '';
			$list_args['pad_counts']                 = 1;
			$list_args['show_option_none']           = esc_html__( 'No product categories exist.', 'bestshop' );
			$list_args['current_category']           = ( $this->current_cat ) ? $this->current_cat->term_id : '';
			$list_args['current_category_ancestors'] = $this->cat_ancestors;

			echo '<ul class="product-categories"  data-number="'. esc_attr( $bestshop_pnumber_item ) .'" data-moretext="'. esc_attr( $bestshop_pmore_text ) .'" data-lesstext="'. esc_attr( $bestshop_pless_text ) .'">';

			wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $list_args ) );

			echo '</ul>';
		}

		$this->widget_end( $args );
	}
}
