<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package codepress_corporate
 */

$post_banner_image = get_theme_mod( 'codepress_corporate_page_banner_image' );


get_header();

if( !empty($post_banner_image) ) {
	$banner_image = get_theme_mod( 'codepress_corporate_page_banner_image' );
}
else{
	$banner_image = get_theme_mod( 'codepress_corporate_archive_banner_image' ); //Default banner image
}

$attachment_id = attachment_url_to_postid( $banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'codepress_corporate_banner_image_size' ); 

$layout_class = codepress_corporate_sidebar_layout_class();

?>
		<?php if( !( is_home() ) ) { ?>
		<!-- Breadcrumb-start -->
		
		<section class="breadcrumb">
			<div class="parallax-image" <?php echo (!empty($image_array[0])) ? 'style="background: url( ' . esc_url($image_array[0]) .' );"' : ''; ?>>
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
	<?php } ?>

		<div class="main-content">

			<div class="wrapper">

				<div class="content-page content-sep"> 

					<div id="primary" class="content-area <?php echo esc_attr(codepress_corporate_sidebar_class( $layout_class )); ?>">
						<main id="main" class="site-main" role="main">

							<?php
							while ( have_posts() ) : the_post(); 

								get_template_part( 'template-parts/content', 'page' );


								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>

						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
			</div>
		</div>
<?php
get_footer();