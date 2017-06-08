<?php  
/**
 * Bizgrowth functions and definitions
 *
 * @package Bizgrowth
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'bizgrowth_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function bizgrowth_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'bizgrowth', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'title-tag' );
	add_image_size('bizgrowth-homepage-thumb',240,145,true);
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bizgrowth' ),
		'footer' => __( 'Footer Menu', 'bizgrowth' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // bizgrowth_setup
add_action( 'after_setup_theme', 'bizgrowth_setup' );

// Set the word limit of post content 
function bizgrowth_content($limit) {
$content = explode(' ', get_the_excerpt(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}	
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}

function bizgrowth_widgets_init() { 	
	
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'bizgrowth' ),
		'description'   => __( 'Appears on blog page sidebar', 'bizgrowth' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
	
}
add_action( 'widgets_init', 'bizgrowth_widgets_init' );


function bizgrowth_font_url(){
		$font_url = '';		
		
		/* Translators: If there are any character that are not
		* supported by Roboto Condensed, trsnalate this to off, do not
		* translate into your own language.
		*/
		$roboto_condensed = _x('on','roboto_condensed:on or off','bizgrowth');
		
		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/
		$scada = _x('on','Scada:on or off','bizgrowth');	
		
		if('off' !== $roboto_condensed ){
			$font_family = array();
			
			if('off' !== $roboto_condensed){
				$font_family[] = 'Roboto Condensed:400,300,400italic,700';
			}
					
						
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function bizgrowth_scripts() {
	wp_enqueue_style('bizgrowth-font', bizgrowth_font_url(), array());
	wp_enqueue_style( 'bizgrowth-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bizgrowth-editor-style', get_template_directory_uri()."/editor-style.css" );
	wp_enqueue_style( 'nivo-style', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'bizgrowth-responsive-style', get_template_directory_uri()."/css/responsive.css" );		
	wp_enqueue_style( 'bizgrowth-default-style', get_template_directory_uri()."/css/default.css" );
	wp_enqueue_script( 'nivo-jquery', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'bizgrowth-custom-jquery', get_template_directory_uri() . '/js/custom.js' );
	wp_enqueue_style( 'animation-style', get_template_directory_uri()."/css/animation.css" );	
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri()."/css/font-awesome.css" );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bizgrowth_scripts' );

function bizgrowth_ie_stylesheet(){
	global $wp_styles;
	
	/** Load our IE-only stylesheet for all versions of IE.
	*   <!--[if lt IE 9]> ... <![endif]-->
	*
	*  Note: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
	*  calling the wp_enqueue_style() function. If you are trying to load a stylesheet for all browsers
	*  EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
	*  properly handle non-IE conditional comments.
	*/
	wp_enqueue_style('bizgrowth-ie', get_template_directory_uri().'/css/ie.css', array('bizgrowth-style'));
	$wp_styles->add_data('bizgrowth-ie','conditional','IE');
	}
add_action('wp_enqueue_scripts','bizgrowth_ie_stylesheet');


function bizgrowth_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $page_format as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	}
}


define('GRC_URL','http://www.gracethemes.com','bizgrowth');
define('GRC_THEME_DOC','http://gracethemes.com/documentation/bizgrowth/','bizgrowth');
define('GRC_PRO_THEME_URL','http://gracethemes.com/themes/bizgrowth-corporate-wordpress-theme/','bizgrowth');


function bizgrowth_themebytext(){
		return "Design & Develop by <a href=".esc_url(GRC_URL)." target='_blank'>Grace Themes</a>";
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/bizgrowth-custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/bizgrowth-template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/bizgrowth-extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/bizgrowth-customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



function bizgrowth_custom_blogpost_pagination( $wp_query ){
	$big = 999999999; // need an unlikely integer
	if ( get_query_var('paged') ) { $pageVar = 'paged'; }
	elseif ( get_query_var('page') ) { $pageVar = 'page'; }
	else { $pageVar = 'paged'; }
	$pagin = paginate_links( array(
		'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 		=> '?'.$pageVar.'=%#%',
		'current' 		=> max( 1, get_query_var($pageVar) ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text'		=> __('&laquo; Prev','bizgrowth'),
		'next_text' 	=> __('Next &raquo;','bizgrowth'),
		'type'  => 'array'
	) ); 
	if( is_array($pagin) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $pagin as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	} 
}

if ( ! function_exists( 'bizgrowth_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function bizgrowth_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


// get slug by id
function bizgrowth_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}