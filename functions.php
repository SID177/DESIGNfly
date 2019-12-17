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
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary', 'designfly' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'designfly_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => get_template_directory_uri() . '/img/rapeatable-bg.png',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
	}
endif;
add_action( 'after_setup_theme', 'designfly_setup' );


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
		'supports'    => array( 'title', 'excerpt', 'thumbnail', 'page-attributes' )
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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function designfly_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'designfly' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'designfly' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'designfly_widgets_init' );

/**
 * Replaces default read more text with READ MORE link.
 * 
 * @param string $more Default read more string.
 * 
 * @return string New read more string.
 */
function designfly_excerpt_more( $more ) {
	if ( ! is_single() ) {
		$more = sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
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

	wp_enqueue_style( 'designfly-style', get_stylesheet_uri() );

	wp_enqueue_style( 'designfly-theme', get_template_directory_uri() . '/css/theme.css' );

	wp_enqueue_style( 'designfly-font', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap' );

	wp_enqueue_script( 'designfly-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'designfly-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	if ( is_front_page() || is_post_type_archive( 'designfly_portfolio' ) || is_tax( 'designfly_categories' ) ) {
		
		if ( is_front_page() ) {
			wp_enqueue_style( 'designfly-front-page-style', get_template_directory_uri() . '/css/front-page.css' );
		}

		wp_enqueue_style( 'designfly-portfolio', get_template_directory_uri() . '/css/portfolio.css' );
		wp_enqueue_script( 'designfly-portfolio-modal', get_template_directory_uri() . '/js/portfolio-modal.js', array( 'jquery' ), '20151215', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'designfly_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

