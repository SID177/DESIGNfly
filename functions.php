<?php
/**
 * DESIGNfly functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DESIGNfly
 */

if ( ! function_exists( 'designfly_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function designfly_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on DESIGNfly, use a find and replace
		 * to change 'designfly' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'designfly', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'designfly' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'designfly_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => get_template_directory_uri() . '/img/rapeatable-bg.png',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for service worker, required for PWA plugin.
		add_theme_support( 'service_worker', true );
	}
endif;
add_action( 'after_setup_theme', 'designfly_setup' );

/**
 * Flush rewrite rules after switching themes to avoid page not found problems.
 */
function designfly_after_switch_theme() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'designfly_after_switch_theme' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function designfly_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'designfly_content_width', 640 );
}
add_action( 'after_setup_theme', 'designfly_content_width', 0 );

/**
 * This function is registered to 'init' action hook.
 * It registers custom post type and custom taxonomy.
 */
function designfly_init() {
	$labels = array(
		'name'                     => _x( 'Portfolios', 'Post Type General Name', 'designfly' ),
		'singular_name'            => _x( 'Portfolio', 'Post Type Sigular Name', 'designfly' ),
		'add_new'                  => _x( 'Add New', 'Add New', 'designfly' ),
		'add_new_item'             => __( 'Add New Portfolio', 'designfly' ),
		'edit_item'                => __( 'Edit Portfolio', 'designfly' ),
		'new_item'                 => __( 'New Portfolio', 'designfly' ),
		'view_item'                => __( 'View Portfolio', 'designfly' ),
		'view_items'               => __( 'View Portfolios', 'designfly' ),
		'search_items'             => __( 'Search Portfolios', 'designfly' ),
		'not_found'                => __( 'No portfolios found.', 'designfly' ),
		'not_found_in_trash'       => __( 'No portfolios found in Trash.', 'designfly' ),
		'all_items'                => __( 'All Portfolios', 'designfly' ),
		'archives'                 => __( 'Portfolio Archives', 'designfly' ),
		'attributes'               => __( 'Portfolio Attributes', 'designfly' ),
		'insert_into_item'         => __( 'Insert into portfolio', 'designfly' ),
		'uploaded_to_this_item'    => __( 'Uploaded to this portfolio', 'designfly' ),
		'filter_items_list'        => __( 'Filter portfolio list', 'designfly' ),
		'items_list_navigation'    => __( 'Portfolios list navigation', 'designfly' ),
		'items_list'               => __( 'Portfolios list', 'designfly' ),
		'item_published'           => __( 'Portfolio published.', 'designfly' ),
		'item_published_privately' => __( 'Portfolio published privately.', 'designfly' ),
		'item_reverted_to_draft'   => __( 'Portfolio reverted to draft.', 'designfly' ),
		'item_scheduled'           => __( 'Portfolio scheduled.', 'designfly' ),
		'item_updated'             => __( 'Portfolio updated.', 'designfly' ),
	);

	$args = array(
		'labels'      => $labels,
		'description' => __( 'Portfolios for DESIGNfly theme.', 'designfly' ),
		'public'      => true,
		'menu_icon'   => 'dashicons-portfolio',
		'has_archive' => true,
		'supports'    => array( 'title', 'excerpt', 'thumbnail', 'page-attributes' ),
	);

	register_post_type( 'designfly_portfolio', $args );

	$labels = array(
		'name'          => _x( 'Portfolio Categories', 'Portfolio category general name', 'designfly' ),
		'singular_name' => _x( 'Portfolio Category', 'Portfolio category singular name', 'designfly' ),
	);

	$args = array(
		'hierarchical' => false,
		'labels'       => $labels,
		'public'       => true,
		'description'  => __( 'Neque porro quisquam est, dolorem ipsum quia dolor amet...', 'designfly' ),
	);

	register_taxonomy( 'designfly_categories', array( 'designfly_portfolio' ), $args );
}
add_action( 'init', 'designfly_init' );

/**
 * Replaces default read more text with READ MORE link.
 *
 * @param string $more Default read more string.
 *
 * @return string New read more string.
 */
function designfly_excerpt_more( $more ) {
	if ( ! is_single() ) {
		$more = sprintf(
			'<a class="read-more" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			esc_html__( 'READ MORE', 'designfly' )
		);
	}

	return $more;
}
add_filter( 'excerpt_more', 'designfly_excerpt_more' );

/**
 * Replaces default read more text length.
 *
 * @param int $length Default read more text length.
 *
 * @return int New read more text length.
 */
function designfly_excerpt_length( $length ) {
	if ( ! is_single() ) {
		return 35;
	}

	return $length;
}
add_filter( 'excerpt_length', 'designfly_excerpt_length' );


/**
 * Enqueue scripts and styles.
 */
