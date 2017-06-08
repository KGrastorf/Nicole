<?php
/**
 * Template part for displaying results in search pages.
 *
 *
 * @package codepress_corporate
 */
 
 

 $layout_class = codepress_corporate_sidebar_layout_class();

 
?>
 

			<article id="post-1" class="post">
				<header class="entry-header wow fadeInUp">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						
					
					<?php if ( 'post' === get_post_type() ) : ?>
						<div class="entry-meta">
						<span><i class="fa fa-calendar"></i><a href="<?php the_permalink();   ?></a></span>
						<span><i class="fa fa-user"></i><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a></span>
						<span><i class="fa fa-comment"></i><a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number( 'no responses', 'one response', '% responses' ); ?></a></span>
							
						</div><!-- .entry-meta -->
					<?php endif; ?>

				</header> 

				<div class="entry-content wow fadeInUp">

					<?php 
	        			if ( has_post_thumbnail()) : 
	         			 $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
						?> 

						<div class="entry-content-img">
                            <?php if(!empty($image_url[0])){ ?>
							<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php } ?>
						</div>
					<?php endif; ?>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'codepress-corporate' ); ?></a>
				</div> 
			</article>   