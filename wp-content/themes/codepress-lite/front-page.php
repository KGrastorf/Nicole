<?php 
/** 
 * 
 * Template to show front page
 * 
 * @package Codepress lite
 */
 get_header();
 //echo  get_option( 'show_on_front' ); die();

?>

<?php
if( get_option( 'show_on_front' ) == 'posts' ): ?>

    <?php 
    $post_banner = get_theme_mod('codepress_lite_default_banner_setting'); 
    if(!empty($post_banner)):
        $attachment_id = attachment_url_to_postid( $post_banner );
        $image_array = wp_get_attachment_image_src( $attachment_id, 'codepress-lite-codepress_lite_banner' );
    endif;
    ?>
    <div class="header-image-main-wrap">
        <div class="header-titlebar-wrapper" style="<?php echo (!empty($image_array[0])) ? 'background: url( '.esc_url($image_array[0]).');' : ''; ?> background-size:cover; background-repeat: no-repeat;"> 
        	<div class="header-titlebar-overlay"> </div>
        	<div class="header-title-wrap">
        		<?php echo codepress_lite_breadcrumbs(); ?>
        	</div>
        </div>
    </div> 
    
<div class="main-content-section blog">
	<div class="container">
        <?php 
        $page_sidebar_layout = get_theme_mod('codepress_lite_default_sidebar_setting', 'right-sidebar');  
        if($page_sidebar_layout == 'left-sidebar' || $page_sidebar_layout == 'both-sidebar'):
            ?>
            <aside id="secondary" class="widget-area" role="complementary">
        	   <?php dynamic_sidebar('left-sidebar'); ?>
            </aside><!-- #secondary -->
            <?php 
            endif;
        ?>

        	<div id="primary" class="content-area">
        		<main id="main" class="site-main" role="main">
        
        		<?php
        		if ( have_posts() ) :
        
        			if ( is_home() && ! is_front_page() ) : ?>
        				<header>
        					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        				</header>
        
        			<?php
        			endif;
                    $count = 1;
        			/* Start the Loop */
        			while ( have_posts() ) : the_post();
        
        				/* 
        				 * Include the Post-Format-specific template for the content.
        				 * If you want to override this in a child theme, then include a file
        				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        				 */
        				//get_template_part( 'template-parts/content', get_post_format() );
                        ?>
                        <div class="col-2">
        					<div class="cp-blog-wrapper">
        						<div class="post-slide">
                                    <?php if(has_post_thumbnail()): ?>
        							<div class="post-img">
        								<a href="<?php the_permalink(); ?>">
                                        <?php 
                                        the_post_thumbnail('codepress-lite-blog-thumb', array( 
                    						'alt' => esc_attr(get_the_title()),
                    						'title' => esc_attr(get_the_title()),
                                            ));
                                        ?>
                                        </a>
        							</div>
                                    <?php endif; ?>
        							<div class="post-content">
        								<div class="post-on">
        									<span><?php echo esc_html( get_the_date( 'j M' ) );?></span>
        									
        								</div>
        								<div class="auther-title-wrap">
            								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            								<div class="auther"><span><?php _e('by', 'codepress-lite'); ?> </span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></div>
        								</div>
                                        
        								<div class="post-meta">
        									<ul class="post-bar">
                                                <li class="comments"><i class="fa fa-comments-o"></i><?php comments_popup_link( __('No comment', 'codepress-lite'), '1', '%', '', '-' ); ?></li>
        										
        										<li><i class="fa fa-folder-open"></i>
                                                    <?php codepress_lite_category(1) ?>
                                                </li>
        									</ul>
        								</div>
        								<div class="post-description">
        								    <?php 
                                            the_excerpt(); ?>
                                        </div>
        								<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read More', 'codepress-lite'); ?></a>
        							</div>
        						</div>
        					</div>
        				</div>
                        <?php 
                        if($page_sidebar_layout == 'no-sidebar' && $count % 3 == 0)
                        {
                            ?>
                            <div class="clearfix"></div>
                            <?php
                        }
                        elseif(($page_sidebar_layout == 'left-sidebar' || $page_sidebar_layout == 'right-sidebar') && $count %2 == 0 )
                        {
                            ?>
                            <div class="clearfix"></div>
                            <?php
                        }
                        
                        $count++;
                        
        
        			endwhile;
                    ?>
                    <div class="clear"></div>
                    <?php
                    $nav_args = array(
                                    'prev_text' => '<span class="meta-nav"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>' . __( 'Older Posts', 'codepress-lite' ),
                                    'next_text' => __( 'Newer Posts', 'codepress-lite' ) .' <span class="meta-nav"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>',
                                );
        			the_posts_navigation($nav_args);
        
        		else :
        
        			get_template_part( 'template-parts/content', 'none' );
        
        		endif; ?>
        
        		</main><!-- #main -->
        	</div><!-- #primary -->
            
            <?php  
            if($page_sidebar_layout == 'right-sidebar' || $page_sidebar_layout == 'both-sidebar' || $page_sidebar_layout == ''):
                    get_sidebar(); 
                endif;
             ?>
    </div>
 </div>
