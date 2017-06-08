<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package codepress_corporate
 */

?>


	</div><!-- #content -->

</div><!-- #page -->
<?php if(is_active_sidebar('footer-1') || is_active_sidebar('footer-4') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ) { ?>
<!-- Footer-end -->
		<footer class="footer">
			<div class="wrapper">

				<div class="footer-box footer-column-n">
					<div class="footer-block wow fadeInUp">
					<?php 
						if(is_active_sidebar('footer-1')){
							dynamic_sidebar('footer-1');
						} ?> 
					</div>
					<div class="footer-block wow fadeInUp">
					<?php 
						if(is_active_sidebar('footer-2')){
						dynamic_sidebar('footer-2');
						}
					?>
					</div>
					<div class="footer-block wow fadeInUp">
					<?php
						if(is_active_sidebar('footer-3')){
						dynamic_sidebar('footer-3');
					}
					?>
					</div> 
					<div class="footer-block wow fadeInUp">
					<?php
						if(is_active_sidebar('footer-4')){
						dynamic_sidebar('footer-4');
						}
					?>
					</div>

					
				</div> 
			</div> 
		</footer> 
  <?php } ?>
  
		<?php $copyright =  get_theme_mod( 'codepress_corporate_copyright_setting' ); ?>
		<div class="footer-bottom"> 
			<div class="wrapper"> 
				<div class="copyright">
					<p><?php echo esc_html($copyright); ?></p> 

				</div> 
				<div class="codetrendy"> 
					<p><?php esc_html_e('Theme by: ', 'codepress-corporate'); ?><a href="<?php echo esc_url("http://codetrendy.com"); ?>"><?php  esc_html_e("CodeTrendy", 'codepress-corporate')?></a><?php esc_html_e( ' | Powered by: ' , 'codepress-corporate' ); ?><a href="<?php echo esc_url('https://wordpress.org/'); ?>" target="_blank"> <?php esc_html_e( 'WordPress ', 'codepress-corporate' ); ?></a></p> 
				</div> 
			</div>   
		</div> 
		<!-- Footer-end --> 

		<div class="scroll-top-wrapper">
			<span class="scroll-top-inner"><i class="fa fa-angle-up"></i></span> 
		</div> 
		
		
<?php wp_footer(); ?> 

</body> 
</html> 