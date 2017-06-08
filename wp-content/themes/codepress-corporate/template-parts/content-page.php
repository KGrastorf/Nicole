<?php
/**
 * Template part for displaying page content in page.php..
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package codepress_corporate
 */


$post_feature_image = get_theme_mod( 'codepress_corporate_activate_featutred_image', 1 );
$page_commtent = get_theme_mod( 'codepress_corporate_activate_page_comment', 1 );

$layout_class = codepress_corporate_sidebar_layout_class();

?>


	<div class="left-sidebar-content">
	<!--Left Sidebar-->
		<?php if( $layout_class == 'right-content' || $layout_class == 'content-middle-area' ) { 
		  if( class_exists( 'WooCommerce' )  && ( is_cart() || is_checkout() || is_account_page() ) ) {
          ?>
			<aside id="secondary" class="widget-area left-sidebar" role="complementary">

				<?php if(is_active_sidebar('woocommerce-sidebar-left')){
					dynamic_sidebar('woocommerce-sidebar-left');
				} ?>

			</aside>
            <?php } 
                else {
            ?>
            <aside id="secondary" class="widget-area left-sidebar" role="complementary">

				<?php if(is_active_sidebar('left-sidebar')){
					dynamic_sidebar('left-sidebar');
				} ?>

			</aside>
		<?php } 
        
        } ?>

            <div class="content-post <?php echo esc_attr($layout_class); ?>">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
					<header class="entry-header">
						<h2 class="entry-title wow fadeInDown"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2> 
						
					</header><!-- .entry-header -->


					<div class="entry-content wow fadeInUp">
						<?php if( $post_feature_image == 1 ) : 
						?>

						<div class="entry-content-img">
						
						<?php the_post_thumbnail(); ?>
						
						</div>
						<?php endif; ?>
						<?php
							the_content();
            
							 if( $page_commtent == 1 ) : ?>
								<div class="post-comments">
									<h2><?php comments_template(); ?></h2>
								</div>
							<?php endif; 


							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'codepress-corporate' ),
								'after'  => '</div>', 
							) );
						?>

					</div>
				</article>
                

			</div>
	</div>
               
                          
	<!-- Right Sidebar -->
	<?php 
    if($layout_class == 'left-content' || $layout_class == 'content-middle-area') { 
    if( class_exists( 'WooCommerce' )  && ( is_cart() || is_checkout() || is_account_page() ) ) {  ?>
        	<aside id="secondary" class="widget-area right-sidebar" role="complementary">
    			<?php 
    				if(is_active_sidebar('woocommerce-sidebar-right')){
    				dynamic_sidebar('woocommerce-sidebar-right');
    				}
    			?>
    		</aside>
    <?php } 
        else {
     
	 ?>
		<aside id="secondary" class="widget-area right-sidebar" role="complementary">
			<?php 
				if(is_active_sidebar('right-sidebar')){
				dynamic_sidebar('right-sidebar');
				}
			?>
		</aside>
	<?php  
	} }
	?>		