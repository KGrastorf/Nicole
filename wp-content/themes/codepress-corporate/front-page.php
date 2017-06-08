<?php 
/** 
 * 
 * Template to show front page
 * 
 * @package Codepress corporate
 */
 get_header();
?>
<?php
if( get_option( 'show_on_front' ) == 'posts' ): 


$post_banner_image = get_theme_mod( 'codepress_corporate_archive_banner_image' );
$attachment_id = attachment_url_to_postid( $post_banner_image );
$image_array = wp_get_attachment_image_src( $attachment_id, 'codepress_corporate_banner_image_size' );

?>
<!-- Breadcrumb-start -->
		<section class="breadcrumb">
			<div class="parallax-image" <?php echo (!empty($image_array[0])) ? 'style="background: url( ' . esc_url($image_array[0]) . ' ); "' : ''; ?>>
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

<div class="main-content blog-archive">
			<div class="wrapper">
				<section id="primary" class="content-area">
					<main id="main" class="site-main" role="main"> 
						<div class="content-page content-sep">

							<div class="blog-page left-content"> 
                                <div id="cc-blog-page-jetpack">
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
											
												<span><i class="fa fa-calendar"></i><a href="<?php the_permalink();  ?>"><?php echo esc_html(get_the_date());   ?></a></span>
											
												<span><i class="fa fa-user"></i><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a></span>
												<span><i class="fa fa-comment"></i><a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number( __('no responses', 'codepress-corporate' ), __('one response', 'codepress-corporate'), __('% responses', 'codepress-corporate') ); ?></a></span>
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
													<p>
                                                    <?php codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_service_excerpt_length', 100 ) );
                                                    the_excerpt();
                                                    codepress_corporate_remove_excerpt_length();
                                                  ?> 
                                                    </p> 
													
													<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'codepress-corporate' ); ?></a> 
										</div> 
									</article> 

								<?php endwhile; ?> 
								</div>
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



<?php
else:
?>
	<?php while (have_posts()) :  the_post(); ?>

		<div class="template-content wrapper">
			
			<div class="template-text">
			  <div class="title wow fadeInLeft"><h2>
				<?php the_title(); ?></h2>
			  </div>

			  <?php codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_service_excerpt_length', 100 ) );
                the_excerpt();
                codepress_corporate_remove_excerpt_length();
              ?> 
            </div>
			<?php if ( has_post_thumbnail()) { ?>
			<div class="template-content-img wow fadeInRight">
			
				<?php        
        			
         			 $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'codepress_corporate_about_us_image_size' );
   					if(!empty($image_url[0])){
   				?>
				        <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
                <?php } ?>
			</div>			

			<?php } ?>
		</div>	
	
	
	<?php endwhile; ?>	
