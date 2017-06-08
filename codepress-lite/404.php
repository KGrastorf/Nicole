<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Codepress_Lite
 */

get_header(); ?>
    
    
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
        		<h1 class="header-title"><?php echo __('404', 'codepress-lite'); ?></h1>
        		<?php echo codepress_lite_breadcrumbs(); ?>
        	</div>
        </div>
    </div>
    
    <div class="main-content-section error-page">
    	<div class="container clearfix">
        <?php 
        $page_sidebar_layout = get_theme_mod('codepress_lite_default_sidebar_setting', 'right-sidebar'); 
        if($page_sidebar_layout == 'left-sidebar' || $page_sidebar_layout == 'both-sidebar'):
            ?>
            <aside id="secondary" class="widget-area" role="complementary">
        	   <?php dynamic_sidebar('left-sidebar'); ?>
            </aside><!-- #secondary -->
        <?php 
        endif;
        ?>
    		<div id="primary" class="content-area">
    				<section class="error-404 not-found">
    					<div class="page-content clearfix">
    						<div class="error-wrap wow fadeInUp">
    							<span class="num-404"> 404 </span>
    							<span class="error"><?php _e('Page NOt Found', 'codepress-lite')?></span>
    						</div>
    						<header class="page-header wow fadeInUp">
    							<h1 class="page-title"><span class="Oops"><?php _e('Oops!!', 'codepress-lite'); ?></span> <span class="error-message"><?php echo esc_html__('That page can&rsquo;t be found.', 'codepress-lite'); ?></span></h1>
    						</header>
    						<div class="form-wrapper wow fadeInUp">
    							<?php get_search_form(); ?>
    						</div>
    					</div>
    				</section>
    			
    
    		</div> <!-- Primary end -->
    
    		<?php 
            if($page_sidebar_layout == 'right-sidebar' || $page_sidebar_layout == 'both-sidebar' || $page_sidebar_layout == ''):
                    get_sidebar(); 
                endif;
             ?>
    
    	</div>
    </div>	

<?php
get_footer();
