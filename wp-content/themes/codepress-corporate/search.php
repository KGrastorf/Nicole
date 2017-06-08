<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package codepress_corporate
 */


$post_banner_image = get_theme_mod( 'codepress_corporate_archive_banner_image' );
$layout_class = codepress_corporate_sidebar_layout_class();

$attachment_id = attachment_url_to_postid( $post_banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'codepress_corporate_banner_image_size' );

get_header(); ?>

<!-- Breadcrumb-start -->
		<section class="breadcrumb">
			<div class="parallax-image" <?php echo (!empty($image_array[0])) ? 'style="background: url(' . esc_url($image_array[0]) .' );"' : ''; ?>>
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


	<section id="primary" class="content-area <?php echo esc_attr(codepress_corporate_sidebar_class( $layout_class )); ?>">
		<main id="main" class="site-main" role="main">

	
			<div class="search-with-sidebar">
				<div class="wrapper">

					<div class="left-sidebar-content">

							<?php if( $layout_class == 'right-content' || $layout_class == 'content-middle-area' ) {  ?>						
								<aside id="secondary" class="widget-area left-sidebar" role="complementary">
									<?php 
										if(is_active_sidebar('left-sidebar')){
											dynamic_sidebar('left-sidebar');
										} 
									?>						
								</aside> 
							<?php } ?>


								<?php
								if ( have_posts() ) { ?>

									<div class="search-page <?php echo esc_html($layout_class); ?>" id="cc-blog-page-jetpack"> 
										<header class="page-header">
											<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'codepress-corporate' ), '<span>' . get_search_query() . '</span>' ); ?></h1> 
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

											the_posts_navigation(); ?>

									</div>
						
							
							<?php 
							}

							else {

								get_template_part( 'template-parts/content', 'none' );

							} ?>
							
					</div>

					<?php if( $layout_class == 'left-content' || $layout_class == 'content-middle-area' ) {  ?>
						
						<aside id="secondary" class="widget-area right-sidebar" role="complementary">
								<?php 
									if(is_active_sidebar('right-sidebar')){
										dynamic_sidebar('right-sidebar');
									} 
								?>
						
						</aside> 

					<?php } ?>


				</div>	


			</div>
		</main><!-- #main -->
	</section><!-- #primary -->
    
   

<?php
get_footer();