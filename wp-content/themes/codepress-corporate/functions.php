<?php
/**
 * codepress corporate functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package codepress_corporate  
 */

if ( ! function_exists( 'codepress_corporate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function codepress_corporate_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on codepress corporate, use a find and replace
	 * to change 'codepress-corporate' to the name of your theme in all the template files.
	 */
//	load_theme_textdomain( 'codepress-corporate', get_template_directory() . '/languages' ); 

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
		'primary' => esc_html__( 'Primary', 'codepress-corporate' ),
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

	/*
    /* Woocommerce  declearation
    */
        add_theme_support( 'woocommerce' );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'codepress_corporate_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


    add_theme_support( 'custom-logo', array(
       'height'      => 84,
       'width'       => 194,
       'flex-width' => true,
       'flex-height' => true
    ) );

/*************************************************************************************************************************************************
*image Corpping
**************************************************************************************************************************************************/

//image size for Slider banner crop

add_image_size( 'codepress_corporate_slider_image', 1600, 660, true );

//image size for banner

add_image_size( 'codepress_corporate_banner_image_size', 1920, 287, true );


//image size for portfolio

add_image_size( 'codepress_corporate_portfolio_image_size', 380, 380, true );

//image size for t-blog

add_image_size( 'codepress_corporate_blog_image_size', 370, 235, true );

//image size for about-us

add_image_size( 'codepress_corporate_about_us_image_size', 585, 389, true );


}
endif;
add_action( 'after_setup_theme', 'codepress_corporate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function codepress_corporate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'codepress_corporate_content_width', 640 );
}
add_action( 'after_setup_theme', 'codepress_corporate_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function codepress_corporate_widgets_init() {
	
   //Right  Sidebar 
   register_sidebar( array(
     'name'            => esc_html__( 'Right Sidebar', 'codepress-corporate' ),
     'id'              => 'right-sidebar',
     'description'     => esc_html__( 'Show Right Sidebar.', 'codepress-corporate' ),
     'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
     'after_widget'    => '</section>',
     'before_title'    => '<h2 class="widget-title">',
     'after_title'     => '</h2>'
  ) );

	//Left  Sidebar 
   register_sidebar( array(
     'name'            => esc_html__( 'Left Sidebar', 'codepress-corporate' ),
     'id'              => 'left-sidebar',
     'description'     => esc_html__( 'Show Left Sidebar.', 'codepress-corporate' ),
     'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
     'after_widget'    => '</section>',
     'before_title'    => '<h2 class="widget-title">',
     'after_title'     => '</h2>'
   ));

    register_sidebar( array(
      'name'            => esc_html__( 'Footer 1', 'codepress-corporate' ), 
      'id'              => 'footer-1',
      'description'     => esc_html__( 'Shows widgets at Right side.', 'codepress-corporate' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
      'after_widget'    => '</section>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>'
   ) );

    register_sidebar( array(
      'name'            => __( 'Footer 2', 'codepress-corporate' ),
      'id'              => 'footer-2',
      'description'     => esc_html__( 'Shows widgets at Right side.', 'codepress-corporate' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
      'after_widget'    => '</section>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>'
   ) );

    register_sidebar( array(
      'name'            => esc_html__( 'Footer 3', 'codepress-corporate' ),
      'id'              => 'footer-3',
      'description'     => __( 'Shows widgets at Right side.', 'codepress-corporate' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
      'after_widget'    => '</section>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>'
   ) );

    register_sidebar( array(
      'name'            => esc_html__( 'Footer 4', 'codepress-corporate' ),
      'id'              => 'footer-4',
      'description'     => __( 'Shows widgets at Right side.', 'codepress-corporate' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
      'after_widget'    => '</section>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>'
   ) );
   
    register_sidebar( array(
      'name'            => esc_html__( 'Contact Sidebar', 'codepress-corporate' ),
      'id'              => 'contact-temp',
      'description'     => esc_html__( 'Shows widget at Contact Us page.', 'codepress-corporate' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
      'after_widget'    => '</section>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>'
   ) );
   
   register_sidebar( array(
      'name'            => esc_html__( 'WooCommerce Right Sidebar', 'codepress-corporate' ),
      'id'              => 'woocommerce-sidebar-right',
      'description'     => esc_html__( 'Drop Your Widgets', 'codepress-corporate' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
      'after_widget'    => '</section>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>'
   ) );
   register_sidebar( array(
      'name'            => esc_html__( 'WooCommerce Left Sidebar', 'codepress-corporate' ),
      'id'              => 'woocommerce-sidebar-left',
      'description'     => esc_html__( 'Drop Your Widgets', 'codepress-corporate' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
      'after_widget'    => '</section>',
      'before_title'    => '<h2 class="widget-title">',
      'after_title'     => '</h2>'
   ) );

}

add_action( 'widgets_init', 'codepress_corporate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function codepress_corporate_scripts() {

// CSS enqueue
	
    wp_enqueue_style('reset-css', get_template_directory_uri().'/css/reset.css');
	wp_enqueue_style( 'codepress-corporate-style', get_stylesheet_uri(), array(), '1.1.2' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css');    
    wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.css');	
	wp_enqueue_style('owl-carousel', get_template_directory_uri().'/css/owl.carousel.css');   
	wp_enqueue_style('owl-theme-default', get_template_directory_uri().'/css/owl.theme.default.css');
	wp_enqueue_style('codepress-corporate-responsive-css', get_template_directory_uri().'/css/responsive.css');
	wp_enqueue_style( 'Roboto-font', '//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic');

//Javascript enqueue

	wp_enqueue_script( 'codepress-corporate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'codepress-corporate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );


	//wp_enqueue_script( 'codepress-corporate-jquery', get_template_directory_uri() . '/js/jquery-2.2.3.js', array(), '2.2.3', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '2.0.0', true );
	wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.js', array(), '1.0.0' , true);
	wp_enqueue_script( 'codepress-corporate-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'codepress_corporate_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */

require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/upsale/class-customize.php' );
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/widgets/corporate-widgets.php';


/**
 * Load  corporate functions file .
 */
require get_template_directory() . '/inc/corporate-functions.php';

/**
 * Load  custom meta-box file .
 */
require get_template_directory() . '/inc/custom-meta-box.php';



function codepress_corporate_after_setup_theme() {
    add_theme_support( 'html5', array( 's-form' ) );
}
add_action( 'after_setup_theme', 'codepress_corporate_after_setup_theme' );



/** Google iframe Sanitization */

function codepress_corporate_expanded_alowed_tags() {
	//$allowed = wp_kses_allowed_html( 'post' );

	// iframe
	$allowed['iframe'] = array(
		'src'             => array(),
		'height'          => array(),
		'width'           => array(),
		'frameborder'     => array(),
		'allowfullscreen' => array(),

	);

	$allowed['a'] = array(

            'href' => array(),
            'rel' => array(),
            'name' => array(),
            'target' => array(),
            'class' => array(),
            'id' => array(),
		);
	$allowed['span'] = array(
			'class' => array(),
			'id' 	=> array(),
			'style' => array(),
 		);

	$allowed['br'] = array();

	return $allowed;
}
/** wp_kses allow variable function ends here */

/** Text area sanitizaation */
function codepress_corporate_textarea_saniize($input, $input_allowed = '')
{	
	if( $input_allowed == '' ){

	$allowed_text = codepress_corporate_expanded_alowed_tags();
	}
	else {
		$allowed_text = $input_allowed;
	}

	$output = wp_kses( $input, $allowed_text );

	return $output;
}


/** defining excerpt: */

function codepress_corporate_excerpt_length( $length = '' ) {

if ( isset( $GLOBALS['codepress_corporate_excerpt_length'] ) && $GLOBALS['codepress_corporate_excerpt_length'] > 0 ) {
return $GLOBALS['codepress_corporate_excerpt_length'];
} else {
return 50;
}
}
add_filter( 'excerpt_length', 'codepress_corporate_excerpt_length', 99 );

/**
* Filter the excerpt "read more" string.
*
* @param string $more "Read more" excerpt string.
* @return string (Maybe) modified "read more" excerpt string.
*/
function codepress_corporate_excerpt_more( $more = '' ) {
return '&hellip;';
}
add_filter( 'excerpt_more', 'codepress_corporate_excerpt_more' );

/**
* Add custom excerpt length
* @param $length
*/
function codepress_corporate_add_excerpt_length( $length ){
$length = absint( $length );
$GLOBALS['codepress_corporate_excerpt_length'] = $length;
}

/**
* REMOVE custom excerpt length
*/
function codepress_corporate_remove_excerpt_length (){
if ( isset( $GLOBALS['codepress_corporate_excerpt_length'] ) ) {
unset( $GLOBALS['codepress_corporate_excerpt_length'] );
}
}


/** Codepress Corporate Main Slider */

add_action( 'codepress_corporate_main_slider', 'codepress_corporate_banner_slider' );

function codepress_corporate_banner_slider()
{

	$slider_category = get_option( 'codepress_corporate_slider_category_setting' );
	global $post;
	?>

	<!-- Slider-start --> 
	<?php 
    $slider_activation = get_theme_mod( 'codepress_corporate_slider_activation_setting', 1 );

    if( $slider_activation == 1 ) {
    if (is_front_page() || is_home() ) {
       if( get_option( 'show_on_front' ) != 'posts' ): 

     ?> 
		
		<section class="banner-slider"> 

			<div id="banner-slider" class="owl-carousel owl-theme b-slider"> 

			<?php 
					$args = array(
									'post_type' => 'post',
									'post_status' => 'publish',
									'posts_per_page' => 4,
									'cat' => absint($slider_category)
									);
		
					$query = new WP_Query($args);

					while( $query->have_posts() ) : $query->the_post();

	                if ( has_post_thumbnail()) {
	                $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'codepress_corporate_slider_image');
	           
			?>

				<div class="item slider">  
					<div class="b-img">
                        <?php if(!empty($image_url[0])){
                        ?>
                        <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php    
                        } ?>
						
						<div class="bg"></div>
					</div>		 
					<div class="caption">
						<div class="outer">
							<div class="inner">
							
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php //if( post_content() != '' ) : ?>

								<?php codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_service_excerpt_length', 20 ) );
					                the_excerpt();
					                codepress_corporate_remove_excerpt_length();
					            ?> 
									
								<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','codepress-corporate'); ?></a>
								<?php //endif; ?>
							</div> 
						</div> 
					</div> 
				</div>	

			<?php  }

			endwhile; ?>	
				<?php wp_reset_postdata(); ?>
             </div>		
		</section> 
     <?php
  
     endif;
        }
      }

	/** Slider-end */
}