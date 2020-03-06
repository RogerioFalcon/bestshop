<?php 
/*
** Register Sidebar and Widgets
*/
function bestshop_widgets_init() {
	
	// Sidebars
	global $bestshop_widget_areas;
	$bestshop_widget_areas = bestshop_widget_setup_args();
	if ( count($bestshop_widget_areas) ){
		foreach( $bestshop_widget_areas as $sidebar ){
			$sidebar_params = apply_filters('bestshop_sidebar_params', $sidebar);
			register_sidebar($sidebar_params);
		}
	}
}
add_action('widgets_init', 'bestshop_widgets_init');