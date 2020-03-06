<?php
class bestshop_ResmenuSB{
	function __construct(){
		add_filter( 'wp_nav_menu_args' , array( $this , 'bestshop_MenuRes_AdFilter' ), 100 ); 
		add_filter( 'wp_nav_menu_args' , array( $this , 'bestshop_MenuRes_Filter' ), 110 );	
		add_action( 'wp_footer', array( $this, 'bestshop_MenuRes_AdScript' ), 110 );
		add_action( 'wp_footer', array( $this, 'bestshop_responsive_menu_footer' ) );	
	}
	function bestshop_MenuRes_AdScript(){
		$html  = '<script type="text/javascript">';
		$html .= '(function($) {
			/* Responsive Menu */
			$(document).ready(function(){
				$(".bt_menusb").on("click", function(e){					
					var xtarget = $(this).data("target");
					$(xtarget).addClass( "open" );
					$("body").addClass( "resmenu-open" );
					$("body").css( "overflow", "hidden" );
					 event.stopPropagation();
				});
				
				$(".menu-close").on("click", function(){
					$(this).parents( ".menu-responsive-wrapper" ).removeClass( "open" );
					$("body").removeClass( "resmenu-open" ).removeAttr( "style" );
				});	
				
				$( ".show-dropdown" ).each(function(){
					$(this).on("click", function(){
						$(this).toggleClass("show");
						var $element = $(this).parent().find( "> ul" );
						$element.toggle( 300 );
					});
				});		
				
				$("body").on("click", function(e) {			
					var container = $( ".resmenu-container" );
					if ( typeof container != "undefined" && !container.is(e.target) && container.has(e.target).length == 0 ){
						$(".menu-responsive-wrapper").removeClass( "open" );
						$("body").removeClass( "resmenu-open" ).removeAttr( "style" );
					}
				});
					
				$(".respmenu-settings").on("click", function(e){
					e.preventDefault();
					var xtarget = $(this).data("target");
					$(xtarget).toggle();
				});
			});
		})(jQuery);';
		$html .= '</script>';
		echo sprintf( '%s', $html );
	}
	function bestshop_MenuRes_AdFilter( $args ){
		$args['container'] = false;
		$menu = get_registered_nav_menus() ;
		foreach( $menu as $bestshop_theme_locate => $menu_description ){
			if( $bestshop_theme_locate == $args['theme_location'] ){
				if( isset( $args['bestshop_resmenu'] ) && $args['bestshop_resmenu'] == true ) {
					return $args;
				}		
				$ResNavMenu = $this->ResNavMenu( $args );
				$args['container'] = '';
				$args['container_class'].= '';	
				$args['menu_class'].= ($args['menu_class'] == '' ? '' : ' ') . 'bestshop-menures';			
				$args['items_wrap']	= '<ul id="%1$s" class="%2$s">%3$s</ul>'.$ResNavMenu;
			}
		}
		return $args;
	}
	function ResNavMenu( $args ){
		$args['bestshop_resmenu'] = true;		
		$select = wp_nav_menu( $args );
		return $select;
	}
	function bestshop_MenuRes_Filter( $args ){
		/* Fix Menu on wp 4.7 */
		if( !isset( $args['bestshop_resmenu'] ) ){
			return $args;
		}
		$menu = get_registered_nav_menus() ;
		
			if( in_array( $args['theme_location'], array( 'primary_menu', 'vertical_menu' ) ) ){	
				$args['container'] = 'div';
				$args['container_class'].= 'resmenu-container';
				$args['items_wrap']	= '<button class="navbar-toggle bt_menusb" type="button" data-target="#ResMenuSB">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>';
			}
		return $args;
	}
	function bestshop_responsive_menu_footer(){
		$menu_locations = swg_options( 'mobile_menu' );
		if( $menu_locations || has_nav_menu('primary_menu') || has_nav_menu('vertical_menu') ){
	?>	
			<div class="resmenu-container resmenu-container-sidebar">
				<div id="ResMenuSB" class="menu-responsive-wrapper">
					<div class="menu-close"></div>
					<div class="menu-responsive-inner">
						<div class="resmenu-top">
							<?php if( is_active_sidebar( 'search' ) && class_exists( 'sw_woo_search_widget' ) ): ?>
								<?php dynamic_sidebar( 'search' ); ?>
							<?php endif; ?>
							
							<?php if ( is_active_sidebar( 'top-mobile' ) ) : ?>
								<div class="resmenu-top-mobile">
									<a href="#" class="respmenu-settings" data-target="#respmenu_setting_content"><i class="fa fa-cog fa-spin fa-fw"></i></a>
									<div id="respmenu_setting_content">
										<?php dynamic_sidebar( 'top-mobile' ); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<ul class="nav nav-tabs">
							<?php 
								$theme_locations = get_nav_menu_locations();
								$menu_titles = explode( ',', swg_options( 'mobile_menu_title' ) );
								if( !empty( $menu_locations ) && is_array( $menu_locations ) ){
									foreach( $menu_locations as $key => $location ){
										$menu_obj = get_term( $theme_locations[$location], 'nav_menu' );
										$menu_title = ( !empty( $menu_titles ) && isset( $menu_titles[$key] ) && $menu_titles[$key] != '' ) ? $menu_titles[$key] : $menu_obj->name;
										if( $key < 2 ){
							?>
								<li class="<?php echo esc_attr( ( $key == 0 ) ? 'active' : '' ); ?>">
									<a href="<?php echo esc_attr( '#Res'. $location ); ?>" data-toggle="tab"><?php echo esc_html( $menu_title ); ?></a>
								</li>
							<?php }else{ ?>
								<?php if( $key == 2 ) { ?>
									<li class="more-menu">
										<a href="#"><span class="fa fa-ellipsis-v"></span></a>
										<ul class="dropdown">
								<?php } ?>
										<li>
											<a href="<?php echo esc_attr( '#Res'. $location ); ?>" data-toggle="tab"><?php echo esc_html( $menu_title ); ?></a>
										</li>
									<?php if( ( $key+1 ) == count( $menu_locations ) ){?> </ul></li><?php } ?>
							<?php 	} 
								}
							?>
							
							<?php }else{
								$class_p = '';
								$class_v = '';
								if( has_nav_menu('primary_menu') ){
									$class_p = 'active';
								}
								if( !has_nav_menu('primary_menu') && has_nav_menu('vertical_menu') ){
									$class_v = 'active';
								}
							?>
							<?php if( has_nav_menu('primary_menu') ) : ?>
								<li class="<?php echo esc_attr( $class_p ); ?>">
									<a href="#ResPrimary" data-toggle="tab" class="tab-primary"><?php echo esc_html__( 'Menu', 'bestshop' ); ?></a>
								</li>
							<?php endif; ?>
								
							<?php if( has_nav_menu('vertical_menu') ) : ?>
								<li class="<?php echo esc_attr( $class_v ); ?>">
									<a href="#ResVertical" data-toggle="tab" class="tab-vertical"><?php echo esc_html__( 'Categories', 'bestshop' ); ?></a>
								</li>
							<?php endif; ?>
							<?php } ?>
						</ul>
						<div class="tab-content">
							<?php 
								if( !empty( $menu_locations ) && is_array( $menu_locations ) ){
									foreach( $menu_locations as $key => $location ){
							?>
								<div id="<?php echo esc_attr( 'Res'. $location ); ?>" class="tab-pane <?php echo esc_attr( ( $key == 0 ) ? 'active' : '' ); ?>">
									<?php 
										wp_nav_menu( array(
											'theme_location'   => $location,
											'walker' => new bestshop_ResMenu_Walker()
										) );
									?>
								</div>
							<?php }
								}else{
							?>
								<?php if( has_nav_menu('primary_menu') ) : ?>
								<div id="ResPrimary" class="tab-pane <?php echo esc_attr( $class_p ); ?>">
									<?php 
										wp_nav_menu( array(
											'theme_location'   => 'primary_menu',
											'walker' => new bestshop_ResMenu_Walker()
										) );
									?>
								</div>
								<?php endif; ?>
								
								<?php if( has_nav_menu('vertical_menu') ) : ?>
								<div id="ResVertical" class="tab-pane <?php echo esc_attr( $class_v ); ?>">
									<?php 
										wp_nav_menu( array(
											'theme_location'   => 'vertical_menu',
											'walker' => new bestshop_ResMenu_Walker()
										) );
									?>
								</div>
								<?php endif; ?>
							<?php } ?>
						</div>				
					</div>
				</div>
			</div>
<?php 	
		}
	}
}
class Bestshop_ResMenu_Walker extends Walker_Nav_Menu {
	function check_current($classes) {
		return preg_match('/(current[-_])|active|dropdown/', $classes);
	}

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ul class=\"dropdown-resmenu\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$item_html = '';
		parent::start_el($item_html, $item, $depth, $args);
		if( isset( $item->imgupload ) && !empty( $item->imgupload ) ){
			if( $depth == 0 ){
				$item_html = preg_replace( '/(<a[^>]*>)(.*)(<\/a>)/iU', '$1<span class="menu-img"><img src="'.esc_url( $item->imgupload ).'" alt="'. esc_attr__( 'Thumbnail', 'bestshop' ) .'"/></span><span class="menu-title">$2</span>$3', $item_html );
			}
		}
		if( !$item->is_dropdown && ($depth === 0) ){
			$item_html = str_replace('<a', '<a class="item-link"', $item_html);			
			$item_html = str_replace('</a>', '</a>', $item_html);
		}
		if ( $item->is_dropdown ) {
			$item_html = str_replace('<a', '<a class="item-link dropdown-toggle"', $item_html);
			$item_html = str_replace('</a>', '</a>', $item_html);
			$item_html .= '<span class="show-dropdown"></span>';
		}
		$output .= $item_html;
	}

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$element->is_dropdown = !empty($children_elements[$element->ID]);
		if ($element->is_dropdown) {			
			$element->classes[] = 'res-dropdown';
		}
		if( $element -> imgupload ){
			$element->classes[] = 'has-img';
		}
		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}
new bestshop_ResmenuSB();