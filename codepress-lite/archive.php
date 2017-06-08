<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
        <div class="header-titlebar-wrapper" style="<?php echo (!empty($image_array[0]))? 'background: url( '.esc_url($image_array[0]).');' : ''; ?> background-size:cover; background-repeat: no-repeat;">
        	<div class="header-titlebar-overlay"> </div>
            
        	<div class="header-title-wrap wow zoomIn">
        		<h1 class="header-title"><?php the_archive_title(); ?></h1>
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
	<div id="primary" class="content-area">
    <div class="col-wrapper clearfix">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header wow fadeInUp">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
            $count = 1;
			/* Start the Loop */
			while ( have_posts() ) : the_post();
                ?>
                <div class="col-2">
					<div class="cp-blog-wrapper">
						<div class="post-slide">
                        
                        <?php
        
        				/*
        				 * Include the Post-Format-specific template for the content.
        				 * If you want to override this in a child theme, then include a file
        				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        				 */
        				get_template_part( 'template-parts/content', get_post_format() );
                        ?>
                        
                        </div>
                    </div>
                </div>
                    
                <?php 
                if($page_sidebar_layout == 'no-sidebar' && $count % 3 == 0)
                {
                    ?>
                    <div class="clearfix"></div>
                    <?php
                }
                elseif(($page_sidebar_layout == 'left-sidebar' || $page_sidebar_layout == 'right-sidebar') && $count %2 == 0 )
                {
                    ?>
                    <div class="clearfix"></div>
                    <?php
                }
                
                $count++;

			endwhile;
            ?>
            <div class="clear"></div>
            <?php
            
            $nav_args = array(
                                    'prev_text' =>  '<span class="meta-nav"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>' . __('Older Posts', 'codepress-lite' ),
                                    'next_text' =>  __('Newer Posts','codepress-lite') . '<span class="meta-nav"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>',
                                );
			the_posts_navigation($nav_args);

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
        </div>
	</div><!-- #primary -->
    <?php 
    if($page_sidebar_layout == 'right-sidebar' || $page_sidebar_layout == 'both-sidebar' || $page_sidebar_layout == ''):
            get_sidebar(); 
        endif;
     ?>
    </div>
    </div>
<?php

get_footer();
