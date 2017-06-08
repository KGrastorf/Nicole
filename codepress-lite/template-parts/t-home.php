<?php 
/** 
 * 
 * Template Name: Home
 * 
 * Used for displaying home page
 */
 
 get_header();
?>

<?php
echo do_action('codepress_lite_main_slider');
 ?>
 
 <div id="main-content-section" class="main-content-section">
	<div id="layout-1">
    
        <?php 
        if(is_active_sidebar('home-sidebar')):
            dynamic_sidebar('home-sidebar');
        endif;
        ?>
		
        <?php $contact_activate = get_theme_mod('codepress_lite_contact_home_activate_setting', 1);
            
            if($contact_activate == 1):
            $contact_title = get_theme_mod('codepress_lite_contact_home_title_setting', esc_html__('Contact Us', 'codepress-lite'));
            $contact_description = get_theme_mod('codepress_lite_contact_home_description_setting', esc_html__('Get in touch with us', 'codepress-lite'));
            
            $contact_form = get_theme_mod('codepress_lite_contact_shortcode_setting');
            
            $contact_optional_activate = get_theme_mod('codepress_lite_contact_home_optional_activate_setting', 1);
            $contact_address = get_theme_mod('codepress_lite_contact_address_setting'); 
            $contact_phone = get_theme_mod('codepress_lite_contact_phone_setting', esc_html__('+61 3 8376 6284', 'codepress-lite'));
            $contact_email = get_theme_mod('codepress_lite_contact_email_setting', esc_html__('hello@codetrendy.com', 'codepress-lite'));
            $contact_website = get_theme_mod('codepress_lite_contact_website_setting', esc_url('http://www.codetrendy.com'));
         ?>
		<section id="codepress_contact_widget" class="widget widget-contact-post clearfix">
			<div class="section-wrapper">
			<div class="parallax-overlay"></div>
				<div class="container">
					<div class="title-wrapper wow fadeInDown">
                        <?php if(!empty($contact_title)): ?>
						  <h3 class="widget-title"><?php echo esc_attr($contact_title); ?></h3>
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
								<?php echo do_shortcode($contact_form );?>
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
get_footer();
 ?>