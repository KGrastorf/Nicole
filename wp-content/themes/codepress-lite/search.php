<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
        	<div class="header-title-wrap">
        		<h1 class="header-title"><?php _e('Search', 'codepress-lite'); ?></h1>
        		<?php echo codepress_lite_breadcrumbs(); ?>
        	</div>
        </div>
    </div>
    
    
    <div class="main-content-section blog">
        <div class="container">
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
        	<section id="primary" class="content-area">
        		<main id="main" class="site-main" role="main">
        
        		<?php
        		if ( have_posts() ) : ?>
        
        			<header class="page-header">
        				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'codepress-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        			</header><!-- .page-header -->
        
        			<?php
        			/* Start the Loop */
        			while ( have_posts() ) : the_post();
        
        				/**
        				 * Run the loop for the search to output the results.
        				 * If you want to overload this in a child theme then include a file
        				 * called content-search.php and that will be used instead.
        				 */
        				get_template_part( 'template-parts/content', 'search' );
        
        			endwhile;
                    $nav_args = array(
                                    'prev_text' => '<span class="meta-nav"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>' . __('Older Posts', 'codepress-lite' ),
                                    'next_text' => __('Newer Posts', 'codepress-lite' ) . '<span class="meta-nav"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>',
                                );
        			the_posts_navigation($nav_args);
        
        		else :
        
        			get_template_part( 'template-parts/content', 'none' );
        
        		endif; ?>
        
        		</main><!-- #main -->
        	</section><!-- #primary -->
            
            <?php 
            if($page_sidebar_layout == 'right-sidebar' || $page_sidebar_layout == 'both-sidebar'):
                    get_sidebar(); 
                endif;
             ?>
        </div>
    </div>

<?php

get_footer();
