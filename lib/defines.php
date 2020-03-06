<?php
$lib_dir = trailingslashit( str_replace( '\\', '/', get_template_directory() . '/lib/' ) );

if( !defined('BESTSHOP_DIR') ){
	define( 'BESTSHOP_DIR', $lib_dir );
}

if( !defined('BESTSHOP_URL') ){
	define( 'BESTSHOP_URL', trailingslashit( get_template_directory_uri() ) . 'lib' );
}

if (!isset($content_width)) { $content_width = 940; }

define("BESTSHOP_PRODUCT_TYPE","product");
define("BESTSHOP_PRODUCT_DETAIL_TYPE","product_detail");

if ( !defined('SWG_THEME') ){
	define( 'SWG_THEME', 'bestshop_theme' );
}

require_once( get_template_directory().'/lib/options.php' );

if( class_exists( 'SWG_Options' ) ) :
	function bestshop_Options_Setup(){
		global $swg_options, $options, $options_args;

		$options = array();
		$options[] = array(
			'title' => esc_html__('General', 'bestshop'),
			'desc' => wp_kses( __('<p class="description">The theme allows to build your own styles right out of the backend without any coding knowledge. Upload new logo and favicon or get their URL.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bestshop for default.
			'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_019_cogwheel.png',
			//Lets leave this as a bestshop section, no options just some intro text set above.
			'fields' => array(	

				array(
					'id' => 'sitelogo',
					'type' => 'upload',
					'title' => esc_html__('Logo Image', 'bestshop'),
					'sub_desc' => esc_html__( 'Use the Upload button to upload the new logo and get URL of the logo', 'bestshop' ),
					'std' => get_template_directory_uri().'/assets/img/logo-default.png'
				),

				array(
					'id' => 'favicon',
					'type' => 'upload',
					'title' => esc_html__('Favicon', 'bestshop'),
					'sub_desc' => esc_html__( 'Use the Upload button to upload the custom favicon', 'bestshop' ),
					'std' => ''
				),

				array(
					'id' => 'tax_select',
					'type' => 'multi_select_taxonomy',
					'title' => esc_html__('Select Taxonomy', 'bestshop'),
					'sub_desc' => esc_html__( 'Select taxonomy to show custom term metabox', 'bestshop' ),
				),

				array(
					'id' => 'title_length',
					'type' => 'text',
					'title' => esc_html__('Title Length Of Item Listing Page', 'bestshop'),
					'sub_desc' => esc_html__( 'Choose title length if you want to trim word, leave 0 to not trim word', 'bestshop' ),
					'std' => 0
				),

				array(
					'id' => 'page_404',
					'type' => 'pages_select',
					'title' => esc_html__('404 Page Content', 'bestshop'),
					'sub_desc' => esc_html__('Select page 404 content', 'bestshop'),
					'std' => ''
				),
			)		
		);

		$options[] = array(
			'title' => esc_html__('Schemes', 'bestshop'),
			'desc' => wp_kses( __('<p class="description">Custom color scheme for theme. Unlimited color that you can choose.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bestshop for default.
			'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_163_iphone.png',
			//Lets leave this as a bestshop section, no options just some intro text set above.
			'fields' => array(
				array(
					'id' => 'scheme',
					'type' => 'radio_img',
					'title' => esc_html__('Color Scheme', 'bestshop'),
					'sub_desc' => esc_html__( 'Select one of 2 predefined schemes', 'bestshop' ),
					'desc' => '',
					'options' => array(
						'default' => array('title' => 'Default', 'img' => get_template_directory_uri().'/assets/img/default.png'),
						'red' => array('title' => 'Red', 'img' => get_template_directory_uri().'/assets/img/red.png'),
						'blue' => array('title' => 'Blue', 'img' => get_template_directory_uri().'/assets/img/blue.png'),
						'pink' => array('title' => 'Pink', 'img' => get_template_directory_uri().'/assets/img/pink.png'),
						'pink2' => array('title' => 'Pink2', 'img' => get_template_directory_uri().'/assets/img/pink2.png'),
						), //Must provide key => value(array:title|img) pairs for radio options
					'std' => 'default'
				),
				
				array(
					'id' => 'custom_color',
					'title' => esc_html__( 'Enable Custom Color', 'bestshop' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Check this field to enable custom color and when you update your theme, custom color will not lose.', 'bestshop' ),
					'desc' => '',
					'std' => '0'
				),

				array(
					'id' => 'developer_mode',
					'title' => esc_html__( 'Developer Mode', 'bestshop' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Turn on/off compile less to css and custom color', 'bestshop' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
					'id' => 'scheme_color',
					'type' => 'color',
					'title' => esc_html__('Color', 'bestshop'),
					'sub_desc' => esc_html__('Select main custom color.', 'bestshop'),
					'std' => ''
				),

			)
		);

		$options[] = array(
			'title' => esc_html__('Layout', 'bestshop'),
			'desc' => wp_kses( __('<p class="description">WpThemeGo Framework comes with a layout setting that allows you to build any number of stunning layouts and apply theme to your entries.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bestshop for default.
			'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_319_sort.png',
			//Lets leave this as a bestshop section, no options just some intro text set above.
			'fields' => array(
				array(
					'id' => 'layout',
					'type' => 'select',
					'title' => esc_html__('Box Layout', 'bestshop'),
					'sub_desc' => esc_html__( 'Select Layout Box or Wide, Sidebar', 'bestshop' ),
					'options' => array(
						'full' => esc_html__( 'Wide', 'bestshop' ),
						'wide' => esc_html__( 'Wide 1600', 'bestshop' ),
						'boxed' => esc_html__( 'Boxed', 'bestshop' ),
						'layout-sidebar' => esc_html__( 'Sidebar', 'bestshop' )
					),
					'std' => 'full'
				),
				
				array(
					'id' => 'bg_box_img',
					'type' => 'upload',
					'title' => esc_html__('Background Box Image', 'bestshop'),
					'sub_desc' => '',
					'std' => ''
				),
				array(
					'id' => 'sidebar_left_expand',
					'type' => 'select',
					'title' => esc_html__('Left Sidebar Expand', 'bestshop'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12', 
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '3',
					'sub_desc' => esc_html__( 'Select width of left sidebar.', 'bestshop' ),
				),

				array(
					'id' => 'sidebar_right_expand',
					'type' => 'select',
					'title' => esc_html__('Right Sidebar Expand', 'bestshop'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '3',
					'sub_desc' => esc_html__( 'Select width of right sidebar medium desktop.', 'bestshop' ),
				),
				array(
					'id' => 'sidebar_left_expand_md',
					'type' => 'select',
					'title' => esc_html__('Left Sidebar Medium Desktop Expand', 'bestshop'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select width of left sidebar medium desktop.', 'bestshop' ),
				),
				array(
					'id' => 'sidebar_right_expand_md',
					'type' => 'select',
					'title' => esc_html__('Right Sidebar Medium Desktop Expand', 'bestshop'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select width of right sidebar.', 'bestshop' ),
				),
				array(
					'id' => 'sidebar_left_expand_sm',
					'type' => 'select',
					'title' => esc_html__('Left Sidebar Tablet Expand', 'bestshop'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select width of left sidebar tablet.', 'bestshop' ),
				),
				array(
					'id' => 'sidebar_right_expand_sm',
					'type' => 'select',
					'title' => esc_html__('Right Sidebar Tablet Expand', 'bestshop'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select width of right sidebar tablet.', 'bestshop' ),
				),				
			)
		);


$options[] = array(
	'title' => esc_html__('Header & Footer', 'bestshop'),
	'desc' => wp_kses( __('<p class="description">WpThemeGo Framework comes with a header and footer setting that allows you to build style header.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bestshop for default.
	'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_336_read_it_later.png',
			//Lets leave this as a bestshop section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'header_style',
			'type' => 'select',
			'title' => esc_html__('Header Style', 'bestshop'),
			'sub_desc' => esc_html__('Select Header style', 'bestshop'),
			'options' => array(
				'style1'  => esc_html__( 'Header Style 1', 'bestshop' ),
				'style2'  => esc_html__( 'Header Style 2', 'bestshop' ),
				'style3'  => esc_html__( 'Header Style 3', 'bestshop' ),
				'style4'  => esc_html__( 'Header Style 4', 'bestshop' ),
				'style5'  => esc_html__( 'Header Style 5', 'bestshop' ),
			),
			'std' => 'style1'
		),

		array(
			'id' => 'disable_search',
			'title' => esc_html__( 'Disable Search', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Check this to disable search on header', 'bestshop' ),
			'desc' => '',
			'std' => '0'
		),

		array(
			'id' => 'disable_cart',
			'title' => esc_html__( 'Disable Cart', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Check this to disable cart on header', 'bestshop' ),
			'desc' => '',
			'std' => '0'
		),				

		array(
			'id' => 'footer_style',
			'type' => 'pages_select',
			'title' => esc_html__('Footer Style', 'bestshop'),
			'sub_desc' => esc_html__('Select Footer style', 'bestshop'),
			'std' => ''
		),

		array(
			'id' => 'copyright_style',
			'type' => 'select',
			'title' => esc_html__('Copyright Style', 'bestshop'),
			'sub_desc' => esc_html__('Select Copyright style', 'bestshop'),
			'options' => array(
				'default'  => esc_html__( 'Default', 'bestshop' ),
				'style1'  => esc_html__( 'Style1', 'bestshop' ),
				'style2'  => esc_html__( 'Style2', 'bestshop' ),
				'style3'  => esc_html__( 'Style3', 'bestshop' ),
			),
			'std' => 'default'
		),

		array(
			'id' => 'footer_copyright',
			'type' => 'editor',
			'sub_desc' => '',
			'title' => esc_html__( 'Copyright text', 'bestshop' )
		),	

	)
);
$options[] = array(
	'title' => esc_html__('Navbar Options', 'bestshop'),
	'desc' => wp_kses( __('<p class="description">If you got a big site with a lot of sub menus we recommend using a mega menu. Just select the dropbox to display a menu as mega menu or dropdown menu.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bestshop for default.
	'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_157_show_lines.png',
			//Lets leave this as a bestshop section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'info_typon1',
			'type' => 'info',
			'title' => esc_html__( 'Navbar Menu General Config', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'menu_type',
			'type' => 'select',
			'title' => esc_html__('Menu Type', 'bestshop'),
			'options' => array( 
				'dropdown' => esc_html__( 'Dropdown Menu', 'bestshop' ), 
				'mega' => esc_html__( 'Mega Menu', 'bestshop' ) 
			),
			'std' => 'mega'
		),	

		array(
			'id' => 'menu_location',
			'type' => 'menu_location_multi_select',
			'title' => esc_html__('Mega Menu Location', 'bestshop'),
			'sub_desc' => esc_html__( 'Select theme location to active mega menu.', 'bestshop' ),
			'std' => 'primary_menu'
		),		

		array(
			'id' => 'sticky_menu',
			'type' => 'checkbox',
			'title' => esc_html__('Active sticky menu', 'bestshop'),
			'sub_desc' => '',
			'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),

		array(
			'id' => 'more_menu',
			'type' => 'checkbox',
			'title' => esc_html__('Active More Menu', 'bestshop'),
			'sub_desc' => esc_html__('Active more menu if your primary menu is too long', 'bestshop'),
			'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),

		array(
			'id' => 'menu_event',
			'type' => 'select',
			'title' => esc_html__('Menu Event', 'bestshop'),
			'options' => array( 
				'' 		=> esc_html__( 'Hover Event', 'bestshop' ), 
				'click' => esc_html__( 'Click Event', 'bestshop' ) 
			),
			'std' => ''
		),

		array(
			'id' => 'menu_number_item',
			'type' => 'text',
			'title' => esc_html__( 'Number Item Vertical', 'bestshop' ),
			'sub_desc' => esc_html__( 'Number item vertical to show', 'bestshop' ),
			'std' => 8
		),	

		array(
			'id' => 'menu_title_text',
			'type' => 'text',
			'title' => esc_html__('Vertical Title Text', 'bestshop'),
			'sub_desc' => esc_html__( 'Change title text on vertical menu', 'bestshop' ),
			'std' => ''
		),

		array(
			'id' => 'menu_more_text',
			'type' => 'text',
			'title' => esc_html__('Vertical More Text', 'bestshop'),
			'sub_desc' => esc_html__( 'Change more text on vertical menu', 'bestshop' ),
			'std' => ''
		),
		
		array(
			'id' => 'menu_less_text',
			'type' => 'text',
			'title' => esc_html__('Vertical Less Text', 'bestshop'),
			'sub_desc' => esc_html__( 'Change less text on vertical menu', 'bestshop' ),
			'std' => ''
		),

		array(
			'id' => 'info_typon2',
			'type' => 'info',
			'title' => esc_html__( 'Responsive Menu Config', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'mobile_menu',
			'type' => 'menu_location_multi_select',
			'title' => esc_html__('Mobile & Responsive Menu Location', 'bestshop'),
			'sub_desc' => esc_html__( 'Select theme location to active mobile menu.', 'bestshop' ),
			'std' => 'primary_menu'
		),

		array(
			'id' => 'mobile_menu_title',
			'type' => 'text',
			'title' => esc_html__('Mobile Menu Title', 'bestshop'),
			'sub_desc' => esc_html__( 'Change title heading of menu responsive. If there are many menu, each title separated by commas.', 'bestshop' ),
			'std' => ''
		),

	)
);
$options[] = array(
	'title' => esc_html__('Blog Options', 'bestshop'),
	'desc' => wp_kses( __('<p class="description">Select layout in blog listing page.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it bestshop for default.
	'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_071_book.png',
		//Lets leave this as a bestshop section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'sidebar_blog',
			'type' => 'select',
			'title' => esc_html__('Sidebar Blog Layout', 'bestshop'),
			'options' => array(
				'full' 	=> esc_html__( 'Full Layout', 'bestshop' ),		
				'left'	=> esc_html__( 'Left Sidebar', 'bestshop' ),
				'right' => esc_html__( 'Right Sidebar', 'bestshop' ),
			),
			'std' => 'left',
			'sub_desc' => esc_html__( 'Select style sidebar blog', 'bestshop' ),
		),
		array(
			'id' => 'blog_layout',
			'type' => 'select',
			'title' => esc_html__('Layout blog', 'bestshop'),
			'options' => array(
				'list'	=>  esc_html__( 'List Layout', 'bestshop' ),
				'list2'	=>  esc_html__( 'List Layout2', 'bestshop' ),
				'grid' 	=>  esc_html__( 'Grid Layout', 'bestshop' )								
			),
			'std' => 'list',
			'sub_desc' => esc_html__( 'Select style layout blog', 'bestshop' ),
		),
		array(
			'id' => 'blog_column',
			'type' => 'select',
			'title' => esc_html__('Blog column', 'bestshop'),
			'options' => array(								
				'2' =>  esc_html__( '2 Columns', 'bestshop' ),
				'3' =>  esc_html__( '3 Columns', 'bestshop' ),
				'4' =>  esc_html__( '4 Columns', 'bestshop' )								
			),
			'std' => '2',
			'sub_desc' => esc_html__( 'Select style number column blog', 'bestshop' ),
		),
	)
);	
$options[] = array(
	'title' => esc_html__('Product Options', 'bestshop'),
	'desc' => wp_kses( __('<p class="description">Select layout in product listing page.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it bestshop for default.
	'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_202_shopping_cart.png',
		//Lets leave this as a bestshop section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Product Categories Config', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'product_colcat_large',
			'type' => 'select',
			'title' => esc_html__('Product Category Listing column Desktop', 'bestshop'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',							
			),
			'std' => '4',
			'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'bestshop' ),
		),

		array(
			'id' => 'product_colcat_medium',
			'type' => 'select',
			'title' => esc_html__('Product Listing Category column Medium Desktop', 'bestshop'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',	
				'5' => '5',
				'6' => '6',
			),
			'std' => '3',
			'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'bestshop' ),
		),

		array(
			'id' => 'product_colcat_sm',
			'type' => 'select',
			'title' => esc_html__('Product Listing Category column Tablet', 'bestshop'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',	
				'5' => '5',
				'6' => '6'
			),
			'std' => '2',
			'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'bestshop' ),
		),

		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Product General Config', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'product_banner',
			'title' => esc_html__( 'Select Banner', 'bestshop' ),
			'type' => 'select',
			'sub_desc' => '',
			'options' => array(
				'' 			=> esc_html__( 'Use Banner', 'bestshop' ),
				'listing' 	=> esc_html__( 'Use Category Product Image', 'bestshop' ),
			),
			'std' => '',
		),

		array(
			'id' => 'product_listing_banner',
			'type' => 'upload',
			'title' => esc_html__('Listing Banner Product', 'bestshop'),
			'sub_desc' => esc_html__( 'Use the Upload button to upload banner product listing', 'bestshop' ),
			'std' => get_template_directory_uri().'/assets/img/listing-banner.jpg'
		),

		array(
			'id' => 'product_col_large',
			'type' => 'select',
			'title' => esc_html__('Product Listing column Desktop', 'bestshop'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',							
			),
			'std' => '3',
			'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'bestshop' ),
		),

		array(
			'id' => 'product_col_medium',
			'type' => 'select',
			'title' => esc_html__('Product Listing column Medium Desktop', 'bestshop'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',	
				'5' => '5',
				'6' => '6',
			),
			'std' => '2',
			'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'bestshop' ),
		),

		array(
			'id' => 'product_col_sm',
			'type' => 'select',
			'title' => esc_html__('Product Listing column Tablet', 'bestshop'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',	
				'5' => '5',
				'6' => '6'
			),
			'std' => '2',
			'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'bestshop' ),
		),

		array(
			'id' => 'sidebar_product',
			'type' => 'select',
			'title' => esc_html__('Sidebar Product Layout', 'bestshop'),
			'options' => array(
				'left'	=> esc_html__( 'Left Sidebar', 'bestshop' ),
				'full' 	=> esc_html__( 'Full Layout', 'bestshop' ),		
				'right' => esc_html__( 'Right Sidebar', 'bestshop' )
			),
			'std' => 'left',
			'sub_desc' => esc_html__( 'Select style sidebar product', 'bestshop' ),
		),

		array(
			'id' => 'product_quickview',
			'title' => esc_html__( 'Quickview', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off Product Quickview', 'bestshop' ),
			'std' => '1'
		),

		array(
			'id' => 'product_listing_countdown',
			'title' => esc_html__( 'Enable Countdown', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off Product Countdown on product listing', 'bestshop' ),
			'std' => '1'
		),

		array(
			'id' => 'product_soldout',
			'title' => esc_html__( 'Product Sold Out', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off product sold out label', 'bestshop' ),
			'std' => '1'
		),


		array(
			'id' => 'product_number',
			'type' => 'text',
			'title' => esc_html__('Product Listing Number', 'bestshop'),
			'sub_desc' => esc_html__( 'Show number of product in listing product page.', 'bestshop' ),
			'std' => 12
		),

		array(
			'id' => 'newproduct_time',
			'title' => esc_html__( 'New Product', 'bestshop' ),
			'type' => 'number',
			'sub_desc' => '',
			'desc' => esc_html__( 'Set day for the new product label from the date publish product.', 'bestshop' ),
			'std' => '1'
		),

		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Product Single Config', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'sidebar_product_detail',
			'type' => 'select',
			'title' => esc_html__('Sidebar Product Single Layout', 'bestshop'),
			'options' => array(
				'left'	=> esc_html__( 'Left Sidebar', 'bestshop' ),
				'full' 	=> esc_html__( 'Full Layout', 'bestshop' ),		
				'right' => esc_html__( 'Right Sidebar', 'bestshop' )
			),
			'std' => 'left',
			'sub_desc' => esc_html__( 'Select style sidebar product single', 'bestshop' ),
		),

		array(
			'id' => 'product_single_style',
			'type' => 'select',
			'title' => esc_html__('Product Detail Style', 'bestshop'),
			'options' => array(
				'default'	=> esc_html__( 'Default', 'bestshop' ),
				'style1' 	=> esc_html__( 'Full Width', 'bestshop' ),	
				'style2' 	=> esc_html__( 'Full Width With Accordion', 'bestshop' ),	
				'style3' 	=> esc_html__( 'Full Width With Accordion 1', 'bestshop' ),	
			),
			'std' => 'default',
			'sub_desc' => esc_html__( 'Select style for product single', 'bestshop' ),
		),

		array(
			'id' => 'product_single_thumbnail',
			'type' => 'select',
			'title' => esc_html__('Product Thumbnail Position', 'bestshop'),
			'options' => array(
				'bottom'	=> esc_html__( 'Bottom', 'bestshop' ),
				'left' 		=> esc_html__( 'Left', 'bestshop' ),	
				'right' 	=> esc_html__( 'Right', 'bestshop' ),	
				'top' 		=> esc_html__( 'Top', 'bestshop' ),					
			),
			'std' => 'bottom',
			'sub_desc' => esc_html__( 'Select style for product single thumbnail', 'bestshop' ),
		),		


		array(
			'id' => 'product_zoom',
			'title' => esc_html__( 'Product Zoom', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off image zoom when hover on single product', 'bestshop' ),
			'std' => '1'
		),

		array(
			'id' => 'product_brand',
			'title' => esc_html__( 'Enable Product Brand Image', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off product brand image show on single product.', 'bestshop' ),
			'std' => '1'
		),

		array(
			'id' => 'product_single_countdown',
			'title' => esc_html__( 'Enable Countdown Single', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off Product Countdown on product single', 'bestshop' ),
			'std' => '1'
		),

		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Config For Product Categories Widget', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'product_number_item',
			'type' => 'text',
			'title' => esc_html__( 'Category Number Item Show', 'bestshop' ),
			'sub_desc' => esc_html__( 'Choose to number of item category that you want to show, leave 0 to show all category', 'bestshop' ),
			'std' => 8
		),	

		array(
			'id' => 'product_more_text',
			'type' => 'text',
			'title' => esc_html__( 'Category More Text', 'bestshop' ),
			'sub_desc' => esc_html__( 'Change more text on category product', 'bestshop' ),
			'std' => ''
		),

		array(
			'id' => 'product_less_text',
			'type' => 'text',
			'title' => esc_html__( 'Category Less Text', 'bestshop' ),
			'sub_desc' => esc_html__( 'Change less text on category product', 'bestshop' ),
			'std' => ''
		)	
	)
);		
$options[] = array(
	'title' => esc_html__('Typography', 'bestshop'),
	'desc' => wp_kses( __('<p class="description">Change the font style of your blog, custom with Google Font.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bestshop for default.
	'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_151_edit.png',
			//Lets leave this as a bestshop section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Global Typography', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'google_webfonts',
			'type' => 'google_webfonts',
			'title' => esc_html__('Use Google Webfont', 'bestshop'),
			'sub_desc' => esc_html__( 'Insert font style that you actually need on your webpage.', 'bestshop' ), 
			'std' => ''
		),

		array(
			'id' => 'webfonts_weight',
			'type' => 'multi_select',
			'sub_desc' => esc_html__( 'For weight, see Google Fonts to custom for each font style.', 'bestshop' ),
			'title' => esc_html__('Webfont Weight', 'bestshop'),
			'options' => array(
				'100' => '100',
				'200' => '200',
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'600' => '600',
				'700' => '700',
				'800' => '800',
				'900' => '900'
			),
			'std' => ''
		),

		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html__( 'Header Tag Typography', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'header_tag_font',
			'type' => 'google_webfonts',
			'title' => esc_html__('Header Tag Font', 'bestshop'),
			'sub_desc' => esc_html__( 'Select custom font for header tag ( h1...h6 )', 'bestshop' ), 
			'std' => ''
		),

		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html__( 'Main Menu Typography', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'menu_font',
			'type' => 'google_webfonts',
			'title' => esc_html__('Main Menu Font', 'bestshop'),
			'sub_desc' => esc_html__( 'Select custom font for main menu', 'bestshop' ), 
			'std' => ''
		),

		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html__( 'Custom Typography', 'bestshop' ),
			'desc' => '',
			'class' => 'bestshop-opt-info'
		),

		array(
			'id' => 'custom_font',
			'type' => 'google_webfonts',
			'title' => esc_html__('Custom Font', 'bestshop'),
			'sub_desc' => esc_html__( 'Select custom font for custom class', 'bestshop' ), 
			'std' => ''
		),

		array(
			'id' => 'custom_font_class',
			'title' => esc_html__( 'Custom Font Class', 'bestshop' ),
			'type' => 'text',
			'sub_desc' => esc_html__( 'Put custom class to this field. Each class separated by commas.', 'bestshop' ),
			'desc' => '',
			'std' => '',
		),

	)
);

$options[] = array(
	'title' => __('Social', 'bestshop'),
	'desc' => wp_kses( __('<p class="description">This feature allow to you link to your social.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
	'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_222_share.png',
		//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'social-share-fb',
			'title' => esc_html__( 'Facebook', 'bestshop' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-tw',
			'title' => esc_html__( 'Twitter', 'bestshop' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-tumblr',
			'title' => esc_html__( 'Tumblr', 'bestshop' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-in',
			'title' => esc_html__( 'Linkedin', 'bestshop' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-instagram',
			'title' => esc_html__( 'Instagram', 'bestshop' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-pi',
			'title' => esc_html__( 'Pinterest', 'bestshop' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		)

	)
);

$options[] = array(
	'title' => esc_html__('Popup Config', 'bestshop'),
	'desc' => wp_kses( __('<p class="description">Enable popup and more config for Popup.</p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bestshop for default.
	'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_318_more-items.png',
			//Lets leave this as a bestshop section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'popup_active',
			'type' => 'checkbox',
			'title' => esc_html__( 'Active Popup Subscribe', 'bestshop' ),
			'sub_desc' => esc_html__( 'Check to active popup subscribe', 'bestshop' ),
			'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),	

		array(
			'id' => 'popup_background',
			'title' => esc_html__( 'Popup Background', 'bestshop' ),
			'type' => 'upload',
			'sub_desc' => esc_html__( 'Choose popup background image', 'bestshop' ),
			'desc' => '',
			'std' => get_template_directory_uri().'/assets/img/popup/bg-main.jpg'
		),

		array(
			'id' => 'popup_content',
			'title' => esc_html__( 'Popup Content', 'bestshop' ),
			'type' => 'editor',
			'sub_desc' => esc_html__( 'Change text of popup mode', 'bestshop' ),
			'desc' => '',
			'std' => ''
		),	

		array(
			'id' => 'popup_form',
			'title' => esc_html__( 'Popup Form', 'bestshop' ),
			'type' => 'text',
			'sub_desc' => esc_html__( 'Put shortcode form to this field and it will be shown on popup mode frontend.', 'bestshop' ),
			'desc' => '',
			'std' => ''
		),

	)
);

$options[] = array(
	'title' => esc_html__('Advanced', 'bestshop'),
	'desc' => wp_kses( __('<p class="description">Custom advanced with Cpanel, Widget advanced, Developer mode </p>', 'bestshop'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bestshop for default.
	'icon' => BESTSHOP_URL.'/admin/img/glyphicons/glyphicons_083_random.png',
			//Lets leave this as a bestshop section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'show_cpanel',
			'title' => esc_html__( 'Show cPanel', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Turn on/off Cpanel', 'bestshop' ),
			'desc' => '',
			'std' => ''
		),

		array(
			'id' => 'widget-advanced',
			'title' => esc_html__('Widget Advanced', 'bestshop'),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Turn on/off Widget Advanced', 'bestshop' ),
			'desc' => '',
			'std' => '1'
		),					

		array(
			'id' => 'social_share',
			'title' => esc_html__( 'Social Share', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Turn on/off social share', 'bestshop' ),
			'desc' => '',
			'std' => '1'
		),

		array(
			'id' => 'breadcrumb_active',
			'title' => esc_html__( 'Turn Off Breadcrumb', 'bestshop' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Turn off breadcumb on all page', 'bestshop' ),
			'desc' => '',
			'std' => '0'
		),

		array(
			'id' => 'back_active',
			'type' => 'checkbox',
			'title' => esc_html__('Back to top', 'bestshop'),
			'sub_desc' => '',
			'desc' => '',
						'std' => '1'// 1 = on | 0 = off
					),	

		array(
			'id' => 'direction',
			'type' => 'select',
			'title' => esc_html__('Direction', 'bestshop'),
			'options' => array( 'ltr' => 'Left to Right', 'rtl' => 'Right to Left' ),
			'std' => 'ltr'
		),

		array(
			'id' => 'advanced_js',
			'type' => 'textarea',
			'placeholder' => esc_html__( 'Example: $("p").hide()', 'bestshop' ),
			'sub_desc' => esc_html__( 'Insert your own JS into this block. This customizes js throughout the theme', 'bestshop' ),
			'title' => esc_html__( 'Custom JS', 'bestshop' )
		)
	)
);

$options_args = array();

	//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$options_args['opt_name'] = SWG_THEME;

	//Custom menu title for options page - default is "Options"
$options_args['menu_title'] = esc_html__('Theme Options', 'bestshop');

	//Custom Page Title for options page - default is "Options"
$options_args['page_title'] = esc_html__('Bestshop Options ', 'bestshop');

	//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "bestshop_theme_options"
$options_args['page_slug'] = 'bestshop_theme_options';

	//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
$options_args['page_type'] = 'submenu';

	//custom page location - default 100 - must be unique or will override other items
$options_args['page_position'] = 27;
$swg_options = new SWG_Options( $options, $options_args );

return $options;
}
add_action( 'init', 'bestshop_Options_Setup', 0 );
endif; 


/*
** Define widget
*/
function bestshop_widget_setup_args(){
	$bestshop_widget_areas = array(
		
		array(
			'name' => esc_html__('Sidebar Left Blog', 'bestshop'),
			'id'   => 'left-blog',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		array(
			'name' => esc_html__('Sidebar Right Blog', 'bestshop'),
			'id'   => 'right-blog',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Top Header', 'bestshop'),
			'id'   => 'top',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Top Header5', 'bestshop'),
			'id'   => 'top2',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Top Header51', 'bestshop'),
			'id'   => 'top3',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Header Right', 'bestshop'),
			'id'   => 'header-right',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Header Right2', 'bestshop'),
			'id'   => 'header-right2',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Header Right3', 'bestshop'),
			'id'   => 'header-right3',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Header Right5', 'bestshop'),
			'id'   => 'header-right5',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Header Right51', 'bestshop'),
			'id'   => 'header-right6',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Header Right6', 'bestshop'),
			'id'   => 'header-right7',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Header Left', 'bestshop'),
			'id'   => 'header-left',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Header Bottom', 'bestshop'),
			'id'   => 'header-bot',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),

		array(
			'name' => esc_html__('Sidebar Above Product', 'bestshop'),
			'id'   => 'above-product',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Left Product', 'bestshop'),
			'id'   => 'left-product',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Right Product', 'bestshop'),
			'id'   => 'right-product',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Left Detail Product', 'bestshop'),
			'id'   => 'left-product-detail',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Right Detail Product', 'bestshop'),
			'id'   => 'right-product-detail',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Bottom Detail Product', 'bestshop'),
			'id'   => 'bottom-detail-product',
			'before_widget' => '<div class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),

		array(
			'name' => esc_html__('Footer Copyright', 'bestshop'),
			'id'   => 'footer-copyright',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Widget Search', 'bestshop'),
			'id'   => 'search',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		)
	);
return apply_filters( 'bestshop_widget_register', $bestshop_widget_areas );
}