function designfly_scripts() {

	wp_enqueue_style( 'designfly-style', get_stylesheet_uri(), array(), '1.0' );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'designfly-theme', get_template_directory_uri() . '/css/theme.css', array(), '1.0' );
	wp_enqueue_script( 'designfly-theme', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_style( 'designfly-font', get_template_directory_uri() . '/css/open-sans.css', array(), '1.0' );

	wp_enqueue_script( 'designfly-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	wp_enqueue_script( 'designfly-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );

	wp_enqueue_script( 'font-awesome', get_template_directory_uri() . '/js/font-awesome-icons.js', array(), '1.0', true );

	if ( is_front_page() || is_post_type_archive( 'designfly_portfolio' ) || is_tax( 'designfly_categories' ) ) {

		if ( is_front_page() ) {
			wp_enqueue_style( 'designfly-front-page-style', get_template_directory_uri() . '/css/front-page.css', array(), '1.0' );
		}

		wp_enqueue_style( 'designfly-portfolio', get_template_directory_uri() . '/css/portfolio.css', array(), '1.0' );
		wp_enqueue_script( 'designfly-portfolio-modal', get_template_directory_uri() . '/js/portfolio-modal.js', array( 'designfly-theme' ), '1.0', true );
	}

	if ( is_singular() && comments_open() ) {
		global $post;

		if ( 'post' === $post->post_type ) {
			$count = (int) get_post_meta( $post->ID, 'designfly_post_views_count', true );
			if ( empty( $count ) ) {
				$count = 0;
			}
			$count ++;

			update_post_meta( $post->ID, 'designfly_post_views_count', $count );
		}

		if ( get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'designfly_scripts' );

/**
 * Custom comment list item HTML for posts.
 * Used in wp_list_comments function.
 *
 * @param object $comment Current comment object.
 * @param array  $args    Arguments passed in wp_list_comments function.
 * @param int    $depth   Depth of current comment children tree.
 */
function designfly_custom_comment_block( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; // phpcs:ignore

	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

	$commenter = wp_get_current_commenter();
	if ( $commenter['comment_author_email'] ) {
		$moderation_note = esc_html__( 'Your comment is awaiting moderation.', 'designfly' );
	} else {
		$moderation_note = esc_html__( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.', 'designfly' );
	}

	?>
	<<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<span class="dashicons dashicons-testimonial"></span>
			<div class="comment-block">
				<footer class="comment-meta">
					<?php
					$author_link = '';
					if ( empty( $comment->comment_author_url ) && ! empty( $comment->user_id ) ) {
						$author_link = '<a href="' . esc_url( get_author_posts_url( $comment->user_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $comment->user_id ) ) . '</a>';
					} else {
						$author_link = get_comment_author_link( $comment );
					}

					$author_html  = '<span class="comment-author">' . $author_link . '</span>';
					$said_on_html = ' <span class="said-on">' . esc_html_x( 'said on', 'designfly comment said on', 'designfly' ) . '</span> ';
					$comment_date = get_comment_date( 'F d, Y', $comment ) . ' ' . esc_html_x( 'at', 'designfly comment at', 'designfly' ) . ' ' . get_comment_date( 'H:i a', $comment );

					echo $author_html . $said_on_html . $comment_date; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

					if ( '0' == $comment->comment_approved ) : // phpcs:ignore
						?>
						<em class="comment-awaiting-moderation"><?php echo $moderation_note; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></em>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'reply_text' => esc_html_x( 'reply', 'comment reply', 'designfly' ),
							'add_below'  => 'div-comment',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
							'before'     => '<div class="reply"><i class="fas fa-share"></i> ',
							'after'      => '</div>',
						)
					)
				);
				?>
			</div>
		</article><!-- .comment-body -->
	<?php
}

/**
 * Enqueue admin style.
 */
function designfly_admin_enqueue_scripts() {
	wp_enqueue_style( 'designfly-admin', get_template_directory_uri() . '/css/admin.css', array(), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'designfly_admin_enqueue_scripts' );

/**
 * Define Portfolio widget.
 */
require get_template_directory() . '/inc/widgets/class-designfly-portfolio-widget.php';

/**
 * Define posts widget.
 */
require get_template_directory() . '/inc/widgets/class-designfly-posts-widget.php';

/**
 * Define Facebook widget.
 */
require get_template_directory() . '/inc/widgets/class-designfly-facebook-widget.php';

/**
 * Define Twitter widget.
 */
require get_template_directory() . '/inc/widgets/class-designfly-twitter-widget.php';

/**
 * Register widget area and widgets.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function designfly_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'designfly' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'designfly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_widget( 'DESIGNfly_Portfolio_Widget' );
	register_widget( 'DESIGNfly_Posts_Widget' );
	register_widget( 'DESIGNfly_Facebook_Widget' );
	register_widget( 'DESIGNfly_Twitter_Widget' );
}
add_action( 'widgets_init', 'designfly_widgets_init' );

/**
 * Add configuration page for twitter feeds widget.
 */
require get_template_directory() . '/inc/class-designfly-twitter-configuration.php';
new DESIGNfly_Twitter_Configuration();

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


require_once ABSPATH . 'wp-admin/includes/plugin.php';
if ( is_plugin_active( 'pwa/pwa.php' ) ) {
	/**
	 * Functions which enhance the theme by hooking into WordPress.
	 */
	require get_template_directory() . '/inc/class-designfly-service-worker-scripts.php';

	new DESIGNfly_Service_Worker_Scripts();
}
