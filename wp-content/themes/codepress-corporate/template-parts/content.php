<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package codepress_corporate
 */

$post_banner_image = get_theme_mod( 'codepress_corporate_post_banner_image' );
$post_feature_image = get_theme_mod( 'codepress_corporate_activate_post_featutred_image', 1 );
$post_comment = get_theme_mod( 'codepress_corporate_activate_post_comment', 1 );

$layout_class = codepress_corporate_sidebar_layout_class();
?>
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 
				<header class="entry-header wow fadeInDown">
					<?php
						if ( is_single() ) {
							the_title( '<h1 class="entry-title">', '</h1>' );
						} else {
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						}

					if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<span><i class="fa fa-calendar"></i><a href="<?php the_permalink(); ?>"><?php echo esc_attr(get_the_date()); ?></a></span>
						<span><i class="fa fa-user"></i><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a></span>
						<span><i class="fa fa-comment"></i><a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number( __('no responses','codepress-corporate'), __('one response','codepress-corporate'), __('% responses','codepress-corporate') ); ?></a></span>
					</div><!-- .entry-meta --> 
					<?php
					endif; ?>
				</header><!-- .entry-header -->

				<div class="entry-content wow fadeInUp">
					<?php if( $post_feature_image == 1 ) : 
					?>

					<div class="entry-content-img"> 
					
						<?php the_post_thumbnail(); ?>
					<?php //endif; ?>
					</div>
					<?php endif; ?>

					<?php 
					if( is_single() ) {
						the_content();
					}
					else {
					   ?>
                       <p>
                       <?php
					 codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_service_excerpt_length', 100 ) );
                                                    the_excerpt();
                                                    codepress_corporate_remove_excerpt_length();
                                                  ?> 
                                                    </p> 
													
													<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'codepress-corporate' ); ?></a> 
                                                    <?php 
					}
					?>
					
			
					<?php
						//the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'codepress-corporate' ),
							'after'  => '</div>',
						) );
					?>
					
				</div>

				<?php 
				if(is_single()):
					
				?>
					<footer class="entry-footer">
						<?php esc_attr(codepress_corporate_entry_footer()); ?>
					</footer><!-- .entry-footer -->
				<?php
					the_post_navigation();
				endif;
				?>

			</article><!-- #post-## -->

			<?php 
			

			if( $post_comment == 1 ) : ?>
            
			<div class="post-comments">
				<h2><?php comments_template(); ?></h2>
			</div>
            
			<?php endif; ?>