<!-- Services-start --> 

	
	<?php 
		$services_active = get_theme_mod( 'codepress_corporate_services_activate', 1 );
        
    	$services_title = get_option( 'codepress_corporate_services_title', __('Title', 'codepress-corporate') );
    	$services_descriptpon = get_option( 'codepress_corporate_services_description', __( 'Services title', 'codepress-corporate') );
    	$services_category = get_option('codepress_corporate_services_dropdown_categories');
    	$services_char_count = absint(get_option( 'codepress_corporate_services_charecter_count', 20 )); 
    	
        
	if( $services_active == 1 ) :

	?>

		<section class="services">
			<div class="wrapper">
				<div class="title wow fadeInDown">

				<?php

					if( $services_char_count != '' )
					{	
						$charcter_count = $services_char_count;
					}
					else{
						$charcter_count = '20';
					}

					if(!empty( $services_title ))
					{
				?>
					<h2><?php echo esc_html($services_title); ?></h2>
					<?php  }
					if( !empty( $services_descriptpon ) )
					{
					?>
					<p><?php echo esc_html($services_descriptpon); ?></p>
					<?php } ?>

 				</div>
				<div class="service-box wow fadeInUp">

			<?php 
				if(!empty( $services_category)) :

					$args = array('post_type' => 'post',
									'post_status' => 'publish',
									'posts_per_page' => 6,
									'cat' => absint($services_category)
									);

					$query = new WP_Query($args);
					
					while( $query->have_posts() ) : $query->the_post();

				?>

						<div class="service">
				
							<?php if ( has_post_thumbnail()) { ?>
							<div class="s-img">
								<?php        
	                    			
                    			 $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
                                 if(!empty($image_url[0])){
	               				?>

								<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>"/>
								<?php } ?>
							</div>
						<?php } ?>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

							<?php codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_service_excerpt_length', $charcter_count ) );
	                            the_excerpt();
	                            codepress_corporate_remove_excerpt_length();
	                        ?> 

						</div>
				<?php 
					endwhile;
						wp_reset_postdata();

					endif; 
					?>
				  
				</div> 
			</div>
		</section>
	<?php endif; ?>
	<!-- Services-end -->


	<!-- CTA-start -->
	<?php 
	$CTA_active = absint(get_theme_mod( 'codepress_corporate_call_to_action_activate', 1 ));
	$CTA_title = get_theme_mod( 'codepress_corporate_call_to_action_title', __( 'Title' , 'codepress-corporate') );
	$CTA_content = get_theme_mod( 'codepress_corporate_call_to_action_content', __( 'Content' , 'codepress-corporate') );
	$CTA_read_more = get_theme_mod( 'codepress_corporate_call_to_action_read_more', __( 'Read More' , 'codepress-corporate') );
	$CTA_read_more_URL = get_theme_mod( 'codepress_corporate_call_to_action_read_more_url', '#' );
	$CTA_background = get_theme_mod( 'codepress_corporate_call_to_action_background_image' );
    
    if( $CTA_active == 1 && !empty($CTA_title)) {

	?>

		<section class="cta">
			<div class="wrapper">
				<div class="cta-block wow zoomIn"> 

				<?php if (!empty($CTA_title))  : ?>
					<h2><?php echo esc_html($CTA_title); ?></h2>  
				<?php endif; ?>

				<?php if (!empty($CTA_content))  { ?>
					<p><?php echo codepress_corporate_textarea_saniize($CTA_content); ?></p> 
				<?php } ?>

				</div>
				<?php if( !empty( $CTA_read_more_URL ) ) { ?>
					<div class="dtl wow zoomIn">
						<a href="<?php echo esc_url($CTA_read_more_URL); ?>"><?php echo esc_html($CTA_read_more); ?></a>
					</div>
				<?php } ?> 
				<div class="clearfix"></div>
			</div>
		</section>
    <?php 
    }
    ?>
	<!-- CTA-end --> 

	<!-- About-start --> 
	<?php 

	$aboutUs_active = absint(get_theme_mod( 'codepress_corporate_about_us_activate', 1 ));
	$aboutUs_title = get_theme_mod( 'codepress_corporate_about_us_title', __( 'About Us' , 'codepress-corporate') );
	$aboutUs_page = get_theme_mod( 'codepress_corporate_about_us_page' );
	$aboutUs_read_more = get_theme_mod( 'codepress_corporate_cta_read_more', __( 'More Info' , 'codepress-corporate') );
	$aboutUs_readmore_URL = get_theme_mod( 'codepress_corporate_about_us_read_more_url', '#' );
	
	if( $aboutUs_active == 1 ) :
	?>

		<section class="about"> 
		<?php 
		if(!empty( $aboutUs_page)) : 

					$args = array('post_type' => 'page',
									'post_status' => 'publish',
									'page_id' => absint($aboutUs_page));

					$query = new WP_Query($args);
	
			?>		

			<div class="wrapper"> 
			<?php if(!empty( $aboutUs_title )) : ?>
				<div class="title wow fadeInDown">
					<h2><?php echo esc_html($aboutUs_title); ?></h2> 
				</div> <?php endif; ?>
				<?php while( $query->have_posts() ) : $query->the_post(); ?>
				<div class="about-content">

					<?php        
        			if ( has_post_thumbnail()) {
         			 $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'codepress_corporate_about_us_image_size' );
	       				?>	

					<div class="about-img  wow fadeInLeft">
                    <?php if(!empty($image_url[0])){ ?>
						<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php } ?>
					</div>

					<?php } ?>

					<div class="about-desc  wow fadeInRight">
						<h4><?php the_title(); ?></h4>

						<?php codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_about_excerpt_length', 80 ) );
                            the_excerpt();
                            codepress_corporate_remove_excerpt_length();
                        ?> 

						
						<?php if(!empty( $aboutUs_readmore_URL )) { ?>
							<a href="<?php echo esc_url($aboutUs_readmore_URL); ?>"><?php echo esc_html($aboutUs_read_more); ?></a>
						<?php } ?>	
					</div>
				</div> 
                <?php endwhile; 
                wp_reset_postdata();
                endif; ?>
			</div>
		
		</section> 
	<?php endif; ?>
		<!-- About-end --> 

		<!-- Portfolio-start --> 

		<?php 

			$Portfolio_active = absint(get_theme_mod( 'codepress_corporate_portfolio_section_activate', 1 ));
			$Portfolio_title = get_theme_mod( 'codepress_corporate_posrtfolio_title', __( 'Our Works' , 'codepress-corporate'));
			$Portfolio_category = get_option( 'codepress_corporate_portfolio_category' );
			$Portfolio_view_all = get_option( 'codepress_corporate_portfolio_view_all' );
			$Portfolio_view_all_URL = get_option( 'codepress_corporate_portfolio_view_all_url' );

		
		if( $Portfolio_active == 1 ) :

			//$category_link = get_category_link( absint($Portfolio_category) );
		?>

		<section class="f-project">
			<div class="wrapper"> 
				<?php if(!empty( $Portfolio_title )) : ?>
						<div class="title  wow fadeInDown">
							<h2> <?php echo esc_html($Portfolio_title); ?> </h2> 
						</div> 
				<?php endif; ?>
			</div>
					
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
							<?php }
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

					<?php endwhile; 
						wp_reset_postdata();
					?>
				</div>
				<?php 
					endif;
				?>

				<?php  	
			 		if( !empty( $Portfolio_view_all ) ) {
				?>
				<div class="view-all">
					<a href="<?php echo esc_url($Portfolio_view_all_URL); ?>"><?php echo esc_html($Portfolio_view_all); ?></a>
				</div>
			<?php } ?>
		</section>
	<?php endif; ?>
		<!-- Portfolio-end -->


