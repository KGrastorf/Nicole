<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

     <?php 
        $post_banner = get_theme_mod('codepress_lite_default_banner_setting'); 
        if(!empty($post_banner)):
            $attachment_id = attachment_url_to_postid( $post_banner );
            $image_array = wp_get_attachment_image_src( $attachment_id, 'codepress-lite-codepress_lite_banner' );
        endif;
    ?>

    <div class="header-image-main-wrap">
        <div class="header-titlebar-wrapper" style="<?php echo (!empty($image_array[0])) ? 'background: url( '.esc_url($image_array[0]).');' : ''; ?> background-size:cover; background-repeat: no-repeat;">
        	<div class="header-titlebar-overlay"> </div>
        	<div class="header-title-wrap wow zoomIn">
        		<h1 class="header-title"><?php ( !is_search() ) ? woocommerce_page_title() : esc_html_e('Search', 'codepress-lite'); ?></h1> 
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
            $page_sidebar_layout = get_theme_mod('codepress_lite_default_sidebar_setting', 'right-sidebar'); 
            
            if($page_sidebar_layout == 'left-sidebar' || $page_sidebar_layout == 'both-sidebar'): ?>
                <aside id="secondary" class="widget-area" role="complementary">
                    <?php dynamic_sidebar('woocommerce-sidebar-left'); ?>
                </aside>
            
                <?php 
                endif;
            ?>
            


            <div id="primary" class="content-area">
            
            <main id="main" class="site-main" role="main">


        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

            <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

        <?php endif; ?>

        <?php
            /**
             * woocommerce_archive_description hook.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
        ?>

        <?php if ( have_posts() ) : ?>

            <?php
                /**
                 * woocommerce_before_shop_loop hook.
                 *
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
            ?>

            <?php woocommerce_product_loop_start(); ?>

                <?php woocommerce_product_subcategories(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php
                /**
                 * woocommerce_after_shop_loop hook.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            ?>

        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

            <?php wc_get_template( 'loop/no-products-found.php' ); ?>

        <?php endif; ?>

    <?php
        /**
         * woocommerce_after_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>

        </main><!-- #main -->
        </div>
    

    <?php 
    if($page_sidebar_layout == 'right-sidebar' || $page_sidebar_layout == 'both-sidebar' || $page_sidebar_layout == ''):
            ?>
            <aside id="secondary" class="widget-area" role="complementary">
                <?php  dynamic_sidebar('woocommerce-sidebar-right'); ?>
            </aside><!-- #secondary -->
            
            <?php 
        endif;
     ?>
     </div><!-- #primary --> 
    </div>

<?php get_footer( 'shop' ); ?> 