<?php
else:
echo do_action('codepress_lite_main_slider');
 ?>
 
 <div id="main-content-section" class="main-content-section">
	<div id="layout-1">
        <?php
        if( have_posts() ):
		while( have_posts() ): the_post();
			$static_page_content = get_the_content();
			if ( $static_page_content != '' ) : ?>
            
            <div class="section-wrapper page-post clearfix">
				<div class="container">
                    
					<div class="title-wrapper wow fadeInDown">
						
                            <h3 class="widget-title"> <?php the_title(); ?> </h3>
						      
                              
					</div>
					<div class="about-wrapper">
						<div class="about-us clearfix">
                            
							<div class=" about-text wow fadeInLeft">
                            
                            
								<?php the_excerpt(); ?>

                                
							</div>
                            
                            
							<div class="about-image image-layout-one wow fadeInRight">
								<?php the_post_thumbnail('codepress-lite-who-we-are', array( 
            						'alt' => esc_attr(get_the_title()),
            						'title' => esc_attr(get_the_title()),
            					));  ?>
							</div>
                            
						</div>	
					</div>
				</div>
			</div>	
            
			<?php endif;
		endwhile;
	endif;
    ?>
        
        <?php 
        if(is_active_sidebar('home-sidebar')):
            dynamic_sidebar('home-sidebar');
        endif;
        
		
             $contact_activate = get_theme_mod('codepress_lite_contact_home_activate_setting', 1);
            
            if($contact_activate == 1):
            $contact_title = get_theme_mod('codepress_lite_contact_home_title_setting', __('Contact Us', 'codepress-lite'));
            $contact_description = get_theme_mod('codepress_lite_contact_home_description_setting', __('Get in touch with us', 'codepress-lite'));
            
            $contact_form = get_theme_mod('codepress_lite_contact_shortcode_setting');
            
            $contact_optional_activate = get_theme_mod('codepress_lite_contact_home_optional_activate_setting', 1);
            $contact_address = get_theme_mod('codepress_lite_contact_address_setting'); 
            $contact_phone = get_theme_mod('codepress_lite_contact_phone_setting', __('+61 3 8376 6284', 'codepress-lite'));
            $contact_email = get_theme_mod('codepress_lite_contact_email_setting', __('hello@codetrendy.com', 'codepress-lite'));
            $contact_website = get_theme_mod('codepress_lite_contact_website_setting', esc_url('http://www.codetrendy.com'));
         ?>
		<section id="codepress_contact_widget" class="widget widget-contact-post clearfix">
			<div class="section-wrapper">
			<div class="parallax-overlay"></div>
				<div class="container">
					<div class="title-wrapper wow fadeInDown">
                        <?php if(!empty($contact_title)): ?>
						  <h3 class="widget-title"><?php echo esc_html($contact_title); ?></h3>
                        <?php endif; 
                            if(!empty($contact_description)):
                        ?>
						      <div class="widget-desc"><?php echo esc_html($contact_description); ?></div>
                        
                        <?php endif; ?>
					</div>
					<div class="contact-wrapper">
						<div class="col-wrapper clearfix">
                            <?php if(!empty($contact_form)): ?>
							<div class="col-1 contact-form wow fadeInUp">
								<?php 
                                if(class_exists('WPCF7')){
                                    echo do_shortcode($contact_form );
                                }
                                ?>
							</div>
                            <?php endif; 
                            
                            if($contact_optional_activate == 1):
                            ?>
                            
							<div class="col-1 contact-details-wrapper">
								<div class="or">
									<span><?php _e('OR', 'codepress-lite'); ?></span>
								</div>
								<div class="contact-details clearfix wow zoomIn">
                                    <?php if(!empty($contact_address)): ?>
									<div class="contact-detail-block clearrfix">
										<div class="contact-icon"><i class="fa fa-map-marker"> </i></div>
										<div class="contact-text"><?php echo esc_html($contact_address); ?></div>
									</div>
                                    <?php endif;
                                    if(!empty($contact_phone)):
                                     ?>
									<div class="contact-detail-block clearrfix">
										<div class="contact-icon"><i class="fa fa-clock-o"> </i></div>
										<div class="contact-text"><a href="phoneto:<?php echo esc_html($contact_phone); ?>"><?php echo esc_html($contact_phone); ?></a></div>
									</div>
                                    <?php endif;
                                    if(!empty($contact_email)):
                                    ?>
									<div class="contact-detail-block clearrfix">
										<div class="contact-icon"><i class="fa fa-envelope"> </i></div>
										<div class="contact-text"><a href="mailto:<?php echo antispambot($contact_email); ?>"><?php echo antispambot($contact_email); ?></a></div>
									</div>
                                    <?php endif; ?>
								</div>
                                <?php if(!empty($contact_website)): ?>
								<div class="auther-link wow zoomIn"><a href="<?php echo esc_url($contact_website); ?>" target="_blank"><?php echo esc_url($contact_website); ?></a></div>
                                <?php endif; ?>
							</div>
                            
                            <?php endif; ?>
                            
						</div>
                        
					</div><!-- .contact-wrapper -->
				</div><!-- .container -->
			</div>
		</section>
        <?php endif; ?>
		
	</div>
	</div>

<?php


endif;
get_footer();