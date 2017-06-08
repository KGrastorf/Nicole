<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package codepress_corporate
 */
 
$layout_class = codepress_corporate_sidebar_layout_class();
?>

                    
		<div class="search-page <?php echo esc_attr($layout_class); ?>"> 

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'codepress-corporate' ), '<span>' . get_search_query() . '</span>' ); ?></h1> 
			</header><!-- .page-header -->  

			 <section class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Nothing Found !', 'codepress-corporate' ); ?></h1>
					
				</header><!-- .page-header -->

				<div class="page-content">  

					<?php
						if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

							<p><?php printf( codepress_corporate_textarea_saniize( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.' ), array( 'a' => array( 'href' => array() ) ) , admin_url( 'post-new.php' ) ); ?></p>

						<?php elseif ( is_search() ) : ?>

							<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'codepress-corporate' ); ?></p>
							
						<?php endif; ?>

					
					 <section id="search-2" class="widget widget_search search-404">

					 <?php get_search_form(); ?>
						
					</section>
				</div><!-- .page-content -->
			</section><!-- .no-results --> 
		</div> 