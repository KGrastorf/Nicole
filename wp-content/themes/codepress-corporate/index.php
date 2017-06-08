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
 * @package codepress_corporate
 */

get_header(); 


$post_banner_image = get_theme_mod( 'codepress_corporate_archive_banner_image' );
$attachment_id = attachment_url_to_postid( $post_banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'codepress_corporate_banner_image_size' );

?>
<!-- Breadcrumb-start -->
		<section class="breadcrumb">
			<div class="parallax-image" <?php echo (!empty($image_array[0])) ? 'style="background: url(' . esc_url($image_array[0]) . ' ); "' : ''; ?>>
				<div class="bg-black"></div>
			</div>
			<div class="wrapper">
				<div class="breadcrumb-menu">
					<div class="breadcrumb-title">
                    <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'site-title' )); ?></a></h2>
					</div>
				</div>
			</div> 
		</section> 
<!-- Breadcrumb-end -->
        
		<!-- Body part start --> 

		<div class="main-content blog-archive">
			<div class="wrapper">
				<section id="primary" class="content-area">
					<main id="main" class="site-main" role="main"> 
						<div class="content-page content-sep">

							<div class="blog-page left-content"> 
								<?php 

									while( have_posts() ) : the_post(); 
								?>		

									<article id="post-<?php the_ID(); ?>" class="post"> 
										<header class="entry-header"> 

										<?php 

										$post_title = get_the_title();

										if ( $post_title ) : ?> 

											<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>		
										
										<?php endif; 								
										?>	
										
											<div class="entry-meta">
											
												<span><i class="fa fa-calendar"></i><a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')));  ?>"><?php echo esc_attr(get_the_date());   ?></a></span>
											
												<span><i class="fa fa-user"></i><a href="<?php echo esc_url(get_the_author_link()); ?>"><?php the_author(); ?></a></span>
												<span><i class="fa fa-comment"></i><a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number( __('no responses','codepress-corporate'), __('one response','codepress-corporate'), __('% responses','codepress-corporate') ); ?></a></span>
											</div> 
										<?php  //endif; ?> 
										</header> 

									
										<div class="entry-content"> 
											<?php 
				                    			if ( has_post_thumbnail()) : 
				                     			 $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
				               					?>

													<div class="entry-content-img">
                                                    <?php if(!empty($image_url[0])){ ?>
														<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>"><!-- https://pixabay.com/en/turret-arch-snow-winter-sandstone-1364314/ --> 
                                                        <?php } ?>
													</div>

											<?php endif; ?>
													<p> <?php codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_service_excerpt_length', 100 ) );
                                                    the_excerpt();
                                                    codepress_corporate_remove_excerpt_length();
                                                  ?> </p> 
													
													<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'codepress-corporate' ); ?></a> 
										</div> 
									</article> 

								<?php endwhile; ?> 
								
								<nav class="navigation post-navigation" role="navigation">

									<?php the_posts_navigation(); ?>
								</nav>

							</div> 

						<aside id="secondary" class="widget-area right-sidebar" role="complementary">
							<?php 
								if(is_active_sidebar('right-sidebar')){
									dynamic_sidebar('right-sidebar');
								} 
							?>
					
						</aside> 
					</div> 
				</main>
			</section>
		</div>
	</div> 

		<!-- Body part end -->	

<?php
//get_sidebar();
get_footer();

?>