<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package codepress_corporate
 */

get_header(); 


$post_banner_image = get_theme_mod( 'codepress_corporate_archive_banner_image' );
$attachment_id = attachment_url_to_postid( $post_banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'codepress_corporate_banner_image_size' );

$layout_class = codepress_corporate_sidebar_layout_class();
?>

<!-- Breadcrumb-start -->
		<section class="breadcrumb">
			<div class="parallax-image" <?php echo (!empty($image_array[0]))? 'style="background: url( ' . esc_url($image_array[0]) . '); "' : '' ?> >
				<div class="bg-black"></div>
			</div>
			<div class="wrapper">
				<div class="breadcrumb-menu">
					<div class="breadcrumb-title">
						<h2><?php the_archive_title( ); ?></h2>

						<?php //endif;  ?>
					</div>
				</div>
			</div> 
		</section> 
<!-- Breadcrumb-end -->


<div class="main-content">
	<div class="wrapper">
		<div class="content-page content-sep">
		<div id="primary" class="content-area <?php echo esc_attr(codepress_corporate_sidebar_class( $layout_class )); ?>">
			<main id="main" class="site-main" role="main"> 

						<?php
						if ( have_posts() ) : ?>
							<header class="page-header">
								<?php
									
									the_archive_description( '<div class="taxonomy-description">', '</div>' );
								?>
							</header><!-- .page-header -->


							<!--Left Sidebar-->
							<?php if($layout_class == 'right-content' || $layout_class == 'content-middle-area') { ?>
								<aside id="secondary" class="widget-area left-sidebar" role="complementary">
								<?php if(is_active_sidebar('left-sidebar')){
									dynamic_sidebar('left-sidebar');
									} ?>
								</aside>
							<?php } ?>
								<div class="content-post <?php echo esc_attr($layout_class); ?>" id="cc-blog-page-jetpack">
									<?php
									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'template-parts/content', get_post_format() );

									endwhile; 
									the_posts_navigation();
									?>

								</div>
							<?php 

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>

						<?php if($layout_class == 'left-content' || $layout_class == 'content-middle-area') { ?>
							<aside id="secondary" class="widget-area right-sidebar" role="complementary">
								<?php 
									if(is_active_sidebar('right-sidebar')){
									dynamic_sidebar('right-sidebar');
									} 
								?>
							</aside>
						<?php } ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		</div>
	</div>
</div>


<?php
get_footer();
?>