<!-- Testimonial-start -->
		<?php 

		$testimonial_active = absint(get_theme_mod( 'codepress_corporate_testimonials_activate', 1 ));
		$testimonial_background = get_theme_mod( 'codepress_corporate_testimonial_background_image' );
		$testimonial_title = get_theme_mod( 'codepress_corporate_testimonials_title', __( 'Testimonials' , 'codepress-corporate') );
		$testimonial_category = get_option( 'codepress_corporate_testimonials_category' );


		

		if( $testimonial_active == 1 ) :
        
        if(!empty($testimonial_category)) { 
			$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => 2,
					'cat' => absint($testimonial_category)
				);
        
        
		$query = new WP_Query( $args );	
		?>

		<section class="testimonials">
		
			<div class="parallax-image" <?php echo (!empty($testimonial_background)) ? 'style="background: url(' . esc_url($testimonial_background).');"' : ''; ?>>
				<div class="bg-black"></div>
			</div>

			<div class="wrapper">

				<?php if(!empty($testimonial_title)) : ?>
					<div class="title wow fadeInDown">
						<h2><?php echo esc_html($testimonial_title); ?></h2> 
					</div> 
				<?php endif; ?>			

					<div class="testimonial">
						<div id="testimonial-slider" class="owl-carousel owl-theme">

							<?php  
							 while( $query-> have_posts() ) : $query->the_post(); 
							?> 						 
								
								<div class="item client wow zoomIn">
									<p><?php the_content(); ?></p>

										<?php if ( has_post_thumbnail()) :
					                     $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail'); ?>

											<div class="client-img">
                                            <?php if(!empty($image_url[0])){ ?>
												<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?> ">
                                                <?php } ?>
											</div>

										<?php endif; ?>

									<h4><?php the_title(); ?></h4>

								</div> 	
			

							<?php endwhile; 
								wp_reset_postdata();
							?>

						</div>	
					</div>
			</div>	
		</section>
        <?php } ?>
        <?php endif; ?> 
		
		<!-- Testimonial-end --> 


		<!-- Clients-start --> 
		<?php 

		$client_active = absint(get_theme_mod( 'codepress_corporate_client_activate', 1 ));
		$client_title = get_theme_mod( 'codepress_corporate_client_title', __( 'Client' , 'codepress-corporate') );
		$client_category = get_option( 'codepress_corporate_client_category' );	

		if( $client_active == 1 ) :
		?>
		<section class="clients"> 
			<div class="wrapper"> 
			<?php if(!empty( $client_title )) : ?> 
				<div class="title wow fadeInDown"> 
					<h2><?php echo esc_html($client_title); ?></h2> 
				</div> 
				<?php endif; ?> 

			<div class="client-logo">

					


			<?php if(!empty( $client_category )) : 
				$args = array(

						'post_type' => 'post', 
						'post_status' => 'publish', 
						'posts_per_page' => 8, 
						'cat' => absint($client_category) 
					); 

				$query = new WP_Query($args);
				while ($query->have_posts()) : $query->the_post(); 					                
		                  if ( has_post_thumbnail()) {
		                    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'codepress_corporate_blog_image_size');
		    ?>
					<div class="logo-block wow zoomIn">
                    <?php if(!empty($image_url[0])){ ?>
						<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?> ">
                        <?php } ?>
					</div>
					<?php } ?>
					
				<?php  endwhile; 
					wp_reset_postdata();
				endif; ?>
			</div>

			</div>
		</section>
	<?php endif; ?>
		<!-- Clients-end --> 
		
	<!-- Blog-start --> 

	<?php 
	$blog_active = absint(get_theme_mod( 'codepress_corporate_blog_activate', 1 ));
	$blog_title = get_theme_mod( 'codepress_corporate_blog_title', __( 'Blog' , 'codepress-corporate') );

	$blog_read_more_url = get_theme_mod( 'codepress_corporate_blog_post_read_more_url' );
	$blog_view_all = get_theme_mod( 'codepress_corporate_blog_post_read_more', __( 'Read More' , 'codepress-corporate') );
	$blog_char_count = get_theme_mod( 'codepress_corporate_blog_charecter_count', 50 );
	$blog_category = get_option( 'codepress_corporate_blog_page' );



