<?php
/**
 * Codepress Lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Codepress_Lite
 */

if ( ! function_exists( 'codepress_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function codepress_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Codepress Lite, use a find and replace
	 * to change 'codepress-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'codepress-lite', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'codepress-lite' ),
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
    
    /**
    /* Woocommerce compatibility  declearation
    */
        add_theme_support( 'woocommerce' );
 

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'codepress_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    add_theme_support( 'custom-logo', array(
       'height'      => 175,
       'width'       => 400,
       'flex-width' => true,
       'flex-height' => true
    ) );
    
    add_theme_support('woocommerce');
    
    add_image_size('codepress-lite-blog-thumb', 414 , 308 ,true);
    add_image_size('codepress-lite-portfolio-thumb', 476 , 317 ,true);
    add_image_size('codepress-lite-codepress_lite_banner', 1920, 570 ,true);
    add_image_size('codepress-lite-services', 454, 330 ,true);
    add_image_size('codepress-lite-who-we-are', 716, 434 ,true);
}
endif;
add_action( 'after_setup_theme', 'codepress_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function codepress_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'codepress_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'codepress_lite_content_width', 0 );




/**
 * Enqueue scripts and styles.
 */
function codepress_lite_scripts() {
	wp_enqueue_style( 'codepress-lite-style', get_stylesheet_uri() );

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css');
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
    wp_enqueue_style( 'raleway-font', '//fonts.googleapis.com/css?family=Raleway:400,100italic,100,200,200italic,300italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic');
    wp_enqueue_style( 'open-sans-font', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,400italic');

	wp_enqueue_script( 'codepress-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'codepress-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
    //wp_enqueue_script('jquery-js', get_template_directory_uri() . '/js/jquery.js', array(), '1.10.1' , true);
    
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '1.3.2' , true);
    
    wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.js', array(), '1.0.0' , true);

    wp_enqueue_script('codepress-lite-main-js', get_template_directory_uri() . '/js/main.js', array(), '0.0.1' , true);
    
}
add_action( 'wp_enqueue_scripts', 'codepress_lite_scripts' );


/**
 * Define Directory Location Constants
 */
define( 'CODEPRESS_LITE_MAIN_DIR', get_template_directory() );
define( 'CODEPRESS_LITE_CHILD_DIR', get_stylesheet_directory() );

define( 'CODEPRESS_LITE_INCLUDES_DIR', CODEPRESS_LITE_MAIN_DIR. '/inc' );
define( 'CODEPRESS_LITE_CSS_DIR', CODEPRESS_LITE_MAIN_DIR . '/css' );
define( 'CODEPRESS_LITE_JS_DIR', CODEPRESS_LITE_MAIN_DIR . '/js' );
define( 'CODEPRESS_LITE_LANGUAGES_DIR', CODEPRESS_LITE_MAIN_DIR . '/languages' );

define( 'CODEPRESS_LITE_ADMIN_DIR', CODEPRESS_LITE_INCLUDES_DIR . '/admin' );
define( 'CODEPRESS_LITE_CODEPRESS_WIDGETS_DIR', CODEPRESS_LITE_INCLUDES_DIR . '/widgets' );

define( 'CODEPRESS_LITE_ADMIN_IMAGES_DIR', CODEPRESS_LITE_ADMIN_DIR . '/images' );



define( 'CODEPRESS_LITE_MAIN_URL', get_template_directory_uri() );

define( 'CODEPRESS_LITE_INCLUDES_URL', CODEPRESS_LITE_MAIN_URL. '/inc' );
define( 'CODEPRESS_LITE_CSS_URL', CODEPRESS_LITE_MAIN_URL . '/css' );
define( 'CODEPRESS_LITE_JS_URL', CODEPRESS_LITE_MAIN_URL . '/js' );
define( 'CODEPRESS_LITE_LANGUAGES_URL', CODEPRESS_LITE_MAIN_URL . '/languages' );

define( 'CODEPRESS_LITE_ADMIN_URL', CODEPRESS_LITE_INCLUDES_URL . '/admin' );
define( 'CODEPRESS_LITE_WIDGETS_URL', CODEPRESS_LITE_INCLUDES_URL . '/widgets' );

define( 'CODEPRESS_LITE_IMAGES_URL', CODEPRESS_LITE_INCLUDES_URL . '/images' );
define( 'CODEPRESS_LITE_ADMIN_IMAGES_URL', CODEPRESS_LITE_ADMIN_URL . '/images' );



/**
 * Implement the Custom Header feature.
 */
require CODEPRESS_LITE_INCLUDES_DIR . '/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require CODEPRESS_LITE_INCLUDES_DIR . '/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require CODEPRESS_LITE_INCLUDES_DIR . '/extras.php';

/**
 * Customizer additions.
 */
require CODEPRESS_LITE_INCLUDES_DIR . '/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require CODEPRESS_LITE_INCLUDES_DIR . '/jetpack.php';

/**
 * Load Custom Functions
 */
require CODEPRESS_LITE_INCLUDES_DIR . '/codepress-functions.php';


/**
 * Load Custom sidebar custom Metabox
 */
require CODEPRESS_LITE_INCLUDES_DIR . '/cl-custom-metabox.php';


function codepress_lite_html_text_validate($validate_content)
{
            
            $codepress_lite_widgets_allowed_tags = array('p'=> array(),
                                                    'strong'=> array(),
                                                    'span'=> array(
                                                            'class'=>array()),
                                                    'em'=> array(),
                                                    'a'=> array(
                                                        'href'=> array(),
                                                        'title' => array())
                                                    );
        
        return wp_kses($validate_content, $codepress_lite_widgets_allowed_tags);
}