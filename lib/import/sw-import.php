<?php 
function swg_import_files() { 
	return array(
		array(
			'import_file_name'          => 'Home Page 1',
			'page_title'				=> 'Home Page 1',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/slideshow6.zip',
				'slide2' => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/slideshow_video.zip'
			),
			'local_import_options'        => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/theme_options.txt',
					'option_name' => 'bestshop_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Verticle Menu',
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-1/1.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'bestshop' ),
		),
	
		array(
			'import_file_name'          => 'Home Page 2',
			'page_title'				=> 'Home Page 2',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/slideshow9.zip',
				'slide2' => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/slideshow_video.zip'
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/theme_options.txt',
					'option_name' => 'bestshop_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' => 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Verticle Menu',
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-2/2.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'bestshop' ),
		),

		array(
			'import_file_name'          => 'Home Page 3',
			'page_title'				=> 'Home Page 3',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/slideshow10.zip',
				'slide2' => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/slideshow_video.zip'
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/theme_options.txt',
					'option_name' => 'bestshop_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' => 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Verticle Menu',
				'mobile_menu' => 'Mobile Menu'
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-3/3.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'bestshop' ),
		),

		array(
			'import_file_name'          => 'Home Page 4',
			'page_title'				=> 'Home Page 4',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/slideshow_video.zip',
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/theme_options.txt',
					'option_name' => 'bestshop_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' => 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Verticle Menu',
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-4/4.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'bestshop' ),
		),

		array(
			'import_file_name'          => 'Home Page 5',
			'page_title'				=> 'Home Page 5',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/slideshow12.zip',
				'slide2' => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/slideshow_video.zip',
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/theme_options.txt',
					'option_name' => 'bestshop_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' => 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Verticle Menu',
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-5/5.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'bestshop' ),
		),


	);
}
add_filter( 'pt-ocdi/import_files', 'swg_import_files' );