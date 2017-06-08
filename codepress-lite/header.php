<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Codepress_Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'codepress-lite' ); ?></a>
    <?php $logo_title = get_theme_mod('header_logo_option_setting', 'logo-only'); 
    //$tagline = get_theme_mod('header_tagline_option_setting');
    //echo $tagline;            

    $description = get_bloginfo( 'description', 'display' );
    $header_textcolor = get_theme_mod('header_textcolor');
    if($logo_title == 'logo-only')
    {
        $logo_class = 'logo-tagline';
    }
    else
    {
        $logo_class = '';
    }
    
    if($logo_title == 'logo-only' )
    {
        $logo_class .= ' logo_only'; 
    }
    ?>
	<?php /* <header id="masthead" class="site-header <?php echo esc_attr($logo_class); ?>" role="banner">
        <div class="container">
				<div class="site-branding <?php //echo $tagline == 1 ? '' : 'cl_tagline'; ?>">
                    <?php 
                    
                    if($logo_title == 'logo-only' || $logo_title == 'both'){
                        $site_logo = get_theme_mod( 'custom_logo' ); 
                        if(!empty($site_logo)): ?>
                        <div class="header-title-logo cl-tagline-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; 
                    }
                    if($logo_title == 'title-only' || $logo_title == 'both' || isset($description)|| is_customize_preview() ){
                    ?>
                        <div class="logo-text <?php if($header_textcolor == 'blank' && $logo_title == 'title-only') echo "cl-title-tagline" ?>">
                        <?php if($logo_title == 'title-only' || $logo_title == 'both' ){ ?>
        					<h1 id="site-title">
        						<a rel="home" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        					</h1>
                            <?php
                            }
                            if ( $description || is_customize_preview() ) : ?>
                            <p id="site-description"><?php echo esc_attr($description); ?></p>
                         <?php endif;?><!-- #site-description -->
                         </div>
                    <?php
                    }
                    
                     ?>
				</div><!-- .site-branding --> 

                <div class="cl_search_icon">
                    <i class="fa fa-search"></i>
                    <div class="hidden_search_form">
                        <?php get_search_form(); ?>
                    </div>
                </div>

				<nav role="navigation" class="main-navigation" id="site-navigation">
					
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-navicon"></i></button>
			         <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>			
				</nav><!-- #site-navigation -->


			</div> 
	</header><!-- #masthead --> */?>

    <!-- .no-tagline for Title Only  and .logo-tagline for logo only, both -->
    
    <?php 
    if( $header_textcolor == 'blank'){
        if($logo_title == 'title-only'){
            $header_class = 'no-tagline';
        }
        else{
            $header_class = 'logo-tagline';
        } 
    }
    elseif( $header_textcolor != 'blank' && $logo_title == 'logo-only' ){
        $header_class = 'logo-tagline';
    }
    else{
        $header_class = '';
    }
    ?>
    <header id="masthead" class="site-header <?php echo esc_attr($header_class); ?>" role="banner">
        <div class="container">
            <div class="site-logo">
                <?php
                if($logo_title == 'logo-only' || $logo_title == 'both'){
                        $site_logo = get_theme_mod( 'custom_logo' ); 
                        if(!empty($site_logo)): ?>
                        <div class="logo-img">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php endif; 
                    }
                    ?>
                
                <div class="site-branding">
                <?php if($logo_title == 'title-only' || $logo_title == 'both' ){ ?>
                    <h1 class="site-title"><a rel="home" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php } 
                    if ( $header_textcolor != 'blank' && ( $description || is_customize_preview() ) ) { ?>
                    <p class="site-description"><?php echo esc_attr($description); ?></p>
                    <?php } ?>
                </div>
            </div> 

            <div class="cl_search_icon">
                    <i class="fa fa-search"></i>
                    <div class="hidden_search_form">
                        <?php get_search_form(); ?>
                    </div>
                </div>

            <!-- .site-branding -->
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-navicon"></i></button>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav>
            <!-- #site-navigation -->
        </div>
    </header>



	<div id="content" class="site-content">
