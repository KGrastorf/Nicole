<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Codepress_Lite
 */

?>

	</div><!-- #content -->
    
    <?php 
    $copy_footer_class = '';
    $home_footer_activate = get_theme_mod('codepress_lite_footer_activate_setting', 0);
    if(is_page_template('template-parts/t-home.php')){
               if($home_footer_activate == 1){
                    codepress_lite_footer();
               }
               else
               {
                 $copy_footer_class = 'white_bg';
               }
                }
            else{
                codepress_lite_footer();
    } ?>
    
    <?php
    $cl_copyrignt_footer = get_theme_mod('codepress_lite_copyright_footer_text_setting', __('All Rights Reserved', 'codepress-lite')); 
    $cl_social_footer_activate = get_theme_mod('codepress_lite_social_link_activate_footer', 1);
    $cl_facebook_link = get_theme_mod('codepress_lite_social_facebook', esc_url('https://www.facebook.com/codetrendy/'));
    $cl_twitter_link = get_theme_mod('codepress_lite_social_twitter', esc_url('https://twitter.com/codetrendyinc'));
    $cl_gplus_link = get_theme_mod('codepress_lite_social_googleplus');
    $cl_youtube_link = get_theme_mod('codepress_lite_social_youtube');
    $cl_linkedin_link = get_theme_mod('codepress_lite_social_linkedin');
    $cl_insta_link = get_theme_mod('codepress_lite_social_instagram');
    $cl_pinterest_link = get_theme_mod('codepress_lite_social_pinterest');
    $cl_tumbler_link = get_theme_mod('codepress_lite_social_tumbler');
     ?>
	<footer role="contentinfo" id="colophon" class="<?php echo esc_attr($copy_footer_class); ?>">
        <div id="footer-wrapper">
          <div class="container">
                <div class="copyright">
                        <h4><?php  echo esc_html($cl_copyrignt_footer); ?>
                            <?php _e(' | Powered by WordPress. Theme by ', 'codepress-lite'); ?>
                            <a target="_blank" rel="nofollow" href="<?php echo esc_url('http://www.codetrendy.com'); ?>" target="_blank"><?php _e('CodeTrendy', 'codepress-lite'); ?></a>
                        </h4>
                </div>
                
                <?php if($cl_social_footer_activate == 1): ?>
                <div class="socail-menu">
                    <ul>
                        <?php if(!empty($cl_facebook_link)):?>
                            <li><a href="<?php echo esc_url($cl_facebook_link); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <?php endif;
                        if(!empty($cl_twitter_link)): ?>
                            <li><a href="<?php echo esc_url($cl_twitter_link); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <?php endif;
                        if(!empty($cl_gplus_link)):
                        ?>
                            <li><a href="<?php echo esc_url($cl_gplus_link); ?>" target="_blank"><i class="fa fa-gplus"></i></a></li>
                        <?php endif; 
                        if(!empty($cl_youtube_link)): ?>
                            <li><a href="<?php echo esc_url($cl_youtube_link); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        <?php endif; 
                        
                        if(!empty($cl_linkedin_link)): ?>
                            <li><a href="<?php echo esc_url($cl_linkedin_link); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <?php endif; 
                        if(!empty($cl_insta_link)): ?>
                            <li><a href="<?php echo esc_url($cl_insta_link); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <?php endif; 
                        if(!empty($cl_pinterest_link)): ?>
                            <li><a href="<?php echo esc_url($cl_pinterest_link); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                        <?php endif; 
                        if(!empty($cl_tumbler_link)): ?>
                            <li><a href="<?php echo esc_url($cl_tumbler_link); ?>" target="_blank"><i class="fa fa-tumbler"></i></a></li>
                        <?php endif; ?>
                        
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>