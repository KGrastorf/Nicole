<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Oner
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11"><?php
if ( is_singular() && pings_open() ) { ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php
} ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>  
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'oner' ); ?></a>
	<?php do_action('oner_before_header'); ?>
<div id="home">
	<header id="masthead" class="site-header" role="banner">   
			<?php if( is_active_sidebar( 'top-left' )  || is_active_sidebar( 'top-right' ) ): ?>
			<div class="top-nav">
				<div class="container">		
						<div class="five columns">
							<div class="cart-left">
								<?php dynamic_sidebar('top-left' ); ?>
							</div>
						</div>

						<div class="eleven columns">
							<div class="cart-right">
								<?php dynamic_sidebar('top-right' ); ?>  
							</div>
						</div>

				</div>
			</div> <!-- .top-nav -->
			<?php endif;?>
			
			<div class="branding header-image">  
				<div class="container">
					<div class="four columns site-branding-wrapper">
						<div class="site-branding">
							<?php 
								if( has_custom_logo()  && function_exists( 'the_custom_logo' ) ) :
	                                the_custom_logo();   
	                            endif;  
	                            $name = get_bloginfo( 'name' ); 
	                            if( $name ) : ?>
									<h1 class="site-title"><a style="color: #<?php sanitize_hex_color(header_textcolor()); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							    <?php endif; 
							    $description = get_bloginfo( 'description' );
								if( $description ) : ?>
									<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
								<?php endif; ?>
						</div><!-- .site-branding -->
					</div>
					<div class="twelve columns"><?php

					    $enabled_sections = oner_one_page_get_sections();
	                    $home_link_label  = get_theme_mod( 'menu_section_home_link_label',__('Home','oner') );
	                    $ed_section_menu  = get_theme_mod( 'menu_section_section_menu',true );
					    $home_link =  get_theme_mod( 'menu_section_home_link',true );

	                    if( $enabled_sections && ( 'page' == get_option( 'show_on_front' ) ) && ( $ed_section_menu != 1 ) ){ ?>
						    <nav id="site-navigation" class="main-navigation clearfix" role="navigation">
		                     	<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><i class="fa fa-align-justify fa-2x" aria-hidden="true"></i></button>
		                        <ul>
		                        <?php if( ! $home_link ){ ?>
		                            <li class="current-menu-item"><a href="<?php echo esc_url( home_url( '#home' ) ); ?>"><?php echo esc_html( $home_link_label ); ?></a></li>
		                        <?php }
		                            foreach( $enabled_sections as $section ){ 
		                                if( $section['menu_text'] ){ ?>
		                                <li><a href="<?php echo esc_url( home_url( '#' . esc_attr( $section['id'] ) ) ); ?>"><?php echo esc_html( $section['menu_text'] );?></a></li><?php 
		                                } 
		                            } ?>
		                        </ul>
		                    </nav><?php
					    }else{ ?>
		                    <nav id="site-navigation" class="main-navigation clearfix" role="navigation">
								<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><i class="fa fa-align-justify fa-2x" aria-hidden="true"></i></button>
								<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
							</nav><!-- #site-navigation --><?php
						} ?>
					</div>
			
				</div>
			</div>


	</header><!-- #masthead --> 
</div>
	<?php if ( function_exists( 'is_woocommerce' ) || function_exists( 'is_cart' ) || function_exists( 'is_chechout' ) ) :
	 if ( ( is_woocommerce() || is_cart() || is_checkout() ) && !is_front_page() ) { ?>
	   <?php $breadcrumb = get_theme_mod( 'breadcrumb',true ); ?>    
		   <div class="breadcrumb">
				<div class="container"><?php
				    if( !is_search() && !is_archive() && !is_404() ) : ?>
						<div class="breadcrumb-left eight columns">
							<h4><?php woocommerce_page_title(); ?></h4>   			
						</div><?php 
					endif; ?>
					<?php if( $breadcrumb ) : ?>
						<div class="breadcrumb-right eight columns">
							<?php woocommerce_breadcrumb(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
	<?php } 
	endif; ?>

	


