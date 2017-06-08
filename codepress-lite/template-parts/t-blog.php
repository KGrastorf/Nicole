<?php

/** 
 * Template Name: Blog
 * 
 * Used for displaying Blog page 
 * 
 * @package CodePress Lite 
 * @author CodeTrendy
 */
 
 get_header();
 ?>
 
 
 <?php 
    $page_banner = get_theme_mod('codepress_lite_page_banner_setting'); 
    if(!empty($page_banner)):
        $attachment_id = attachment_url_to_postid( $page_banner );
        $image_array = wp_get_attachment_image_src( $attachment_id, 'codepress-lite-codepress_lite_banner' );
    endif;  
    ?>
    <div class="header-image-main-wrap">
        <div class="header-titlebar-wrapper clearfix" style="<?php echo (!empty($image_array[0])) ? 'background: url( '.esc_url($image_array[0]).');' : ''; ?> background-size:cover; background-repeat: no-repeat;">
        	<div class="header-titlebar-overlay"> </div>
        	<div class="header-title-wrap">
        		<h1 class="header-title"><?php echo get_the_title(); ?></h1>
        		<?php echo codepress_lite_breadcrumbs(); ?>
        	</div>
        </div>
    </div>
 
 

<div class="main-content-section blog">
	<div class="container">
        <?php 
        $page_sidebar_layout = get_post_meta(get_the_ID(),'codepress_lite_sidebar_layout', true); 
        if($page_sidebar_layout == 'left-sidebar' || $page_sidebar_layout == 'both-sidebar'):
            ?>
            <aside id="secondary" class="widget-area" role="complementary">
        	   <?php dynamic_sidebar('left-sidebar'); ?>
            </aside><!-- #secondary -->
            <?php 
            endif;
        ?>
		<div id="primary" class="content-area">
        <?php
		while ( have_posts() ) : the_post();
        ?>
			<div class="col-wrapper clearfix">
                
                <?php
    			$category = get_theme_mod('codepress_lite_blog_setting');
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                $blog_args = array('posts_per_page' => 10, 
                        			'post_status' => 'publish', 
                        			'ignore_sticky_posts' => true, 
                        			'post_type' => 'post',
                                    'paged'=> $paged, 
                                    'cat' => absint($category)
                                );
                $blog_query = new WP_Query($blog_args);
                $count = 1;
                while($blog_query->have_posts()): $blog_query->the_post();
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
									<span><?php echo esc_html( get_the_date( 'j M' ) );?> </span>
									
								</div>
								<div class="auther-title-wrap">
    								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    								<div class="auther"><span><?php _e('by', 'codepress-lite'); ?> </span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></div>
								</div>
                                
								<div class="post-meta">
									<ul class="post-bar">
                                        <li class="comments"><i class="fa fa-comments-o"></i><?php comments_popup_link( '0', '1', '%', '', '-' ); ?></li>
										
										<li><i class="fa fa-folder-open"></i>
                                            <?php codepress_lite_category(1) ?>
                                        </li>
									</ul>
								</div>
								<div class="post-description">
								    <?php the_excerpt(); ?>
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
	
			</div>
            
            <?php if($blog_query->max_num_pages > 1): ?>
            <div class="paginate">            
                <?php
                $big = 999999999; // need an unlikely integer
                
                echo paginate_links( array(
                	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                	'format' => '?paged=%#%',
                	'current' => max( 1, get_query_var('paged') ),
                	'total' => $blog_query->max_num_pages
                ) );
                ?>
            </div>
            <?php endif; ?>
            
            <?php
    		endwhile; // End of the loop.
    			?>
		</div>
		
		<?php  
        if($page_sidebar_layout == 'right-sidebar' || $page_sidebar_layout == 'both-sidebar' || $page_sidebar_layout == ''):
                get_sidebar(); 
            endif;
         ?>
	</div>
</div>
<?php get_footer(); ?>