<?php
/**
 * Codepress Lite Theme Customizer.
 *
 * @package Codepress_Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function codepress_lite_customize_register( $wp_customize ) {
    $codepress_lite_options_categories = array();
    $codepress_lite_options_categories_obj = get_categories();
    $codepress_lite_options_categories[0] = __('Select Category:', 'codepress-lite');
    foreach ($codepress_lite_options_categories_obj as $category) {
        //$options_categories[$category->cat_ID] = $category->cat_name;
        $codepress_lite_options_categories[absint($category->cat_ID)] = esc_attr($category->cat_name);
    }
    
    class Codepress_Lite_Upgrade_To_Pro extends WP_Customize_Section {
		public $type = 'codepress-lite-upgrade';
		public function render() {

			$classes = 'accordion-section control-section-' . $this->type;
			$id = 'codpress-lite-upgrade-buttons-section';

			?>
			<li id="accordion-section-<?php echo esc_attr($this->id); ?>" class="<?php echo esc_attr($classes); ?>">
				<a class="codepress-lite-upgrade-to-pro-button" href="<?php echo esc_url('http://codetrendy.com/theme/codepress-pro/'); ?>" class="button" target="_blank"><?php echo __('Go Pro', 'codepress-lite'); ?></a>
			</li>
			<?php
 		}
	}

	class Codepress_Lite_upgrade_to_pro_section extends WP_Customize_Control {
		public function render_content() {
		}
	}
    
    $wp_customize->add_section( new Codepress_Lite_Upgrade_To_Pro( $wp_customize, 'codepress-lite-upgrade', array(
		'priority'   => '-1',
	) ) );

	$wp_customize->add_section( 'codepress_lite_upgrade_section', array(
		'title'	=> __( 'Sections order and Colors', 'codepress-lite' ),
		'priority' => 35
	));

	$wp_customize->add_setting( 'codepress_lite_upgrade_setting', array(
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( new Codepress_Lite_upgrade_to_pro_section( $wp_customize, 'codepress_lite_upgrade_setting', array(
		'section' => 'codepress_lite_upgrade_section',
	)));
    
    class Codepress_lite_Label_Highlight extends WP_Customize_Control {
        public $type = 'label_highlight';
        public $label = '';
        public function render_content() {
        ?>
            <div style="width:100%; border:1px solid;padding:2px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></div>
        <?php
        }
    }
    $site_tagline = $wp_customize->get_control('display_header_text');
    $site_tagline->label = esc_html__('Show Tagline', 'codepress-lite');
    
    
    
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    
     $wp_customize->add_setting('header_logo_option_setting', array(
            'default' => 'logo-only',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field'
       ));
       
       $wp_customize->add_control('header_logo_option_setting', array(
    		'type' => 'radio',
            'label' => __('Logo and Title', 'codepress-lite'),
    		'section' => 'title_tagline',
    		'settings' => 'header_logo_option_setting',
            'choices' => array('logo-only' => __('Logo Only', 'codepress-lite'), 
                                'title-only' => __('Title Only', 'codepress-lite'),
                                'both' => __('Both', 'codepress-lite')
                                )
    	));

       
    // slider options
    
    $wp_customize->add_section('codepress_lite_slider_section', array(
      'priority' => 1,
      'title' => __('Slider Options', 'codepress-lite'),
      
   ));
    
    $wp_customize->add_setting('codepress_lite_slider_category_setting', array( 
		'default' => 0,
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'codepress_lite_number_sanitize'
	));

	$wp_customize->add_control('codepress_lite_slider_category', array(
		'type' => 'select',
        'label' => __('Slider Category','codepress-lite'),
		'section' => 'codepress_lite_slider_section',
		'settings' => 'codepress_lite_slider_category_setting',
        'choices' => $codepress_lite_options_categories
	));
    
    $wp_customize->add_setting('codepress_lite_slider_read_more_setting', array( 
		'default' => __('Read More', 'codepress-lite'),
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('codepress_lite_slider_read_more', array(
		'type' => 'text',
        'label' => __('Read More Text','codepress-lite'),
		'section' => 'codepress_lite_slider_section',
		'settings' => 'codepress_lite_slider_read_more_setting',
	));
   
   
   // contact section
   $wp_customize->add_section('codepress_lite_contact_section', array(
      'priority' => 2,
      'title' => __('Contact Options', 'codepress-lite'),
      
   ));
   
   $wp_customize->add_setting('codepress_lite_contact_home_activate_setting', array(
    		'default' => 1,
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'codepress_lite_checkbox_sanitize'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_home_activate', array(
    		'type' => 'checkbox',
    		'label' => __('Activate in home page', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_home_activate_setting'
    	));
       
        // separator
        $wp_customize->add_setting('codepress_lite_contact_general_setting', array(
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_lite_separator_label_sanitize'
       ));
       
        $wp_customize->add_control(new Codepress_lite_Label_Highlight($wp_customize, 'codepress_lite_contact_general_separator' , array(
              'label' => __('Contact General setting', 'codepress-lite'),
              'section' => 'codepress_lite_contact_section',
              'settings' => 'codepress_lite_contact_general_setting'
           )));
        
       //title 
     $wp_customize->add_setting('codepress_lite_contact_home_title_setting', array(
    		'default' => __('Contact Us', 'codepress-lite'),
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_home_title', array(
    		'type' => 'text',
    		'label' => __('Title', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_home_title_setting'
    	)); 
        
        //description 
     $wp_customize->add_setting('codepress_lite_contact_home_description_setting', array(
    		'default' => __('Get in touch with us', 'codepress-lite'),
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_home_description', array(
    		'type' => 'textarea',
    		'label' => __('Description', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_home_description_setting'
    	));  
        
        // contact shortcode
    $wp_customize->add_setting('codepress_lite_contact_shortcode_setting', array(
    		'default' => '',
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_shortcode', array(
    		'type' => 'text',
    		'label' => __('Contact form 7 shortcode', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_shortcode_setting'
    	));
        
        // separator
        $wp_customize->add_setting('codepress_lite_contact_optional_setting', array(
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_lite_separator_label_sanitize'
       ));
       
        $wp_customize->add_control(new Codepress_lite_Label_Highlight($wp_customize, 'codepress_lite_contact_optional_separator' , array(
              'label' => __('Contact Optional setting', 'codepress-lite'),
              'section' => 'codepress_lite_contact_section',
              'settings' => 'codepress_lite_contact_optional_setting'
           )));
           
           
         // contact optional settings  
        $wp_customize->add_setting('codepress_lite_contact_home_optional_activate_setting', array(
    		'default' => 1,
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'codepress_lite_checkbox_sanitize'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_home_optional_activate', array(
    		'type' => 'checkbox',
    		'label' => __('Activate in home page', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_home_optional_activate_setting'
    	));
        
        
         // contact address
        $wp_customize->add_setting('codepress_lite_contact_address_setting', array(
    		'default' => '',
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_address', array(
    		'type' => 'textarea',
    		'label' => __('Address', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_address_setting'
    	));
        
        // contact phone
        $wp_customize->add_setting('codepress_lite_contact_phone_setting', array(
    		'default' => __('+12 3 4567 8910', 'codepress-lite'),
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_phone', array(
    		'type' => 'text',
    		'label' => __('Phone', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_phone_setting'
    	));
        
        // contact email
        $wp_customize->add_setting('codepress_lite_contact_email_setting', array(
    		'default' => __('hello@codetrendy.com', 'codepress-lite'),
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_email', array(
    		'type' => 'text',
    		'label' => __('Email', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_email_setting'
    	));
        
        // contact website
        $wp_customize->add_setting('codepress_lite_contact_website_setting', array(
    		'default' => esc_url('http://www.codetrendy.com'),
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'esc_url_raw'
    	));
    
    	$wp_customize->add_control('codepress_lite_contact_website', array(
    		'type' => 'url',
    		'label' => __('Website', 'codepress-lite'),
    		'section' => 'codepress_lite_contact_section',
    		'settings' => 'codepress_lite_contact_website_setting'
    	));
        
        
        
        
        // Theme Options panel
       $wp_customize->add_panel('codepress_lite_theme_options', array(
          'capabitity' => 'edit_theme_options',
          'description' => __('Theme options settings here', 'codepress-lite'),
          'priority' => 3,
          'title' => __('Theme Options', 'codepress-lite')
       ));
       
        // site Layout
        
        $wp_customize->add_section('codepress_lite_site_layout_settings', array(
    		'priority' => 1,
    		'title' => __('Site Layout', 'codepress-lite'),
            'panel' => 'codepress_lite_theme_options'
    	));
    
    	$wp_customize->add_setting('codepress_lite_site_layout', array(
    		'default' => 'fluid',
          'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
        
        $wp_customize->add_control('codepress_lite_site_layout', array(
    		'type' => 'radio',
    		'label' => __('Site Layout', 'codepress-lite'),
    		'section' => 'codepress_lite_site_layout_settings',
    		'settings' => 'codepress_lite_site_layout',
            'choices' => array(
                            'fluid' => __('Fluid', 'codepress-lite'),
                            'boxed' => __('Boxed', 'codepress-lite')                            )
    	));
    	
       // Breadcrumbs
        $wp_customize->add_section('codepress_lite_breadcrumbs_activate_settings', array(
    		'priority' => 1,
    		'title' => __('Activate Breadcrumbs', 'codepress-lite'),
            'panel' => 'codepress_lite_theme_options'
    	));
    
    	$wp_customize->add_setting('codepress_lite_breadcrumbs_activate', array(
    		'default' => 1,
          'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'codepress_lite_checkbox_sanitize'
    	));
        
        $wp_customize->add_control('codepress_lite_breadcrumbs_activate', array(
    		'type' => 'checkbox',
    		'label' => __('Check to activate breadcrumbs', 'codepress-lite'),
    		'section' => 'codepress_lite_breadcrumbs_activate_settings',
    		'settings' => 'codepress_lite_breadcrumbs_activate'
    	));
        
        
        //print_r($codepress_lite_options_categories);
        /*
        // blog
        $wp_customize->add_section('codepress_lite_blog_section', array(
    		'priority' => 2,
    		'title' => __('Blog Options', 'codepress-lite'),
            'panel' => 'codepress_lite_theme_options'
    	));
    
    	$wp_customize->add_setting('codepress_lite_blog_setting', array(
    		'default' => 0,
          'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'codepress_lite_number_sanitize'
    	));
        
        $wp_customize->add_control('codepress_lite_blog', array(
    		'type' => 'select',
    		'label' => __('Select category to show in blog template', 'codepress-lite'),
    		'section' => 'codepress_lite_blog_section',
    		'settings' => 'codepress_lite_blog_setting',
            'choices' => $codepress_lite_options_categories
    	));
        
        */

        
        
        
        // sidebar layouts
        class Codepress_Lite_Image_Radio_Control extends WP_Customize_Control {
    
     		public function render_content() {
    
    			if ( empty( $this->choices ) )
    				return;
    
    			$name = '_customize-radio-' . $this->id;
    
    			?>
    			<style>
    				#<?php echo esc_attr($this->id); ?> .codepress-radio-img-img {
    					border: 3px solid #DEDEDE;
    					margin: 0 5px 5px 0;
    					cursor: pointer;
    					border-radius: 3px;
    					-moz-border-radius: 3px;
    					-webkit-border-radius: 3px;
    				}
    				#<?php echo esc_attr($this->id); ?> .codepress-radio-img-selected {
    					border: 3px solid #AAA;
    					border-radius: 3px;
    					-moz-border-radius: 3px;
    					-webkit-border-radius: 3px;
    				}
    				input[type=checkbox]:before {
    					content: '';
    					margin: -3px 0 0 -4px;
    				}
    			</style>
    			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    			<ul class="controls" id='<?php echo esc_attr($this->id); ?>'>
    			<?php
    				foreach ( $this->choices as $value => $label ) :
    					$class = ($this->value() == $value)?'codepress-radio-img-selected codepress-radio-img-img':'codepress-radio-img-img';
    					?>
    					<li style="display: inline;">
    					<label>
    						<input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
    						<img src = '<?php echo esc_url( $label ); ?>' class = '<?php echo esc_attr($class); ?>' />
    					</label>
    					</li>
    					<?php
    				endforeach;
    			?>
    			</ul>
    			<script type="text/javascript">
    
    				jQuery(document).ready(function($) {
    					$('.controls#<?php echo esc_attr($this->id); ?> li img').click(function(){
    						$('.controls#<?php echo esc_attr($this->id); ?> li').each(function(){
    							$(this).find('img').removeClass ('codepress-radio-img-selected') ;
    						});
    						$(this).addClass ('codepress-radio-img-selected') ;
    					});
    				});
    
    			</script>
    			<?php
    		}
    	}
        
        
        
        
        
        
        
        
        
        
        // layout options
        $wp_customize->add_section('codepress_lite_sidebar_section', array(
    		'priority' => 2,
    		'title' => __('Sidebar Settings', 'codepress-lite'),
            'panel' => 'codepress_lite_theme_options'
    	));
    
        
        
        $wp_customize->add_setting('codepress_lite_default_sidebar_setting', array(
    		'default' => 'right-sidebar',
          'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
        
        $wp_customize->add_control(new  Codepress_Lite_Image_Radio_Control($wp_customize, 'codepress_lite_default_sidebar_setting', array(
    		'type' => 'radio',
    		'label' => __('Default Layout(Search, Archives, Nothng Found)', 'codepress-lite'),
    		'section' => 'codepress_lite_sidebar_section',
    		'settings' => 'codepress_lite_default_sidebar_setting',
    		'choices' => array(
    			'right-sidebar' =>  esc_url(CODEPRESS_LITE_ADMIN_IMAGES_URL . '/right-sidebar.png'),
    			'left-sidebar' =>  esc_url(CODEPRESS_LITE_ADMIN_IMAGES_URL . '/left-sidebar.png'),
    			'no-sidebar'	=>  esc_url(CODEPRESS_LITE_ADMIN_IMAGES_URL . '/no-sidebar.png'),
    			'both-sidebar'	=>  esc_url(CODEPRESS_LITE_ADMIN_IMAGES_URL . '/both-sidebar.png')
    		)
    	)));
        
        //page banner        
        $wp_customize->add_section('codepress_lite_page_banner_section', array(
    		'priority' => 3,
    		'title' => __('Banner Image For Page', 'codepress-lite'),
            'panel' => 'codepress_lite_theme_options'
    	));

        $wp_customize->add_setting('codepress_lite_page_banner_setting', array(
          'default' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
       ));
    
       $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'codepress_lite_page_banner', array(
          'label' => __('Upload banner image for page', 'codepress-lite'),
          'description' => __('Upload image size of 1920px X 570px ', 'codepress-lite'),
          'section' => 'codepress_lite_page_banner_section',
          'settings' => 'codepress_lite_page_banner_setting',
       )));
        
        
        //post banner        
        $wp_customize->add_section('codepress_lite_post_banner_section', array(
    		'priority' => 4,
    		'title' => __('Banner Image For Post', 'codepress-lite'),
            'panel' => 'codepress_lite_theme_options'
    	));

        $wp_customize->add_setting('codepress_lite_post_banner_setting', array(
          'default' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
       ));
    
       $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'codepress_lite_post_banner', array(
          'label' => __('Upload banner image for post', 'codepress-lite'),
          'description' => __('Upload image size of 1920px X 570px ', 'codepress-lite'),
          'section' => 'codepress_lite_post_banner_section',
          'settings' => 'codepress_lite_post_banner_setting',
       )));
       
       //default banner        
        $wp_customize->add_section('codepress_lite_default_banner_section', array(
    		'priority' => 5,
    		'title' => __('Default Banner Image', 'codepress-lite'),
            'panel' => 'codepress_lite_theme_options'
    	));

        $wp_customize->add_setting('codepress_lite_default_banner_setting', array(
          'default' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
       ));
    
       $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'codepress_default_post_banner', array(
          'label' => __('Upload default banner image  (Category, archive, search)', 'codepress-lite'),
          'description' => __('Upload image size of 1920px X 570px ', 'codepress-lite'),
          'section' => 'codepress_lite_default_banner_section',
          'settings' => 'codepress_lite_default_banner_setting',
       )));
        
        // Theme Options Ends here 
        
        
        
        // Footer section
       $wp_customize->add_section('codepress_lite_footer_section', array(
          'priority' => 3,
          'title' => __('Footer Options', 'codepress-lite'),
          
       ));
       
       // separator
        $wp_customize->add_setting('codepress_lite_home_footer_general_setting', array(
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_lite_separator_label_sanitize'
       ));
       
        $wp_customize->add_control(new Codepress_lite_Label_Highlight($wp_customize, 'codepress_lite_home_footer_general' , array(
              'label' => __('Footer Settings', 'codepress-lite'),
              'section' => 'codepress_lite_footer_section',
              'settings' => 'codepress_lite_home_footer_general_setting'
           )));
       
        // Enable Footer in home page 
        $wp_customize->add_setting('codepress_lite_footer_activate_setting', array(
    		'default' => 0,
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'codepress_lite_checkbox_sanitize'
    	));
    
    	$wp_customize->add_control('codepress_lite_footer_activate', array(
    		'type' => 'checkbox',
    		'label' => __('Activate in home page', 'codepress-lite'),
    		'section' => 'codepress_lite_footer_section',
    		'settings' => 'codepress_lite_footer_activate_setting'
    	));
       
       // separator
        $wp_customize->add_setting('codepress_lite_copyright_footer_setting', array(
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_lite_separator_label_sanitize'
       ));
       
        $wp_customize->add_control(new Codepress_lite_Label_Highlight($wp_customize, 'codepress_lite_copyright_footer' , array(
              'label' => __('Copyright Footer', 'codepress-lite'),
              'section' => 'codepress_lite_footer_section',
              'settings' => 'codepress_lite_copyright_footer_setting'
           )));
       
       // copyright footer
       $wp_customize->add_setting('codepress_lite_copyright_footer_text_setting', array(
    		'default' => __('All rights reserved', 'codepress-lite'),
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'sanitize_text_field'
    	));
    
    	$wp_customize->add_control('codepress_lite_copyright_footer_text', array(
    		'type' => 'text',
    		'label' => __('Copyright Footer Text', 'codepress-lite'),
    		'section' => 'codepress_lite_footer_section',
    		'settings' => 'codepress_lite_copyright_footer_text_setting'
    	));
        
        
        // Social Links Options //
    
        $wp_customize->add_section('codepress_lite_social_link_activate_settings', array(
    		'priority' => 200,
    		'title' => __('Social Icon Options', 'codepress-lite'),
    	));
    
                
        $wp_customize->add_setting('codepress_lite_social_link_activate_footer', array(
    		'default' => 1,
          'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'codepress_lite_checkbox_sanitize'
    	));        
    
    	$wp_customize->add_control('codepress_social_link_activate_footer', array(
    		'type' => 'checkbox',
    		'label' => __('Check to activate social icons in footer', 'codepress-lite'),
    		'section' => 'codepress_lite_social_link_activate_settings',
    		'settings' => 'codepress_lite_social_link_activate_footer'
    	));
    
    	$codepress_lite_social_links = array(
    		'codepress_lite_social_facebook' => array(
    			'id' => 'codepress_lite_social_facebook',
    			'title' => __('Facebook', 'codepress-lite'),
    			'default' => ''
    		),
    		'codepress_lite_social_twitter' => array(
    			'id' => 'codepress_lite_social_twitter',
    			'title' => __('Twitter', 'codepress-lite'),
    			'default' => ''
    		),
    		'codepress_lite_social_googleplus' => array(
    			'id' => 'codepress_lite_social_googleplus',
    			'title' => __('Google-Plus', 'codepress-lite'),
    			'default' => ''
    		),
            
    		'codepress_lite_social_youtube' => array(
    			'id' => 'codepress_lite_social_youtube',
    			'title' => __('YouTube', 'codepress-lite'),
    			'default' => ''
    		),
            
            'codepress_lite_social_linkedin' => array(
    			'id' => 'codepress_lite_social_linkedin',
    			'title' => __('Linkedin', 'codepress-lite'),
    			'default' => ''
    		),
            
            'codepress_lite_social_instagram' => array(
    			'id' => 'codepress_lite_social_instagram',
    			'title' => __('Instagram', 'codepress-lite'),
    			'default' => ''
    		),
            
    		'codepress_lite_social_pinterest' => array(
    			'id' => 'codepress_lite_social_pinterest',
    			'title' => __('Pinterest', 'codepress-lite'),
    			'default' => ''
    		),
            
            'codepress_lite_social_tumbler' => array(
    			'id' => 'codepress_lite_social_tumbler',
    			'title' => __('Tumbler', 'codepress-lite'),
    			'default' => ''
    		),
    		
            
    	);
    
    	$i = 20;
    
    	foreach($codepress_lite_social_links as $codepress_lite_social_link) {
    
    		$wp_customize->add_setting($codepress_lite_social_link['id'], array(
    			'default' => $codepress_lite_social_link['default'],
             'capability' => 'edit_theme_options',
    			'sanitize_callback' => 'esc_url_raw'
    		));
    
    		$wp_customize->add_control($codepress_lite_social_link['id'], array(
    			'label' => $codepress_lite_social_link['title'],
    			'section'=> 'codepress_lite_social_link_activate_settings',
    			'settings'=> $codepress_lite_social_link['id'],
    			'priority' => $i
    		));
    
    		$i++;
    
    	}
       // End of the Social Link Options //
        
        
        // checkbox sanitization
       function codepress_lite_checkbox_sanitize($input) {
          if ( $input == 1 ) {
             return 1;
          } else {
             return 0;
          }
       }
       
       function codepress_lite_number_sanitize($input){
        return absint($input);
       }
       
   
}
add_action( 'customize_register', 'codepress_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function codepress_lite_customize_preview_js() {
	wp_enqueue_script( 'codepress_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'codepress_lite_customize_preview_js' );
