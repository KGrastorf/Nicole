<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package codepress_corporate
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="<?php esc_url('http://gmpg.org/xfn/11'); ?>">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); 

?>
</head>

<body <?php body_class(); ?> >
<?php $header_logo_option = get_theme_mod( 'codepress_corporate_logo_optipn', 'header_text_only' );  
 	if( $header_logo_option == 'show_both' || $header_logo_option == 'header_logo_only' ) {
 		$cc_logo_class = 'cc-logo-class';
 	}
 	else{
 		$cc_logo_class = '';
 	}
?>
 
<!-- header-start --> 

<header role="banner" class="site-header <?php echo esc_attr($cc_logo_class); ?>" id="masthead"> 
		<?php 

		$top_header = get_theme_mod( 'codepress_corporate_info_activate', 1 );

			if( $top_header == 1  ) :
		?>

			<div class="top-header">
				<div class="wrapper">

				<?php 
				$header_contact = get_theme_mod( 'codepress_corporate_top_contact_number', '987654321' );
				$header_email = get_theme_mod( 'codepress_corporate_top_email', 'info@codetrendy.com' );

				?>
					<div class="top-info">
						<ul>
						<?php if(!empty($header_contact)) : ?>
							<li>
								<i class="fa fa-phone"></i> <?php echo esc_attr($header_contact); ?>			 
							</li>
						<?php endif; ?>
						<?php if(!empty($header_email)) : ?>
							<li>
								<i class="fa fa-envelope"></i>	<?php echo antispambot($header_email); ?>
							</li>
						<?php endif; ?>
						</ul>
					</div>

					<?php 
					if(get_theme_mod('codepress_corporate_social_link_activate', 1) == 1) { 

						$fb_url = get_theme_mod( 'codepress_corporate_social_facebook', 'https://www.facebook.com/codetrendy/' ); 
						$twitter_url = get_theme_mod( 'codepress_corporate_social_twitter', 'http://twitter.com/' ); 
						$gplus_url = get_theme_mod( 'codepress_corporate_social_google_plus' ); 
						$insta_url = get_theme_mod( 'codepress_corporate_social_instagram', 'http://instagram.com/' ); 
						$youtube_url =get_theme_mod( 'codepress_corporate_social_youtube', 'http://youtube.com/' ); 
						$pin_url = get_theme_mod( 'codepress_corporate_social_pinterest' ); 
						$rss_url = get_theme_mod( 'codepress_corporate_social_rss_feed' ); 
						
						//echo $youtube_url; 
						?>

					<div class="top-social-icon">

						<ul>
							<?php if(!empty($fb_url)) : ?>
								<li><a href="<?php echo esc_url($fb_url); ?>"  target="_blank"><i class="fa fa-facebook"></i></a></li>
							<?php endif; 
							if(!empty($twitter_url)){
								?>
								<li><a href="<?php echo esc_url($twitter_url); ?>"  target="_blank"><i class="fa fa-twitter"></i></a></li>
								<?php	
							}
							
							?>
							<?php if(!empty( $gplus_url)) : ?>
							<li><a href="<?php echo esc_url($gplus_url); ?>"  target="_blank"><i class="fa fa-google-plus"></i></a></li>
						<?php endif; 
							if(!empty( $insta_url)) :
						?> 
							<li><a href="<?php echo esc_url($insta_url); ?>"  target="_blank"><i class="fa fa-instagram"></i></a></li>
						<?php endif; 
							if(!empty( $youtube_url )) :
						?> 
							<li><a href="<?php echo esc_url($youtube_url); ?>"  target="_blank"><i class="fa fa-youtube"></i></a></li>
						<?php endif; 
							if(!empty( $pin_url)) :
						?> 
							<li><a href="<?php echo esc_url($pin_url); ?>"  target="_blank"><i class="fa fa-pinterest"></i></a></li>
						<?php endif; 
							if(!empty( $rss_url)) :
						?> 
							<li><a href="<?php echo esc_url($rss_url); ?>"  target="_blank"><i class="fa fa-rss"></i></a></li>
						<?php endif; ?>
						 
						</ul>
					</div>  
					<?php } ?>
				</div>
			</div>
		<?php endif;  ?>


				<?php 
					$site_logo = get_theme_mod( 'custom_logo' ); 
				?>

			<div class="header headersticky <?php echo ( esc_attr($header_logo_option) == 'show_both' ) ? 'show-both' : ''; ?>">
				<div class="wrapper"> 

					<?php
						if( !( $header_logo_option == 'disable' ) ) {

						?>
							<div class="site-branding ">

							 <?php
							 if( $header_logo_option == 'show_both' || $header_logo_option == 'header_logo_only' ) {
								?>

								<div class="site-logo">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php the_custom_logo(); ?></a>
								</div>
								
							<?php } ?>

							<?php if( $header_logo_option == 'show_both' || $header_logo_option == 'header_text_only')  { ?>
								<div class="wp-title">
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo get_bloginfo( 'site-title' ); ?></a></h1> 

								<p class="site-title"><?php echo get_bloginfo( 'description', 'display' ); ?></p>
								

								</div>

							<?php } 

							?>

							</div>

						<?php   } ?> 

					<div class="search-top">
						<div class="search-icon"><i class="fa fa-search"></i></div> 
						<form class="s-form" action="<?php echo site_url(); ?>" method="get" role="search"  id="searchform"> 
							<div class="search-form"> 
								<input type="text" id="" placeholder="<?php esc_attr_e( 'Search', 'codepress-corporate' ); ?>" value="<?php echo the_search_query(); ?>" name="s" >
							</div> 
						</form> 
					</div> 
					
					<nav id="site-navigation" class="main-navigation" role="navigation"> 
						<div class="menu-main-menu-container">
							<?php  wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sub-menu', 'menu_id' => 'primary-menu' ) ); ?>
						</div>
					</nav>
                    
                    <div id="cc-menu" class="cc-menuwrapper hide">
		        		<button class="cc-trigger"><?php _e( '<i class="fa fa-navicon"></i>', 'codepress-corporate' ); ?></button>
		        			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'cc-menu' ) ); ?>  
		           </div>

				</div>
			</div> 
            
            
            
            
            
            <div class="header mobile-header <?php echo ( esc_attr($header_logo_option) == 'show_both' ) ? 'show-both' : ''; ?>">
				<div class="wrapper"> 

					<?php
						if( !( $header_logo_option == 'disable' ) ) {

						?>
							<div class="site-branding ">

							 <?php
							 if( $header_logo_option == 'show_both' || $header_logo_option == 'header_logo_only' ) {
								?>

								<div class="site-logo">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php the_custom_logo(); ?></a>
								</div>
								
							<?php } ?>

							<?php if( $header_logo_option == 'show_both' || $header_logo_option == 'header_text_only')  { ?>
								<div class="wp-title">
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo get_bloginfo( 'site-title' ); ?></a></h1> 

								<p class="site-title"><?php echo get_bloginfo( 'description', 'display' ); ?></p>
								

								</div>

							<?php } 

							?>

							</div>

						<?php   } ?> 

					<div class="search-top">
						<div class="search-icon"><i class="fa fa-search"></i></div> 
						<form class="s-form" action="<?php echo site_url(); ?>" method="get" role="search"  id="searchform"> 
							<div class="search-form"> 
								<input type="text" id="" placeholder="<?php esc_attr_e( 'Search', 'codepress-corporate' ); ?>" value="<?php echo the_search_query(); ?>" name="s" >
							</div> 
						</form> 
					</div> 
					
					<nav id="site-navigation" class="main-navigation" role="navigation"> 
						<div class="menu-main-menu-container">
							<?php  wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sub-menu', 'menu_id' => 'primary-menu' ) ); ?>
						</div>
					</nav>

					<div id="cc-menu" class="cc-menuwrapper hide">
		        		<button class="cc-trigger"><?php _e( '<i class="fa fa-navicon"></i>', 'codepress-corporate' ); ?></button>
		        			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'cc-menu' ) ); ?>  
		           </div>
				</div>
			</div>
		</header>

		<!-- header-end --> 
	<!-- Main Slider Banner -->
	
	<?php 
    
    echo do_action('codepress_corporate_main_slider'); ?>

	<div id="content" class="site-content">