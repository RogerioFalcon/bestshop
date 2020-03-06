<?php
/*
 *
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
 
if( !function_exists( 'swg_options' ) ) :
function swg_options( $opt_name, $default = null ){
	$options = get_option( SWG_THEME );
	if ( !is_admin() &&  isset( $options['show_cpanel'] ) && $options['show_cpanel'] ){
		$cookie_opt_name = SWG_THEME.'_' . $opt_name;
		if ( array_key_exists( $cookie_opt_name, $_COOKIE ) ){
			return $_COOKIE[$cookie_opt_name];
		}
	}
	if( is_array( $options ) ){
		if ( array_key_exists( $opt_name, $options ) ){
			return $options[$opt_name];
		}
	}
	return $default;
}
endif;

?>