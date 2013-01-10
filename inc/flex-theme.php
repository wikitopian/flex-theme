<?php

class Flex_Theme {
	public function init() {
	
		add_action( 'after_setup_theme', 'jqmobile_setup' );
		add_filter('show_admin_bar', '__return_false');
	}
}

$flex_theme = new Flex_Theme();

?>
