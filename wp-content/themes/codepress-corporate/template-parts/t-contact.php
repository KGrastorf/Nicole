<?php 
/**
* Template Name: Contact Us
*@author CodeTrendy
*/

get_header();

$post_banner_image = get_theme_mod( 'codepress_corporate_page_banner_image' );
$post_feature_image = get_theme_mod( 'codepress_corporate_activate_featutred_image' );
$post_breadcumbs_separator = get_theme_mod( 'codepress_corporate_breadcumbs_separation' );
$page_commtent = get_theme_mod( 'codepress_corporate_activate_page_comment' );


$attachment_id = attachment_url_to_postid( $post_banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'codepress_corporate_banner_image_size' ); 


 if( have_posts() ) { 

   while(have_posts()) { the_post(); 
                            
?>

<!-- Breadcrumb-Start -->
<section class="breadcrumb">
	<div class="parallax-image" <?php echo (!empty($image_array[0])) ? 'style="background: url( ' . esc_url($image_array[0]) .  ');"' : ''; ?>>
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

		<div class="template-content wrapper wow fadeInUp">
			
			<div class="template-text">
			  <div class="title"><h2>
				<?php the_title(); ?></h2>
			  </div>

			  <?php codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_service_excerpt_length', 100 ) );
                the_excerpt();
                codepress_corporate_remove_excerpt_length();
              ?> 
            </div>
			<?php        
        			if ( has_post_thumbnail()) {
         			 $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'codepress_corporate_about_us_image_size' );
   					
   				?>
			<div class="template-content-img">
			     <?php if(!empty($image_url[0])){ ?>
				    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
			 <?php } ?>
			</div>			
			<?php } ?>
		</div>	
	
	<?php  

$contact_us_google_map_frame = get_theme_mod( 'codepress_corporate_google_map_frame' ); 
$contact_page_shortcode = get_theme_mod( 'codepress_corporate_teplate_home_shortcode' );

?>

<div class="main-content">
			<div class="wrapper">
				<div class="content-page content-sep"> 
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main"> 

							<div class="contact-left wow fadeInLeft"> 
								<article id="post-6" class="post-6 page type-page status-publish hentry">
                                
	                                
										<header class="entry-header contact-sep"> 
											<p><?php the_title(); ?></p>
										</header><!-- .entry-header --> 
	                                 
	                                <?php if( class_exists('wpcf7') ) { ?>
	                                <div class="entry-content"> 
	                                    <?php 
	                                     echo do_shortcode( $contact_page_shortcode ); 
	                                    ?>
	                                </div>
	                                <?php } ?>
	                                    								
								</article>
							</div> 


							<aside id="secondary" class="widget-area contact-right wow fadeInRight" role="complementary">  
								<?php 
                                    if( is_active_sidebar ( 'contact-temp' ) ) {
                                    	dynamic_sidebar( 'contact-temp' );
                                    }
                                    
                                ?>
							</aside> 


						</main>
					</div> 
				</div> 
			</div>

			<div class="map wow fadeInUp">
				<div class="iframe-map">
				
					<?php 

						echo codepress_corporate_textarea_saniize($contact_us_google_map_frame); 

					?>
					
				</div>
			</div>

	</div> 
<?php 

} }

get_footer();