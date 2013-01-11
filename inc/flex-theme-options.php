<?php


if ( ! function_exists( 'jqmobile_setup' ) ) {
	function jqmobile_setup() {
		require( dirname( __FILE__ ) . '/inc/theme-options.php' );
	}
}
/*
function jqmobile_get_default_theme_options() {
	$default_theme_options = array(
		'color_scheme' => 'default',
		'mobile_layout' => 'content-sidebar',
		'ui' => array()
	);

	return apply_filters( 'jqmobile_default_theme_options', $default_theme_options );
}
*/
?>
