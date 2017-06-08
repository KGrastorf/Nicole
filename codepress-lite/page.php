<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Codepress_Lite
 */

get_header(); ?>
    <?php 
    $page_banner = get_theme_mod('codepress_lite_page_banner_setting'); 
    if(!empty($page_banner)):
        $attachment_id = attachment_url_to_postid( $page_banner );
        $image_array = wp_get_attachment_image_src( $attachment_id, 'codepress-lite-codepress_lite_banner' );
    endif; 
    ?>
    <div class="header-image-main-wrap">
        <div class="header-titlebar-wrapper" style="<?php echo (!empty($image_array[0])) ? 'background: url( '.esc_url($image_array[0]).');' : ''; ?> background-size:cover; background-repeat: no-repeat;">
        	<div class="header-titlebar-overlay"> </div>
        	<div class="header-title-wrap wow zoomIn">
        		<h1 class="header-title"><?php echo get_the_title(); ?></h1>
        		<?php echo codepress_lite_breadcrumbs(); ?>
        	</div>
        </div>
    </div>
    <div class="main-content-section blog-single">
    
    <div class="container">
    
    <?php 
    $page_sidebar_layout = get_post_meta(get_the_ID(),'codepress_lite_sidebar_layout', true); 
    if($page_sidebar_layout == 'left-sidebar' || $page_sidebar_layout == 'both-sidebar'):
        ?>
        <?php if ( (class_exists( 'WooCommerce' ) ) && ( is_cart() || is_checkout() || is_account_page() ) ) { ?>
            <aside id="secondary" class="widget-area" role="complementary">
        	   <?php dynamic_sidebar('woocommerce-sidebar-left'); ?>
            </aside><!-- #secondary -->
        <?php } 
            else {
        ?>
        
            <aside id="secondary" class="widget-area" role="complementary">
        	   <?php dynamic_sidebar('left-sidebar'); ?>
            </aside><!-- #secondary -->
        
        <?php }
        endif;
    ?>
    
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
    
    <?php 
    if($page_sidebar_layout == 'right-sidebar' || $page_sidebar_layout == 'both-sidebar' || $page_sidebar_layout == ''):
         if ( class_exists( 'WooCommerce' )  && ( is_cart() || is_checkout() || is_account_page() ) ) { ?>
            
            <aside id="secondary" class="widget-area" role="complementary">
        	   <?php dynamic_sidebar('woocommerce-sidebar-right'); ?>
            </aside><!-- #secondary -->
         
         <?php } 
            else {
        
            get_sidebar(); 
            
            }
         endif;
     ?>
    
    </div>
</div>
<?php
get_footer();
