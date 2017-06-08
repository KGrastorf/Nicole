<?php
/**
 * The template for displaying 404 pages (not found).
 *
 *
 * @package codepress_corporate
 */

get_header(); ?>


<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">
					<div class="wrapper">
						<header class="page-header wow zoomIn">
							<h1 class="page-title"><?php esc_html_e('404','codepress-corporate'); ?></h1>
							<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'codepress-corporate' ); ?></h2>
						</header><!-- .page-header -->

						<div class="page-content wow zoomIn">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'codepress-corporate' ); ?></p> 
						</div>

						<section id="search-2" class="widget widget_search search-404 wow zoomIn">
						
							<?php  get_search_form(); ?>
							
						</section>
						<div class="back-to-home wow zoomIn">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Back to Home Page', 'codepress-corporate'); ?></a>
						</div>
					</div> 
				</section>

			</main><!-- #main -->
		</div><!-- #primary -->

<?php
get_footer();