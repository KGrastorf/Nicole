<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Codepress_Lite
 */

?>

			<article class="hentry" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="cp-blog-wrapper">
					<div class="post-slide">
                        <?php if(has_post_thumbnail()): ?>
						<div class="post-img wow fadeInUp">
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
						<div class="post-content wow fadeInUp">
							<div class="post-on">
								<span><?php echo esc_html( get_the_date( 'j M' ) );?></span>
							</div>
							<div class="auther-title-wrap">
    							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    							<div class="auther"><span><?php _e('by', 'codepress-lite'); ?> </span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></div>
							</div>
								<div class="post-meta">
									<ul class="post-bar">
									   <li class="comments"><i class="fa fa-comments-o"></i><?php comments_popup_link( '0', '1', '%', '', '-' ); ?></li>
										
										<li><i class="fa fa-folder-open"></i>
                                            <?php if(is_single()) codepress_lite_category(); else { codepress_lite_category(1); } ?>
                                        </li>
									</ul>
								</div>
							
							<?php
                                if(is_single()):
                    			     ?>
                                     <div class="post-description wow fadeInUp">
                                     <?php
                                    the_content( sprintf(
                        				/* translators: %s: Name of current post. */
                        				wp_kses( balanceTags( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'codepress-lite' ), array( 'span' => array( 'class' => array() ) ) ),
                        				the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        			) );
                                    ?>
                                    </div>
                                    <?php
                                    else: ?>
                                    <div class="post-description wow fadeInUp">
    								    <?php the_excerpt(); ?>
                                    </div>
                                    <a class="button" href="<?php the_permalink(); ?>"><?php _e('Read More', 'codepress-lite'); ?></a>
                                    <?php
                                endif;
                    
                    			wp_link_pages( array(
                    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'codepress-lite' ),
                    				'after'  => '</div>',
                    			) );
                    		?>
                            
						</div>
					</div>
				</div>
				
                <?php //codepress_lite_entry_footer(); 
                if(is_single()):
                $posttags = get_the_tags();
                    if ($posttags) {
                ?>
            	<footer class="entry-footer wow fadeInUp">
            		
                        <div class="tag_wrapper">
                    <?php
                        
                          foreach($posttags as $tag) {
                            ?>
                              <div class="tag_single_wrap"><a href="<?php echo esc_url(site_url().'/tag/'.$tag->slug); ?>"><?php echo esc_html($tag->name); ?></a></div>
                          <?php
                          
                        }
                        ?>
                        </div>
                    
                    
            	</footer><!-- .entry-footer -->
                <?php
                }
                endif; ?>
				
        </article>
		