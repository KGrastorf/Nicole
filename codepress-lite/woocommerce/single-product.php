<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>

<?php 
    $post_banner = get_theme_mod('codepress_lite_post_banner_setting'); 
    
    if(!empty($post_banner)):
        $attachment_id = attachment_url_to_postid( $post_banner ); 
        $image_array = wp_get_attachment_image_src( $attachment_id, 'codepress-lite-codepress_lite_banner' );
    endif;
    ?>

    <div class="header-image-main-wrap">
        <div class="header-titlebar-wrapper" style="<?php echo (!empty($image_array[0])) ? 'background: url( '.esc_url($image_array[0]).');' : ''; ?> background-size:cover; background-repeat: no-repeat;">
        	<div class="header-titlebar-overlay"> </div>
        	<div class="header-title-wrap wow zoomIn">
        		<h1 class="header-title"><?php echo get_the_title(); ?></h1> 
    		<?php
				/**
				 * woocommerce_before_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
			?>
    	</div>
        </div>
    </div>

    <div class="main-content-section blog-single">
    	<div class="container">
            
            <?php 
            //$page_sidebar_layout = get_post_meta(get_the_ID(),'codepress_pro_sidebar_layout', true); 
            $page_sidebar_layout = get_theme_mod('codepress_lite_default_sidebar_setting', 'right-sidebar'); 
            
            //var_dump($page_sidebar_layout);
            
            if($page_sidebar_layout == 'left-sidebar' || $page_sidebar_layout == 'both-sidebar'):
                ?>
                <aside id="secondary" class="widget-area" role="complementary">
            	   <?php dynamic_sidebar('woocommerce-sidebar-left'); ?>
                </aside><!-- #secondary -->
            	   <?php
            		/**
            		 * woocommerce_sidebar hook.
            		 *
            		 * @hooked woocommerce_get_sidebar - 10
            		 */
            	//	do_action( 'woocommerce_sidebar' );
            	?>
                <?php
                endif;
            ?>
            

    		<div id="primary" class="content-area">
            
            <main id="main" class="site-main" role="main">


	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>


		</main><!-- #main -->
        
	   </div><!-- #primary -->

	
<?php  
        if($page_sidebar_layout == 'right-sidebar' || $page_sidebar_layout == 'both-sidebar' || $page_sidebar_layout == ''):
               ?>
               <aside id="secondary" class="widget-area" role="complementary">
                <?php  dynamic_sidebar('woocommerce-sidebar-right'); ?>
            </aside><!-- #secondary -->
                  <?php 
                  //get_sidebar();
                  //dynamic_sidebar( 'woocommerce-sidebar-right' ); ?>
               <?php
            endif;
         ?>

        
        </div>
	</div>

<?php get_footer( 'shop' ); ?>
