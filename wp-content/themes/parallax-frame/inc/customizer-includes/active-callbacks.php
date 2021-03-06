<?php
/**
 * Active callbacks for Theme/Customzer Options
 *
 * @package Catch Themes
 * @subpackage Parallax Frame
 * @since Parallax Frame 0.1
 */

if ( ! function_exists( 'parallax_frame_is_header_highlight_content_active' ) ) :
	/**
	* Return true if header highlight content is active
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_header_highlight_content_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'parallax_frame_theme_options[header_highlight_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_demo_header_highlight_content_inactive' ) ) :
	/**
	* Return true if demo header highlight content is inactive
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_demo_header_highlight_content_inactive( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable 	= $control->manager->get_setting( 'parallax_frame_theme_options[header_highlight_content_option]' )->value();

		$type 	= $control->manager->get_setting( 'parallax_frame_theme_options[header_highlight_content_type]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected and is not demo content
		return ( ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) ) && !( 'demo-header-highlight-content' == $type ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_slider_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'parallax_frame_theme_options[featured_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_demo_slider_inactive' ) ) :
	/**
	* Return true if demo slider is inactive
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_demo_slider_inactive( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable	= $control->manager->get_setting( 'parallax_frame_theme_options[featured_slider_option]' )->value();

		$type 	= $control->manager->get_setting( 'parallax_frame_theme_options[featured_slider_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected and is not demo slider
		return ( ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) ) && !( 'demo-featured-slider' == $type ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since  Parallax Frame 1.0
	*/
	function parallax_frame_is_hero_content_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'parallax_frame_theme_options[hero_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_demo_hero_content_inactive' ) ) :
	/**
	* Return true if demo hero content is inactive
	*
	* @since  Parallax Frame 1.0
	*/
	function parallax_frame_is_demo_hero_content_inactive( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'parallax_frame_theme_options[hero_content_option]' )->value();

		$type 	= $control->manager->get_setting( 'parallax_frame_theme_options[hero_content_type]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected and is not demo content
		return ( ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) ) && !( 'demo-hero-content' == $type ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_featured_content_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'parallax_frame_theme_options[featured_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_demo_featured_content_inactive' ) ) :
	/**
	* Return true if demo featured content is inactive
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_demo_featured_content_inactive( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'parallax_frame_theme_options[featured_content_option]' )->value();

		$type 	= $control->manager->get_setting( 'parallax_frame_theme_options[featured_content_type]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected and is not demo content
		return ( ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) ) && !( 'demo-featured-content' == $type ) );
	}
endif;

if ( ! function_exists( 'parallax_frame_is_promotional_headline_enabled' ) ) :
	/**
	* Return true if is top header is not enabled
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_promotional_headline_enabled( $control ) {
		$enabled = $control->manager->get_setting( 'parallax_frame_theme_options[promotion_headline_option]' )->value();

		if ( 'disabled' != $enabled  ) {
			return true;
		}else{
			return false;
		}
	}
endif;

if ( ! function_exists( 'parallax_frame_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_portfolio_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'parallax_frame_theme_options[portfolio_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_demo_portfolio_inactive' ) ) :
	/**
	* Return true if demo header highlight content is inactive
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_demo_portfolio_inactive( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable 	= $control->manager->get_setting( 'parallax_frame_theme_options[portfolio_option]' )->value();

		$type 	= $control->manager->get_setting( 'parallax_frame_theme_options[portfolio_type]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected and is not demo content
		return ( ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) ) && !( 'demo-portfolio' == $type ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_logo_slider_active' ) ) :
	/**
	* Return true if logo_slider is active
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_logo_slider_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'parallax_frame_theme_options[logo_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of logo_slider option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) );
	}
endif;


if ( ! function_exists( 'parallax_frame_is_demo_logo_slider_inactive' ) ) :
	/**
	* Return true if demo logo_slider is inactive
	*
	* @since  Parallax Frame 0.1
	*/
	function parallax_frame_is_demo_logo_slider_inactive( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable	= $control->manager->get_setting( 'parallax_frame_theme_options[logo_slider_option]' )->value();

		$type 	= $control->manager->get_setting( 'parallax_frame_theme_options[logo_slider_type]' )->value();

		//return true only if previwed page on customizer matches the type of logo_slider option selected and is not demo logo_slider
		return ( ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable  ) ) && !( 'demo' == $type ) );
	}
endif;