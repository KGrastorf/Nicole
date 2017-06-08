<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Codepress_Lite
 */

get_header(); 

?>

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
        		<main id="main" class="site-main" role="main">
        
        		<?php
        		if ( have_posts() ) :
        
        			if ( is_home() && ! is_front_page() ) : ?>
        				<header>
        					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        				</header>
        
        			<?php
        			endif;
                    $count = 1;
        			/* Start the Loop */
        			while ( have_posts() ) : the_post();
        
        				/* 
        				 * Include the Post-Format-specific template for the content.
        				 * If you want to override this in a child theme, then include a file
        				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        				 */
        				//get_template_part( 'template-parts/content', get_post_format() );
                        ?>
                        <div class="col-2">
        					<div class="cp-blog-wrapper">
        						<div class="post-slide">
                                    <?php if(has_post_thumbnail()): ?>
        							<div class="post-img">
        								<a href="<?php the_permalink(); ?>">
                                        <?php 
                                        the_post_thumbnail('codepress-lite-blog-thumb', array( 
                    						'alt' => esc_attr(get_the_title()),
                    						'title' => esc_attr(get_the_title()),
                                            ));
                                        ?>
                                        </a>
        							</div>
                                    <?php endif; ?>
        							<div class="post-content">
        								<div class="post-on">
        									<span><?php echo esc_html( get_the_date( 'j M' ) );?></span>
        									
        								</div>
        								<div class="auther-title-wrap">
            								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            								<div class="auther"><span><?php _e('by', 'codepress-lite'); ?> </span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></div>
        								</div>
                                        
        								<div class="post-meta">
        									<ul class="post-bar">
                                                <li class="comments"><i class="fa fa-comments-o"></i><?php comments_popup_link( __('No comment', 'codepress-lite'), '1', '%', '', '-' ); ?></li>
        										
        										<li><i class="fa fa-folder-open"></i>
                                                    <?php codepress_lite_category(1) ?>
                                                </li>
        									</ul>
        								</div>
        								<div class="post-description">
        								    <?php 
                                            the_excerpt() ?>
                                        </div>
        								<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read More', 'codepress-lite'); ?></a>
        							</div>
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
                                    'prev_text' => '<span class="meta-nav"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>' . __( 'Older Posts', 'codepress-lite' ),
                                    'next_text' => __( 'Newer Posts', 'codepress-lite' ) .' <span class="meta-nav"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>',
                                );
        			the_posts_navigation($nav_args);
        
        		else :
        
        			get_template_part( 'template-parts/content', 'none' );
        
        		endif; ?>
        
        		</main><!-- #main -->
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
