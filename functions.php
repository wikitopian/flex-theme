<?php

require_once( 'inc/flex-theme.php' );

require( dirname( __FILE__ ) . '/inc/classes.php' );

if ( ! function_exists( 'jqmobile_setup' ) ) {
	function jqmobile_setup() {
		require( dirname( __FILE__ ) . '/inc/theme-options.php' );
	}
}

$content_width = 600;


function jqmobile_get_default_theme_options() {
	$default_theme_options = array(
		'color_scheme' => 'default',
		'mobile_layout' => 'content-sidebar',
		'ui' => array()
	);

	return apply_filters( 'jqmobile_default_theme_options', $default_theme_options );
}

function jqmobile_mobile_entities() {
	$layout_options = array(
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

	return apply_filters( 'jqmobile_mobile_layouts', $layout_options );
}

function jqmobile_get_theme_options() {;
	return get_option( 'jqmobile_theme_options', jqmobile_get_default_theme_options() );
}

function jqmobile_get_ui($key = '') {
	static $ui_options;

	if (!is_array($ui_options)) {
		$options = jqmobile_get_theme_options();
		$ui_options = $options['ui'];
	}
	return isset($ui_options[$key]) ? $ui_options[$key] : '';
}

function jqmobile_ui($key = '') {

	$data = jqmobile_get_ui($key);
	if ($data) {
		echo ' data-theme="'.$data.'"';
	}
}

function jquerymobile_enqueue_script() {
	wp_enqueue_script('theme-script', get_template_directory_uri().'/script.js', array('jquery'));
	wp_enqueue_script('jquerymobile', 'http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js', array('jquery'));
}

function jquerymobile_enqueue_style() {
	wp_enqueue_style('jquerymobile', 'http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css');
	wp_enqueue_style('custom', get_template_directory_uri().'/custom.css', false);
}


function jquerymobile_widgets_init() {
	register_sidebar(array(
		'name' => 'Sidebar Widgets',
		'id'   => 'sidebar',
		'description'   => 'These are widgets for the sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s"  data-role="collapsible" data-theme="'.jqmobile_get_ui('widget').'">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	));
}


function jquerymobile_next_posts_link_attributes(){
	return 'data-role="button" data-icon="arrow-l"';
}
function jquerymobile_prev_posts_link_attributes(){
	return 'data-role="button" data-icon="arrow-r"';
}


function jquerymobile_next_comments_link_attributes(){
	return 'data-role="button" data-icon="arrow-r"';
}
function jquerymobile_previous_comments_link_attributes(){
	return 'data-role="button" data-icon="arrow-l"';
}


function jquerymobile_widget_archive_args($args) {
	$args['show_post_count'] = false;
	return $args;
}

function jquerymobile_widget_categories_args($args) {
	$args['walker'] = new Theme_Walker_Category;
	return $args;
}

function jquerymobile_widget_links_args($args) {
	$args['show_updated'] = false;
	$args['show_description'] = false;
	$args['show_rating'] = false;
	return $args;
}

function jquerymobile_widget_title($title, $instance = null, $id = null) {

	$title = trim($title, " \xA0");
	$default_title = ucfirst($id);

	switch($id) {
		case 'pages':
			$default_title = __( 'Pages', 'jquerymobile' );
			break;
		case 'text':
			$default_title = __( 'Text', 'jquerymobile' );
			break;
		case 'search':
			$default_title = __( 'Search', 'jquerymobile' );
			break;
		case 'tag_cloud':
			$default_title = __( 'Tag cloud', 'jquerymobile' );
			break;
		case 'recent-posts':
			$default_title = __( 'Recent posts', 'jquerymobile' );
			break;
		case 'meta':
			$default_title = __( 'Meta', 'jquerymobile' );
			break;
		case 'categories':
			$default_title = __( 'Categories', 'jquerymobile' );
			break;
		case 'archives':
			$default_title = __( 'Archives', 'jquerymobile' );
			break;
		case 'calendar':
			$default_title = __( 'Calendar', 'jquerymobile' );
			break;
		case 'nav_menu':
			$default_title = __( 'Custom menu', 'jquerymobile' );
			break;
	}
	return $title ? $title : $default_title;
}

function jquerymobile_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'jquerymobile' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'jquerymobile' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php jqmobile_ui('comment');?>>
		<div id="comment-<?php comment_ID(); ?>" class="comment vcard ui-link-inherit">
				<?php
					$avatar_size = 60;

					echo get_avatar( $comment, $avatar_size );
				?>
				<div class="ui-li-heading">
					<?php
						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'jquerymobile' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><span title="%2$s">%3$s</span></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'jquerymobile' ), get_comment_date( 'Y/m/d' ), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'jquerymobile' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'jquerymobile' ); ?></em>
					<br />
				<?php endif; ?>

				<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'jquerymobile' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

function jquerymobile_title_filter( $title, $sep = null, $seplocation = null ) {
	// account for $seplocation
	$left_sep = ( $seplocation != 'right' ? ' ' . $sep . ' ' : '' );
	$right_sep = ( $seplocation != 'right' ? '' : ' ' . $sep . ' ' );

	// get special page type (if any)
	if( is_category() ) $page_type = $left_sep . 'Category' . $right_sep;
	elseif( is_tag() ) $page_type = $left_sep . 'Tag' . $right_sep;
	elseif( is_author() ) $page_type = $left_sep . 'Author' . $right_sep;
	elseif( is_archive() || is_date() ) $page_type = $left_sep . 'Archives'. $right_sep;
	else $page_type = '';

	// get the page number
	if( get_query_var( 'paged' ) ) $page_num = $left_sep. get_query_var( 'paged' ) . $right_sep; // on index
	elseif( get_query_var( 'page' ) ) $page_num = $left_sep . get_query_var( 'page' ) . $right_sep; // on single
	else $page_num = '';

	// concoct and return title
	if( !is_feed() ) return get_bloginfo( 'name' ) . $page_type . $title . $page_num;
	else return $old_title;
}

?>
