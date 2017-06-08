<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Oner
 */
 
/**
 * Setup the WordPress core custom header feature.
 *
 * @uses oner_header_style()  
 * @uses oner_admin_header_style() 
 * @uses oner_admin_header_image()   
 *
 * @package Oner
 */
function oner_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'oner_custom_header_args', array(
		'default-image'          => '',
		'header-text'            => true,
		'default-text-color'     => '',   
		'width'                  => 1920,
		'height'                 => 400,
		'flex-height'            => true, 
		'wp-head-callback'       => 'oner_header_style',
		'admin-head-callback'    => 'oner_admin_header_style',
		'admin-preview-callback' => 'oner_admin_header_image',
	) ) );
}

add_action( 'after_setup_theme', 'oner_custom_header_setup' );



if ( ! function_exists( 'oner_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see oner_custom_header_setup().  
 */
function oner_header_style() {
	if ( get_header_image() ) {
	?>
	<style type="text/css">    
		.header-image {
			background-image: url(<?php echo get_header_image(); ?>);
			display: block;
		}
        .header-inner {
        	
        }
	</style>
	<?php
	}
}
endif; // oner_header_style

if ( ! function_exists( 'oner_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see oner_custom_header_setup().
 */
function oner_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // oner_admin_header_style

if ( ! function_exists( 'oner_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see oner_custom_header_setup().
 */
function oner_admin_header_image() { 
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		        <img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // oner_admin_header_image