//category link
	//$category_link = get_category_link( $blog_category );


	if( $blog_active == 1 ):
	?>


		<!-- Blog-start --> 
		<section class="blogs">
			<div class="wrapper"> 
			<?php if(!empty( $blog_title )) : ?>
				<div class="title wow fadeInDown">
					<h2><?php echo esc_html($blog_title); ?></h2> 
				</div>
				<?php endif; ?>
				<div class="blog-news">

				<?php 
					
					$args = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'posts_per_page' => 3,
							'cat' => absint($blog_category)
						);
					$query = new WP_Query($args);

					 while( $query->have_posts() ) : $query->the_post(); 
				?>

					<div class="blog-block wow fadeInUp">
					<?php  if ( has_post_thumbnail()) :	 ?>
						<div class="blog-img">
						<?php				
		                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'codepress_corporate_blog_image_size' ); 
                          if(!empty($image_url[0])){
                          ?>
							
                            <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title_attribute(); ?>">
                            
	                       <?php } ?>
							<span><i class="fa fa-calendar"></i> <?php echo esc_html(get_the_date()); ?></span>
						</div>
						<?php endif; ?>
						<div class="blog-desc">

						<?php 
                            $title = get_the_title();
                            if(!empty( $title )) : ?>
							<h4><a href="<?php the_permalink(); ?>"><?php echo esc_html($title); ?></a></h4>
						<?php endif; 

						 codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_blog_excerpt_length', $blog_char_count ) );
                            the_excerpt();
                            codepress_corporate_remove_excerpt_length();
                        ?> 

							<a href="<?php the_permalink(); ?>"><?php echo esc_html($blog_view_all); ?></a>
						</div> 
					</div>
				<?php endwhile; 

					wp_reset_postdata();
					//endif;
				?>

				</div>
			 </div> 
			 <?php if( !empty( $blog_view_all ) ) { ?>
				<div class="view-all">
                <?php if($blog_read_more_url != ''){ ?>
				<a href="<?php echo $blog_read_more_url != '' ? esc_url($blog_read_more_url) : ''; ?>"><?php esc_html_e( 'View All','codepress-corporate' ); ?></a>
                <?php } ?>
			   </div>
			 <?php } ?>
		</section>
	<?php endif; ?>

<!-- Blog-end -->



	<!-- Contact-start -->
<?php 

$google_map_active = get_theme_mod( 'codepress_corporate_google_map_activate', 1 );
$google_map_active_in_home = get_theme_mod( 'codepress_corporate_google_map_activate_home', 1 );
$google_map_google_frame = get_theme_mod( 'codepress_corporate_google_map_frame' );


$contact_form_avtive = get_theme_mod( 'codepress_corporate_contact_setting_activate',1 );
$contact_form_avtive_in_home = get_theme_mod( 'codepress_corporate_contact_setting_activate_home', 1 );
$contact_form_title = get_theme_mod( 'codepress_corporate_contact_title', __('Title', 'codepress-corporate') );
$contact_form_shortcode = get_theme_mod( 'codepress_corporate_contact_form_shortcode' );

?>

<section class="home-contact">

	<div class="wrapper">

	<?php if( $google_map_active == 1 || $google_map_active_in_home == 1 ) : ?>

		<div class="iframe-map">

			<?php 
			
				echo codepress_corporate_textarea_saniize($google_map_google_frame); 

			?>
			
		</div>

	<?php endif; 

	 if( $contact_form_avtive == 1 || $contact_form_avtive_in_home == 1 ) : ?>
	 	
		<div class="form wow fadeInRight">
			<?php if(!empty($contact_form_title)){ ?>
			<h2><?php echo esc_html($contact_form_title); ?></h2>
			<?php }
			
			if( class_exists('wpcf7') ) { ?>
			<?php echo do_shortcode( $contact_form_shortcode ); ?>
			<?php } endif; ?>
		</div>
	
		
	</div>

</section>
	<!-- Contact-end -->

<?php
endif;
get_footer();