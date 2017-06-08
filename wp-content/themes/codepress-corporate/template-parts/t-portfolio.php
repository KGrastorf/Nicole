<?php 


/**
* Template Name: Portfolio
*@author CodeTrendy
*/

get_header();

$post_banner_image = get_theme_mod( 'codepress_corporate_page_banner_image' );
$post_feature_image = get_theme_mod( 'codepress_corporate_activate_featutred_image' );
$post_breadcumbs_separator = get_theme_mod( 'codepress_corporate_breadcumbs_separation' );
$page_commtent = get_theme_mod( 'codepress_corporate_activate_page_comment' );

?>

<!-- Breadcrumb-Start -->
<?php 
	if( have_posts() ) :
		while( have_posts() ) : the_post();
?>

<section class="breadcrumb">
	<div class="parallax-image" <?php echo (!empty($post_banner_image)) ? 'style="background: url(' . esc_url($post_banner_image) .' );"' : ''; ?>>
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

		<div class="template-content wrapper">
			
			<div class="template-text wow fadeInLeft">
			  <div class="title">
				<h2><?php the_title(); ?></h2>
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
			<div class="template-content-img wow fadeInRight">
			     <?php if(!empty($image_url[0])){ ?>
				    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
                <?php } ?>
			
			</div>			
			<?php } ?>
		</div>					

<?php  

$Portfolio_title = get_theme_mod( 'codepress_corporate_posrtfolio_title' );
$Portfolio_category = get_option( 'codepress_corporate_portfolio_category' );

?>

<div class="main-content"> 
	<div class="content-page content-sep"> 
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main"> 
			  	<div class="portfolio-area">
				  	<div class="title wow FadeInDown">
						<h2><?php echo esc_html($Portfolio_title); ?></h2> 
					</div>
					<div class="grid">
					

							<?php 
							if(!empty( $Portfolio_category )) :
								$args = array(
										'post_type' => 'post',
										'post_status' => 'publish',
										'posts_per_page' => 10,
										'cat' => absint($Portfolio_category)
									); ?>
							<div class="list-project"> 
								<?php 
									$query = new WP_Query( $args );
									
									while( $query->have_posts() ) : $query->the_post();
								?>
							          
									<div class="project wow fadeInUp"> 
										<?php if ( has_post_thumbnail()) :
							                 $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'codepress_corporate_portfolio_image_size'); 
                                             if(!empty($image_url[0])){
                                             ?>
                                             
												<img src=" <?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?> ">
										<?php 
                                            }
                                        endif; ?>
										
										<div class="dtl-hover">
											<div class="project-dtl">
												<div class="inside-dtl">
													<h4><?php the_title(); ?></h4>
											
														<?php
									                        $posttags = get_the_tags();
					                                        
					                                        $n = count( $posttags );
					                                        
									                        if ($posttags) {
									                    ?>
					                                    <ul>
						                                    <?php
						                                 	$i=1;
									                         foreach($posttags as $tag) {  
									                            
					                                           if ( $n > 2 ) {
					                                            ?>

																<li><?php  echo esc_html($tag->name) ; 
					                                         
					                                            
					                                             if( $i < 3 ){ 
					                                              echo ' /';
					                                               
					                                               } 
					                                            
					                                            ?></li>
					                                            
					                                            <?php 
					                                            }
					                                            elseif( $n < 2 ) { ?>
					                                            
					                                             <li><?php  echo esc_html($tag->name) ; 
					                                         
					                                            
					                                             if( $i < 3 ){ 
					                                              echo '/';
					                                               
					                                               } 
					                                            
					                                            ?></li>
					                                            
					                                             <?php 
					                                            }
					                                            else { ?>
					                                            
					                                             <li><?php  echo esc_html($tag->name) ; 
					                                         
					                                            
					                                             if( $i < 2 ){ 
					                                              echo '/';
					                                               
					                                               } 
					                                            
					                                            ?></li>

														
																<?php }	if( $i++ == 3 ) break; 	}  ?>
					                                    
					                                    </ul>
					                                    <?php
					                                    }?>

													<a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
												</div> 
											</div> 
										</div> 
									</div>  

								<?php endwhile; ?>
							</div>
							<?php 
								endif;
                                wp_reset_postdata();
							?>

					</div>
				</div> 
			</main>
		</div> 
	</div>  
</div> 
<?php endwhile; endif; ?>
<?php 
get_footer(); 
?>