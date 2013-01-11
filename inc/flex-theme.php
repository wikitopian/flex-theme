<?php

class Flex_Theme {
	private $dir;
	private $content_width;
	private $settings;

	public function __construct() {
		$this->dir = get_template_directory_uri();

		$content_width = 600;

		register_activation_hook( __FILE__, array( &$this, 'install' ) );
		register_deactivation_hook( __FILE__, array( &$this, 'uninstall' ) );
		add_action( 'init', array( &$this, 'init' ) );
	}

	public function install() {
		$this->settings = array(
			'body' => array(
				'label' => __( 'Body', 'jqmobile' ),
				'default' => 'c'
			),
			'header' => array(
				'label' => __( 'Header', 'jqmobile' ),
				'default' => 'a'
			),
			'footer' => array(
				'label' => __( 'Footer', 'jqmobile' ),
				'default' => 'a'
			),
			'post' => array(
				'label' => __( 'Post Teaser', 'jqmobile' ),
				'default' => 'c'
			),
			'sticky' => array(
				'label' => __( 'Sticky Post', 'jqmobile' ),
				'default' => 'b'
			),
			'widget' => array(
				'label' => __( 'Widget', 'jqmobile' ),
				'default' => 'c'
			),
			'widget_content' => array(
				'label' => __( 'Widget Content', 'jqmobile' ),
				'default' => 'c'
			),
			'comment' => array(
				'label' => __( 'Comments', 'jqmobile' ),
				'default' => 'c'
			),
			'form_comment' => array(
				'label' => __( 'Comment Form', 'jqmobile' ),
				'default' => 'c'
			),
		);
		put_option( 'flex-theme_settings', $this->settings );
	}

	public function uninstall() {
		delete_option( 'flex-theme_settings' );
	}

	public function init() {
		if( !$this->settings = get_option( 'flex-theme_settings' ) ) {
			$this->install();
		}

		add_theme_support( 'automatic-feed-links' );

		add_action(
			'after_setup_theme',
			array( &$this, 'after_setup_theme' )
		);
		add_filter( 'show_admin_bar', '__return_false' );

		add_action(
			'wp_enqueue_scripts',
			array( &$this, 'do_scripts' )
		);
		add_action(
			'wp_print_styles',
			array( &$this, 'do_print_styles' )
		);

		add_filter( 'wp_title', 'jquerymobile_title_filter' );

		add_filter( 'next_posts_link_attributes', 'jquerymobile_next_posts_link_attributes' );
		add_filter( 'previous_posts_link_attributes', 'jquerymobile_prev_posts_link_attributes' );
		add_filter( 'next_comments_link_attributes', 'jquerymobile_next_comments_link_attributes' );
		add_filter( 'previous_comments_link_attributes', 'jquerymobile_previous_comments_link_attributes' );

		add_action ( 'widgets_init', 'jquerymobile_widgets_init' );
		add_filter( 'widget_title', 'jquerymobile_widget_title', 10, 3 );
		add_filter( 'widget_categories_args', 'jquerymobile_widget_categories_args' );
		add_filter( 'widget_links_args', 'jquerymobile_widget_links_args' );
	}

	public function after_setup_theme() {

	}

	public function do_scripts() {

	}

	public function do_print_styles() {

	}

	public function do_admin_print_styles() {
		wp_enqueue_style(
			'flex-theme-options',
			"{$this->dir}/style/theme-options.css"
		);
	}
}

$flex_theme = new Flex_Theme();

?>
