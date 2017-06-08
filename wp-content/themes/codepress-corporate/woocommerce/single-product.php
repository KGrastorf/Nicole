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

get_header( 'shop' ); 

$post_banner_image = get_theme_mod( 'codepress_corporate_archive_banner_image' );
$attachment_id = attachment_url_to_postid( $post_banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'codepress_corporate_banner_image_size' );

$layout_class = codepress_corporate_sidebar_layout_class();

?>

<!-- Breadcrumb-start -->
        <section class="breadcrumb">
            <div class="parallax-image" <?php echo (!empty($image_array[0])) ? 'style="background: url(' .  esc_url($image_array[0]) . ');"' : ''; ?>>
                <div class="bg-black"></div>
            </div>
            <div class="wrapper">
                <div class="breadcrumb-menu">
                    <div class="breadcrumb-title">
                        <h2><?php the_title(); ?></h2> 
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
        </section> 
<!-- Breadcrumb-end -->

    <div class="main-content">
        <div class="wrapper">
                <div class="content-page content-sep"> 

                    <div id="primary" class="content-area left-content <?php echo esc_attr(codepress_corporate_sidebar_class( $layout_class )); ?> ">
                        <main id="main" class="site-main" role="main">
                            
                            <div class="left-sidebar-content">
                            <?php if($layout_class == 'right-content' || $layout_class == 'content-middle-area') { ?>
                                <aside id="secondary" class="widget-area left-sidebar" role="complementary">
    								<?php 
    									if(is_active_sidebar('woocommerce-sidebar-left')){
    									dynamic_sidebar('woocommerce-sidebar-left');
    									} 
    								?>
    							</aside>
                            <?php } ?>       
                            <div class="content-post <?php echo esc_attr($layout_class); ?>"> 
                    	
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
                        </div>
                        </div>
                        
	                     <?php if($layout_class == 'left-content' || $layout_class == 'content-middle-area') { ?>
                          <aside id="secondary" class="widget-area right-sidebar" role="complementary">
							<?php 
								if(is_active_sidebar('woocommerce-sidebar-right')){
								dynamic_sidebar('woocommerce-sidebar-right');
								} 
							?>
						</aside>
                        
                      <?php } ?> 
                      
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>
</div>

<?php get_footer( 'shop' ); ?>
