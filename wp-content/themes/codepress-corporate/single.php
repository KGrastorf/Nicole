<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package codepress_corporate
 */

$post_banner_image = get_theme_mod( 'codepress_corporate_post_banner_image' );

get_header(); 

$layout_class = codepress_corporate_sidebar_layout_class();

if( !empty($post_banner_image) ) {
	$banner_image = get_theme_mod( 'codepress_corporate_post_banner_image' );
}
else{
	$banner_image = get_theme_mod( 'codepress_corporate_archive_banner_image' ); //Default banner image
}


$attachment_id = attachment_url_to_postid( $banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'codepress_corporate_banner_image_size' );
?>

<!-- Breadcrumb-start -->
		<section class="breadcrumb">
			<div class="parallax-image" <?php echo (!empty($image_array[0])) ? 'style="background: url(' . esc_url($image_array[0]) .' ); "' : ''; ?>>
				<div class="bg-black"></div>
			</div>
			<div class="wrapper">
				<div class="breadcrumb-menu">
					<div class="breadcrumb-title">
						<h2><?php the_title(); ?></h2>
					</div>
				</div>
			</div> 
		</section> 
		<!-- Breadcrumb-end -->


	<div class="main-content">
		<div class="wrapper">
				<div class="content-page content-sep"> 

					<div id="primary" class="content-area <?php echo esc_attr(codepress_corporate_sidebar_class( $layout_class )); ?> ">
						<main id="main" class="site-main" role="main">
                        

							<div class="left-sidebar-content">
									<!--Left Sidebar-->
									<?php if($layout_class == 'right-content' || $layout_class == 'content-middle-area') { ?>
										<aside id="secondary" class="widget-area left-sidebar" role="complementary">
										<?php if(is_active_sidebar('left-sidebar')){
											dynamic_sidebar('left-sidebar');
											} ?>
										</aside>
									<?php } ?>

								<div class="content-post <?php echo esc_attr($layout_class); ?>"> 
									<?php
									while ( have_posts() ) : the_post();

										get_template_part( 'template-parts/content', get_post_format() );

										
									endwhile; // End of the loop.  

									

									?>
								</div>

							</div>
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