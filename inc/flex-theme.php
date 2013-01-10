<?php

class Flex_Theme {

	public function init() {

		add_theme_support( 'automatic-feed-links' );

		add_action( 'after_setup_theme', 'jqmobile_setup' );
		add_filter('show_admin_bar', '__return_false');

		add_action( 'wp_enqueue_scripts', 'jquerymobile_enqueue_script' );

		add_action( 'wp_print_styles', 'jquerymobile_enqueue_style' );

		add_action ( 'widgets_init', 'jquerymobile_widgets_init' );

		add_filter( 'next_posts_link_attributes', 'jquerymobile_next_posts_link_attributes' );
		add_filter( 'previous_posts_link_attributes', 'jquerymobile_prev_posts_link_attributes' );

		add_filter( 'next_comments_link_attributes', 'jquerymobile_next_comments_link_attributes' );
		add_filter( 'previous_comments_link_attributes', 'jquerymobile_previous_comments_link_attributes' );

		add_filter( 'widget_categories_args', 'jquerymobile_widget_categories_args' );
		add_filter( 'widget_links_args', 'jquerymobile_widget_links_args' );

		add_filter( 'widget_archives_args', 'jquerymobile_widget_archive_args' );

		add_filter( 'widget_title', 'jquerymobile_widget_title', 10, 3 );

		add_filter( 'wp_title', 'jquerymobile_title_filter' );
	}
}

$flex_theme = new Flex_Theme();

?>
