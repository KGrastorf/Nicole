<?php

/**
 * Codepress-Corporate Theme Customizer
 *
 * @package CodeTrendy
 * @subpackage Codepress-Corporate
 * @since 
 */

function codepress_corporate_customize_register($wp_customize) {


    
  //Titles
    class Codepress_Corporate_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border:1px solid;padding:5px;color:#58719E;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    } 


//category Dropdown
    $codepress_corporate_select_lists = array();
    $codepress_corporate_options_pages_obj = get_pages('sort_column=post_parent,menu_order');

//page Dropdown
    foreach ($codepress_corporate_options_pages_obj as $page) {
        $codepress_corporate_select_lists[absint($page->ID)] =  esc_attr($page->post_title);
       
    }

    $codepress_corporate_options_categories = array();
    $codepress_corporate_options_categories_obj = get_categories();
    $codepress_corporate_options_categories[''] =  esc_html__('Select Category:', 'codepress-corporate');
    
    foreach ($codepress_corporate_options_categories_obj as $category) {
        $codepress_corporate_options_categories[absint($category->cat_ID)] = esc_attr($category->cat_name); 
    }

//Logo image 

    $wp_customize->add_setting( 'codepress_corporate_logo_optipn', array(
      'default' => 'header_text_only',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'codepress_corporate_header_logo_sanitize'
      ) );
    $wp_customize->add_control( 'codepress_corporate_logo_optipn', array(
      'type' => 'radio',
      'label' => esc_html__( 'Choose the Optipn you want', 'codepress-corporate' ),
      'section' => 'title_tagline',
      'choices' => array( 
            'header_text_only' => esc_html__( 'Header Text Only', 'codepress-corporate' ),
            'header_logo_only' => esc_html__( 'Header Logo Only', 'codepress-corporate' ),
            'show_both'        => esc_html__( 'Show Both', 'codepress-corporate' ),
            'disable'          => esc_html__( 'Disable', 'codepress-corporate' )
       ) ) );


  /**Slider section */

      $wp_customize->add_section( 'codepress_corporate_slider_section',
         array(
            'title'      => esc_html__('Slider Settings' , 'codepress-corporate'),
            'priority'   =>10,
            'capability' => 'edit_theme_options'
            ));
            
       $wp_customize->add_setting('codepress_corporate_slider_activation_setting', array(
          'default'           => 1,
          'type'              => 'option',
          'priority'          => '',
          'capability'        => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_slider_activation_setting', array(
        'type'      => 'checkbox',
        'label'     => esc_html__('Check To Activate Slider', 'codepress-corporate'),
        'section'   => 'codepress_corporate_slider_section',
        'settings'  => 'codepress_corporate_slider_activation_setting',
        'choices'   => $codepress_corporate_options_categories
      ));
            
      $wp_customize->add_setting('codepress_corporate_slider_category_setting', array(
          'default'           => '',
          'type'              => 'option',
          'priority'          => '',
          'capability'        => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field'
          ));

      $wp_customize->add_control('codepress_corporate_slider_category_setting', array(
        'type'      => 'select',
        'label'     => esc_html__('Select Category For Header Slider', 'codepress-corporate'),
        'section'   => 'codepress_corporate_slider_section',
        'settings'  => 'codepress_corporate_slider_category_setting',
        'choices'   => $codepress_corporate_options_categories
      ));

/** Home page panel start */
  $wp_customize->add_panel( 'corporate_codepress_home_panel',
      array(
         'title' => esc_html__( 'Front page settings' , 'codepress-corporate'),
         'description' => esc_html__( 'Change Front page settings from here you want', 'codepress-corporate' ),
         'priority' => 50,
         'capability' => 'edit_theme_options'
         ));
    //First Call to action section start 

      $wp_customize->add_section( 'codepress_corporate_call_to_action_1', array(
            'title' => esc_html__( 'Call To Action Settings', 'codepress-corporate'),
            'panel' => 'corporate_codepress_home_panel',
            'priority' =>300,
         ));

       $wp_customize->add_setting('codepress_corporate_call_to_action_activate', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_call_to_action_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate call to action area', 'codepress-corporate'),
        'section' => 'codepress_corporate_call_to_action_1',
        'settings' => 'codepress_corporate_call_to_action_activate',
        
      ));


      $wp_customize->add_setting('codepress_corporate_call_to_action_title', array(
            'priority' => 1,
            'default' => esc_html__( 'Title' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_call_to_action_title', array(
            'type' => 'text',
            'label' => esc_html__( 'Call to action title', 'codepress-corporate'),
            'description' => esc_html__('Type to change title', 'codepress-corporate'),
            'section' => 'codepress_corporate_call_to_action_1',
            'setting' => 'codepress_corporate_call_to_action_title'   
         ));

      $wp_customize->add_setting('codepress_corporate_call_to_action_content', array(
            'priority' => 1,
            'default' => esc_html__( 'Content' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'codepress_corporate_sanitize_textarea',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_call_to_action_content', array(
            'type' => 'textarea',
            'label' => esc_html__( 'Call to action content area', 'codepress-corporate'),
            'description' => esc_html__('Type for call to actioon content', 'codepress-corporate'),
            'section' => 'codepress_corporate_call_to_action_1',
            'setting' => 'codepress_corporate_call_to_action_content'   
         ));

      $wp_customize->add_setting('codepress_corporate_call_to_action_read_more', array(
            'priority' => 1,
            'default' => esc_html__( 'Read More' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_call_to_action_read_more', array(
            'type' => 'text',
            'label' => esc_html__( 'Read More text', 'codepress-corporate'),
            'description' => esc_html__('change read more text', 'codepress-corporate'),
            'section' => 'codepress_corporate_call_to_action_1',
            'setting' => 'codepress_corporate_call_to_action_read_more'   
         ));

       $wp_customize->add_setting('codepress_corporate_call_to_action_read_more_url', array(
            'priority' => 1,
            'default' => '#',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_call_to_action_read_more_url', array(
            'type' => 'text',
            'label' => esc_html__( 'Read More URL', 'codepress-corporate'),
            'description' => esc_html__('Enter read more URL', 'codepress-corporate'),
            'section' => 'codepress_corporate_call_to_action_1',
            'setting' => 'codepress_corporate_call_to_action_read_more_url'   
         ));

      

//About us section

      $wp_customize->add_section( 'codepress_corporate_about_us_section' , array(
        'title' => esc_html__( 'About Us Settings' , 'codepress-corporate'),
        'panel' => 'corporate_codepress_home_panel',
        'priority' => 400,
        ));

      $wp_customize->add_setting('codepress_corporate_about_us_activate', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_about_us_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate about us area', 'codepress-corporate'),
        'section' => 'codepress_corporate_about_us_section',
        'settings' => 'codepress_corporate_about_us_activate',
        
      ));

      $wp_customize->add_setting('codepress_corporate_about_us_title', array(
            'priority' => 1,
            'default' => esc_html__( 'About Us' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_about_us_title', array(
            'type' => 'text',
            'label' => esc_html__( 'About Us title', 'codepress-corporate'),
            'description' => esc_html__('Type About Us title', 'codepress-corporate'),
            'section' => 'codepress_corporate_about_us_section',
            'setting' => 'codepress_corporate_about_us_title'   
         ));

      $wp_customize->add_setting('codepress_corporate_about_us_page', array(
            'priority' => 2,
            'default' => esc_html__( 'About Us page' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_about_us_page', array(
            'type' => 'select',
            'choices' => $codepress_corporate_select_lists,
            'label' => esc_html__( 'About Us page', 'codepress-corporate'),
            'description' => esc_html__('Select page for About Us', 'codepress-corporate'),
            'section' => 'codepress_corporate_about_us_section',
            'setting' => 'codepress_corporate_about_us_page'   
         ));
      $wp_customize->add_setting('codepress_corporate_cta_read_more', array(
            'priority' => 30,
            'default' => esc_html__( 'More Info' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_cta_read_more', array(
            'type' => 'text',
            'label' => esc_html__( 'Read More text', 'codepress-corporate'),
            'description' => esc_html__('change more info text', 'codepress-corporate'),
            'section' => 'codepress_corporate_about_us_section',
            'setting' => 'codepress_corporate_cta_read_more'   
         ));

       $wp_customize->add_setting('codepress_corporate_about_us_read_more_url', array(
            'priority' => 1,
            'default' => '#',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_about_us_read_more_url', array(
            'type' => 'text',
            'label' => esc_html__( 'Read More URL', 'codepress-corporate'),
            'description' => esc_html__('Enter read more URL', 'codepress-corporate'),
            'section' => 'codepress_corporate_about_us_section',
            'setting' => 'codepress_corporate_about_us_read_more_url'   
         ));
      
  //Services section start 

      $wp_customize->add_section( 'codepress_corporate_services_section', array(
          'title' => esc_html__( 'Services Settings', 'codepress-corporate' ),
          'panel' => 'corporate_codepress_home_panel',
          'priority' =>200,
        ));

      $wp_customize->add_setting('codepress_corporate_services_activate', array(
          'default' => 1,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_services_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate services area', 'codepress-corporate'),
        'section' => 'codepress_corporate_services_section',
        'settings' => 'codepress_corporate_services_activate',
        'priority' => 5,
      ));

      $wp_customize->add_setting( 'codepress_corporate_services_title', array(
          'type' => 'option',
          'default' => esc_html__( 'Title', 'codepress-corporate' ),
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'transport' => 'refresh'   
        ));
      $wp_customize->add_control( 'codepress_corporate_services_title', array(
          'type' => 'text',
          'priority' => 10,
          'label' => esc_html__( 'Services title', 'codepress-corporate'),
          'description' => esc_html__( 'Type title for Services', 'codepress-corporate'),
          'section' => 'codepress_corporate_services_section',
          'setting' => 'codepress_corporate_services_title'
        ));

      $wp_customize->add_setting( 'codepress_corporate_services_description', array(
          'type' => 'option',
          'default' => esc_html__( 'Description', 'codepress-corporate' ),
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_sanitize_textarea',
          'transport' => 'refresh'   
        ));
      $wp_customize->add_control( 'codepress_corporate_services_description', array(
          'type' => 'textarea',
          'priority' => 15,
          'label' => esc_html__( 'Services description', 'codepress-corporate'),
          'description' => esc_html__( 'Type description for Services', 'codepress-corporate'),
          'section' => 'codepress_corporate_services_section',
          'setting' => 'codepress_corporate_services_description'
        ));

      $wp_customize->add_setting( 'codepress_corporate_services_dropdown_categories', array(
          'type' => 'option',          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'transport' => 'refresh' 
        ));
      $wp_customize->add_control( 'codepress_corporate_services_dropdown_categories', array(
          'type' => 'select',
          'priority' => 20,
          'label' => esc_html__( 'Services categories', 'codepress-corporate'),
          'choices' => $codepress_corporate_options_categories,
          'description' => esc_html__( 'Services Category', 'codepress-corporate'),
          'section' => 'codepress_corporate_services_section',
          'setting' => 'codepress_corporate_services_dropdown_categories',
        ));

      $wp_customize->add_setting('codepress_corporate_services_charecter_count', array(
            'type' => 'option',
            'default' => 20,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_services_charecter_count', array(
            'type' => 'number', 
            'priority' => 25,           
            'label' => esc_html__( 'Number Of Charecter To Show', 'codepress-corporate'),
            'description' => esc_html__('Enter no. to limit post charecter', 'codepress-corporate'),
            'section' => 'codepress_corporate_services_section',
            'setting' => 'codepress_corporate_services_charecter_count' 
         ));


      $wp_customize->add_setting('codepress_corporate_services_read_more', array(
            'priority' => 30,
            'default' => esc_html__( 'Read More' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_services_read_more', array(
            'type' => 'text',
            'label' => esc_html__( 'Read More Text', 'codepress-corporate'),
            'description' => esc_html__('Change read more text', 'codepress-corporate'),
            'section' => 'codepress_corporate_services_section',
            'setting' => 'codepress_corporate_services_read_more'   
         ));

    //Portfolio section 

      $wp_customize->add_section('codepress_corporate_posrtfolio_section', array(
          'title' => esc_html__( 'Portfolio Settings' , 'codepress-corporate' ),
          'panel' => 'corporate_codepress_home_panel',
          'priority' => 700,
        ));

      $wp_customize->add_setting('codepress_corporate_portfolio_section_activate', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_portfolio_section_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate portfolio area', 'codepress-corporate'),
        'section' => 'codepress_corporate_posrtfolio_section',
        'settings' => 'codepress_corporate_portfolio_section_activate',
        
      ));

      $wp_customize->add_setting('codepress_corporate_posrtfolio_title', array(
            'priority' => 1,
            'default' => esc_html__( 'Our Works' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_posrtfolio_title', array(
            'type' => 'text',
            'label' => esc_html__( 'Portfolio Title', 'codepress-corporate'),
            'description' => esc_html__('Enter title for portfolio', 'codepress-corporate'),
            'section' => 'codepress_corporate_posrtfolio_section',
            'setting' => 'codepress_corporate_posrtfolio_title'   
         ));


      $wp_customize->add_setting( 'codepress_corporate_portfolio_category', array(
          'type' => 'option',
          'priority' => 7,          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'transport' => 'refresh' 
        ));

      $wp_customize->add_control( 'codepress_corporate_portfolio_category', array(
          'type' => 'select',          
          'label' => esc_html__( 'Portfolio Categories', 'codepress-corporate'),
          'choices' => $codepress_corporate_options_categories,
          'description' => esc_html__( 'Select portfolio category', 'codepress-corporate'),
          'section' => 'codepress_corporate_posrtfolio_section',
          'setting' => 'codepress_corporate_portfolio_category'
        ));

      $wp_customize->add_setting( 'codepress_corporate_portfolio_view_all', array(
          'type' => 'option',
          'priority' => 10,          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'transport' => 'refresh'
        ));

      $wp_customize->add_control( 'codepress_corporate_portfolio_view_all', array(
          'type' => 'text',          
          'label' => esc_html__( 'View All Text', 'codepress-corporate'),
          'description' => esc_html__( 'Type to change view all text', 'codepress-corporate'),
          'section' => 'codepress_corporate_posrtfolio_section',
          'setting' => 'codepress_corporate_portfolio_view_all'
        ));

        $wp_customize->add_setting( 'codepress_corporate_portfolio_view_all_url', array(
          'type' => 'option',
          'priority' => 10,          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw',
          'transport' => 'refresh'
        ));

      $wp_customize->add_control( 'codepress_corporate_portfolio_view_all_url', array(
          'type' => 'text',          
          'label' => esc_html__( 'View All text URL', 'codepress-corporate'),
          'description' => esc_html__( 'Enter View All URL', 'codepress-corporate'),
          'section' => 'codepress_corporate_posrtfolio_section',
          'setting' => 'codepress_corporate_portfolio_view_all_url'
        ));

//Testimonials section 

      $wp_customize->add_section('codepress_corporate_testimonials_section', array(
          'title' => esc_html__( 'Testimonial Settings' , 'codepress-corporate' ),
          'panel' => 'corporate_codepress_home_panel', 
          'priority' => 800,
        ));

      $wp_customize->add_setting('codepress_corporate_testimonials_activate', array(
          'default' => 1,
          'priority' => 0,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_testimonials_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate testimonials area', 'codepress-corporate'),
        'section' => 'codepress_corporate_testimonials_section',
        'settings' => 'codepress_corporate_testimonials_activate',
        
      ));

       $wp_customize -> add_setting( 'codepress_corporate_testimonial_background_image', 
         array(
            'priority' => 5,
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
         ) );
      $wp_customize -> add_control( new WP_Customize_Image_Control( $wp_customize, 'codepress_corporate_testimonial_background_image' ,
         array(
           'type' => 'image',
           'label' => esc_html__( 'Background Image' , 'codepress-corporate'),
           'description' => esc_html__('Upload image for background', 'codepress-corporate'),
           'section' => 'codepress_corporate_testimonials_section',
           'setting' => 'codepress_corporate_testimonial_background_image'
          )));

      
      $wp_customize->add_setting('codepress_corporate_testimonials_title', array(
            'priority' => 1,
            'default' => esc_html__( 'Testimonials' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_testimonials_title', array(
            'type' => 'text',
            'label' => esc_html__( 'Testimonial Title', 'codepress-corporate'),
            'description' => esc_html__('Enter title for testimonial', 'codepress-corporate'),
            'section' => 'codepress_corporate_testimonials_section',
            'setting' => 'codepress_corporate_testimonials_title'   
         ));

      $wp_customize->add_setting( 'codepress_corporate_testimonials_category', array(
          'type' => 'option',
          'priority' => 2,          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'transport' => 'refresh' 
        ));

      $wp_customize->add_control( 'codepress_corporate_testimonials_category', array(
          'type' => 'select',          
          'label' => esc_html__( 'Testimonial categories', 'codepress-corporate'),
          'choices' => $codepress_corporate_options_categories,
          'description' => esc_html__( 'Select testimonial category', 'codepress-corporate'),
          'section' => 'codepress_corporate_testimonials_section',
          'setting' => 'codepress_corporate_testimonials_category'
        ));

// Client section 

      $wp_customize->add_section('codepress_corporate_client_section', array(
          'title' => esc_html__( 'Client Settings' , 'codepress-corporate' ),
          'panel' => 'corporate_codepress_home_panel',
          'priority' => 900,
        ));

       $wp_customize->add_setting('codepress_corporate_client_activate', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_client_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate client area', 'codepress-corporate'),
        'section' => 'codepress_corporate_client_section',
        'settings' => 'codepress_corporate_client_activate',
      ));


      $wp_customize->add_setting('codepress_corporate_client_title', array(
            'priority' => 1,
            
            'default' => esc_html__( 'Client' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_client_title', array(
            'type' => 'text',
            'label' => esc_html__( 'Client portion title', 'codepress-corporate'),
            'description' => esc_html__('Enter title for client', 'codepress-corporate'),
            'section' => 'codepress_corporate_client_section',
            'setting' => 'codepress_corporate_client_title'  
         ));

      $wp_customize->add_setting( 'codepress_corporate_client_category', array(
          'type' => 'option',
          'priority' => 2,          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'transport' => 'refresh' 
        ));

      $wp_customize->add_control( 'codepress_corporate_client_category', array(
          'type' => 'select',          
          'label' => esc_html__( 'Client categories', 'codepress-corporate'),
          'choices' => $codepress_corporate_options_categories,
          'description' => esc_html__( 'Select client category', 'codepress-corporate'),
          'section' => 'codepress_corporate_client_section',
          'setting' => 'codepress_corporate_client_category'
        ));


//Blog  section setting

      $wp_customize->add_section('codepress_corporate_blog_section', array(
          'title' => esc_html__( 'Blog Settings' , 'codepress-corporate' ),
          'panel' => 'corporate_codepress_home_panel',
          'priority' => 1000,
        ));

      $wp_customize->add_setting('codepress_corporate_blog_activate', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_blog_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate Blog area', 'codepress-corporate'),
        'section' => 'codepress_corporate_blog_section',
        'settings' => 'codepress_corporate_blog_activate',       
      ));

       $wp_customize->add_setting('codepress_corporate_blog_title', array(
            'priority' => 1,
            'default' => esc_html__( 'Blog' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_blog_title', array(
            'type' => 'text',
            'label' => esc_html__( 'Blog section title', 'codepress-corporate'),
            'description' => esc_html__('Enter title for blog', 'codepress-corporate'),
            'section' => 'codepress_corporate_blog_section',
            'setting' => 'codepress_corporate_blog_title' 
         ));

       $wp_customize->add_setting( 'codepress_corporate_blog_page', array(
          'type' => 'option',
          'priority' => 1,          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'transport' => 'refresh' 
        ));

      $wp_customize->add_control( 'codepress_corporate_blog_page', array(
          'type' => 'select',          
          'label' => esc_html__( 'Blog Pages ', 'codepress-corporate'),
          'choices' => $codepress_corporate_options_categories,
          'description' => esc_html__( 'Select blog page', 'codepress-corporate'),
          'section' => 'codepress_corporate_blog_section',
          'setting' => 'codepress_corporate_blog_page'
        ));

      $wp_customize->add_setting('codepress_corporate_blog_charecter_count', array(
            'priority' => 1,
            'default' => 50,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_blog_charecter_count', array(
            'type' => 'number',
            'label' => esc_html__( 'No. Of Words', 'codepress-corporate'),
            'description' => esc_html__('Enter no. of words to show', 'codepress-corporate'),
            'section' => 'codepress_corporate_blog_section',
            'setting' => 'codepress_corporate_blog_charecter_count' 
         ));


      $wp_customize->add_setting('codepress_corporate_blog_post_read_more', array(
            'priority' => 4,
            'default' => esc_html__( 'Read More' , 'codepress-corporate'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_blog_post_read_more', array(
            'type' => 'text',
            'label' => esc_html__( 'Read More Text', 'codepress-corporate'),
            'description' => esc_html__('Type to chage read more text', 'codepress-corporate'),
            'section' => 'codepress_corporate_blog_section',
            'setting' => 'codepress_corporate_blog_post_read_more'   
         ));

      $wp_customize->add_setting('codepress_corporate_blog_post_read_more_url', array(
            'priority' => 4,
            'default' => '',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh'
         ));
      $wp_customize->add_control( 'codepress_corporate_blog_post_read_more_url', array(
            'type' => 'text',
            'label' => esc_html__( 'View All URL', 'codepress-corporate'),
            'description' => esc_html__('Type View All URL. View all button will disable if url field left empty', 'codepress-corporate'),
            'section' => 'codepress_corporate_blog_section',
            'setting' => 'codepress_corporate_blog_post_read_more_url'  
         ));
    

  //End of blog 

  //End of home page panel


  //Them option panel

  $wp_customize->add_panel( 'theme_option_panel' ,array(
         'title' => esc_html__( 'Theme options' , 'codepress-corporate'),
         'description' => esc_html__( 'Customize your theme opton', 'codepress-corporate' ),
         'priority' => 55,
         'capability' => 'edit_theme_options'
    ));

      $wp_customize->add_setting('codepress_corporate_option_activate', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_option_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate option area', 'codepress-corporate'),
        'section' => 'codepress_corporate_contact_section',
        'settings' => 'codepress_corporate_option_activate',      
      ));

//Top Header Info section setting 

      $wp_customize->add_section( 'codepress_corporate_info_section' , array(
          'title' => esc_html__( 'Top Header Fields', 'codepress-corporate' ),
          'panel' => 'theme_option_panel',
          'priority' => 9,
        ));

       $wp_customize->add_setting('codepress_corporate_info', array(
          'default' => 0,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_attr'
          ));

      $wp_customize->add_control( new Codepress_corporate_Info( $wp_customize, 'codepress_corporate_info', array(
        'label' => esc_html__('Contact Info', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_info',      
      )));

      $wp_customize->add_setting('codepress_corporate_info_activate', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_info_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check To Activate Contact Info', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_info_activate',      
      ));

       $wp_customize->add_setting('codepress_corporate_top_contact_number', array(
          'default' => '987654321',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field'
          ));      
      $wp_customize->add_control('codepress_corporate_top_contact_number', array(
        'type' => 'text',
        'label' => esc_html__('Contact no', 'codepress-corporate'),
        'description' => esc_html__( 'Enter contact no. to display in top ', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_top_contact_number'
      ));

      $wp_customize->add_setting('codepress_corporate_top_email', array(
          'default' => 'info@codetrendy.com',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_sanitize_email'
          ));
      $wp_customize->add_control('codepress_corporate_top_email', array(
        'type' => 'text',
        'label' => esc_html__('Email Address', 'codepress-corporate'),
        'description' => esc_html__( 'Enter Email to display in top ', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_top_email'
      ));

//Top Header  social
      

       $wp_customize->add_setting('codepress_corporate_info_social', array(
          'default' => 0,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_attr'
          ));

      $wp_customize->add_control( new Codepress_corporate_Info( $wp_customize, 'codepress_corporate_info_social', array(
        'label' => esc_html__('Social links', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_info_social',      
      )));

      $wp_customize->add_setting('codepress_corporate_social_link_activate', array(
          'default' => 1,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_social_link_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate social links area', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_social_link_activate'
      ));

      $wp_customize->add_setting('codepress_corporate_social_facebook', array(
          'default' => 'https://www.facebook.com/codetrendy/',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
          ));

      $wp_customize->add_control('codepress_corporate_social_facebook', array(
        'type' => 'text',
        'label' => esc_html__('Facebook', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_social_facebook'
      ));

      $wp_customize->add_setting('codepress_corporate_social_twitter', array(
          'default' => 'http://twitter.com/',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
          ));

      $wp_customize->add_control('codepress_corporate_social_twitter', array(
        'type' => 'text',
        'label' => esc_html__('Twitter', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_social_twitter'
      ));

      $wp_customize->add_setting('codepress_corporate_social_google_plus', array(
          'default' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
          ));

      $wp_customize->add_control('codepress_corporate_social_google_plus', array(
        'type' => 'text',
        'label' => esc_html__('Google-Plus', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_social_google_plus'
      ));

       $wp_customize->add_setting('codepress_corporate_social_instagram', array(
          'default' => 'http://instagram.com/',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
          ));
      $wp_customize->add_control('codepress_corporate_social_instagram', array(
        'type' => 'text',
        'label' => esc_html__('Instagram', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_social_instagram'
      ));

       $wp_customize->add_setting('codepress_corporate_social_youtube', array(
          'default' => 'http://youtube.com/',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
          ));
      $wp_customize->add_control('codepress_corporate_social_youtube', array(
        'type' => 'text',
        'label' => esc_html__('YouTube', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_social_youtube'
      ));


      $wp_customize->add_setting('codepress_corporate_social_pinterest', array(
          'default' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
          ));
      $wp_customize->add_control('codepress_corporate_social_pinterest', array(
        'type' => 'text',
        'label' => esc_html__('Pinterest', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_social_pinterest'
      ));

      $wp_customize->add_setting('codepress_corporate_social_rss_feed', array(
          'default' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_url_raw'
          ));
      $wp_customize->add_control('codepress_corporate_social_rss_feed', array(
        'type' => 'text',
        'label' => esc_html__('RSS Feed', 'codepress-corporate'),
        'section' => 'codepress_corporate_info_section',
        'settings' => 'codepress_corporate_social_rss_feed'
      ));

 

 /*********************************************************************************************************************/
 //Copyright section setting
/**********************************************************************************************************************/


      $wp_customize->add_section( 'codepress_corporate_copyright_section' , array(
          'title' => esc_html__( 'Copyright option', 'codepress-corporate' ),
          'panel' => 'theme_option_panel',
          'priority' => 20,
        ));

      $wp_customize->add_setting('codepress_corporate_copyright_setting', array(
          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field'
          ));
      $wp_customize->add_control('codepress_corporate_copyright_setting', array(
        'type' => 'text',
        'label' => esc_html__('Copyright', 'codepress-corporate'),
        'description' => esc_html__( 'Enter Copyright info ', 'codepress-corporate'),
        'section' => 'codepress_corporate_copyright_section',
        'settings' => 'codepress_corporate_copyright_setting'
      ));

      
 /*********************************************************************************************************************/
 //Layout Option
/**********************************************************************************************************************/

//search page
  $wp_customize->add_section('codepress_corporate_default_layout_setting', array(
    'priority' => 3,
    'title' => esc_html__('Layout Option', 'codepress-corporate'),
    'panel'=> 'theme_option_panel'
  ));


      $wp_customize -> add_setting( 'codepress_corporate_archive_banner_image',
         array( 
            'priority' => 5,
            //'default-image' => get_template_directory_uri() . '/images/b3.jpg',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
         ) );
      $wp_customize -> add_control( new WP_Customize_Image_Control( $wp_customize, 'codepress_corporate_archive_banner_image' ,
         array(
           'type' => 'image',
           'label' => esc_html__( 'Default Banner Image' , 'codepress-corporate'),
           'description' => esc_html__('Upload image for default banner', 'codepress-corporate'),
           'section' => 'codepress_corporate_default_layout_setting',
           'setting' => 'codepress_corporate_archive_banner_image'
          )));


   $wp_customize->add_setting('codepress_corporate_layout_info', array(
          'default' => 0,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_attr'
          ));

      $wp_customize->add_control( new Codepress_corporate_Info( $wp_customize, 'codepress_corporate_layout_info', array(
        'label' => esc_html__('Search Layout', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_layout_info',      
      )));

  $wp_customize->add_setting('codepress_corporate_search_page_layout', array(
    'default'           => 'left_content',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'codepress_corporate_page_post_layout_sanitize'
  ));

  $wp_customize->add_control( 'codepress_corporate_search_page_layout', array(
    'type'      => 'radio',
    'label'     => esc_html__('Layout for Search Page', 'codepress-corporate'),
    'section'   => 'codepress_corporate_default_layout_setting',
    'settings'  => 'codepress_corporate_search_page_layout',
    'choices'   => array(
      'left_content'        => esc_html__('Right Sidebar','codepress-corporate'),
      'right_content'       => esc_html__('Left Sidebar','codepress-corporate'),
      'content_full_area'   => esc_html__('No Sidebar Full width','codepress-corporate'),
      'content_middle_area' => esc_html__('Both Sidebar Centered content','codepress-corporate')
    )
  ));

//Archive Page Layout

      $wp_customize->add_setting('codepress_corporate_archive_layout_info', array(
          'default' => 0,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_attr'
          ));

      $wp_customize->add_control( new Codepress_corporate_Info( $wp_customize, 'codepress_corporate_archive_layout_info', array(
        'label' => esc_html__('Archive Layout', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_archive_layout_info',      
      )));



      $wp_customize->add_setting('codepress_corporate_archive_page_layout', array(
      'default'           => 'left_content',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'codepress_corporate_page_post_layout_sanitize'
      ));

      $wp_customize->add_control( 'codepress_corporate_archive_page_layout', array(
        'type'              => 'radio',
        'label'             => esc_html__('Layout for Archive Page', 'codepress-corporate'),
        'section'           => 'codepress_corporate_default_layout_setting',
        'settings'          => 'codepress_corporate_archive_page_layout',
        'choices'           => array(
                'left_content'        => esc_html('Right Sidebar','codepress-corporate'),
                'right_content'       => esc_html__('Left Sidebar','codepress-corporate'),
                'content_full_area'   => esc_html__('No Sidebar Full width','codepress-corporate'),
                'content_middle_area' => esc_html__('Both Sidebar Centered content','codepress-corporate')
        )
      ));

/***********************************************************************************************************/
     $wp_customize->add_setting('codepress_corporate_woocommerce_layout_info', array(
          'default' => 0,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_attr'
          ));

      $wp_customize->add_control( new Codepress_corporate_Info( $wp_customize, 'codepress_corporate_woocommerce_layout_info', array(
        'label' => esc_html__('WooCommerce Layout', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_woocommerce_layout_info',      
      )));


    $wp_customize->add_setting('codepress_corporate_woocommerce_layout', array(
      'default'           => 'left_content',
      'capability'        => 'edit_theme_options',
      'sanitize_callback' => 'codepress_corporate_page_post_layout_sanitize'
      ));

      $wp_customize->add_control( 'codepress_corporate_woocommerce_layout', array(
        'type'              => 'radio',
        'label'             => esc_html__('Layout For WooCommerce Layout', 'codepress-corporate'),
        'section'           => 'codepress_corporate_default_layout_setting',
        'settings'          => 'codepress_corporate_woocommerce_layout',
        'choices'           => array(
                'left_content'        => esc_html__('Right Sidebar','codepress-corporate'),
                'right_content'       => esc_html__('Left Sidebar','codepress-corporate'),
                'content_full_area'   => esc_html__('No Sidebar Full width','codepress-corporate'),
                'content_middle_area' => esc_html__('Both Sidebar Centered content','codepress-corporate')
        )
      ));

/*********************************************************************************************************************/
//singel Page option setting 
/*********************************************************************************************************************/

      $wp_customize->add_setting('codepress_corporate_page_layout_info', array(
          'default' => 0,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_attr'
          ));

      $wp_customize->add_control( new Codepress_corporate_Info( $wp_customize, 'codepress_corporate_page_layout_info', array(
        'label' => esc_html__('Page Layout', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_page_layout_info',      
      )));


      $wp_customize -> add_setting( 'codepress_corporate_page_banner_image', 
         array( 
            'priority' => 5,
            'default-image' => get_template_directory_uri() . '/images/b3.jpg',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
         ) );
      $wp_customize -> add_control( new WP_Customize_Image_Control( $wp_customize, 'codepress_corporate_page_banner_image' ,
         array(
           'type' => 'image',
           'label' => esc_html__( 'Page banner image' , 'codepress-corporate'),
           'description' => esc_html__('Upload image for page Banner', 'codepress-corporate'),
           'section' => 'codepress_corporate_default_layout_setting',
           'setting' => 'codepress_corporate_page_banner_image'
          )));

      $wp_customize->add_setting('codepress_corporate_activate_featutred_image', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_activate_featutred_image', array(
        'type' => 'checkbox',
        'label' => esc_html__('Display featured image', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_activate_featutred_image',      
      ));

       $wp_customize->add_setting('codepress_corporate_activate_page_comment', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_activate_page_comment', array(
        'type' => 'checkbox',
        'label' => esc_html__('Activate page comment', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_activate_page_comment',      
      )); 
    
  /***********************************************************************************************************/
  //Post option setting
  /***********************************************************************************************************/

      $wp_customize->add_section( 'codepress_corporate_post_option' , array(
          'title' => esc_html__( 'Post option', 'codepress-corporate' ),
          'panel' => 'theme_option_panel',
          'priority' => 10,
        ));

      $wp_customize->add_setting('codepress_corporate_post_layout_info', array(
          'default' => 0,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'esc_attr'
          ));

      $wp_customize->add_control( new Codepress_corporate_Info( $wp_customize, 'codepress_corporate_post_layout_info', array(
        'label' => esc_html__('Post Layout', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_post_layout_info',      
      )));
   
      $wp_customize -> add_setting( 'codepress_corporate_post_banner_image', 
         array(
            'priority' => 5,
            'default' => '',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw'
         ));

      $wp_customize -> add_control( new WP_Customize_Image_Control( $wp_customize, 'codepress_corporate_post_banner_image' ,
         array(
           'type' => 'image',
           'label' => esc_html__( 'Post Banner Image' , 'codepress-corporate'),
           'description' => esc_html__('Upload image for post banner', 'codepress-corporate'),
           'section' => 'codepress_corporate_default_layout_setting',
           'setting' => 'codepress_corporate_post_banner_image'
          )));

      $wp_customize->add_setting('codepress_corporate_activate_post_featutred_image', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_activate_post_featutred_image', array(
        'type' => 'checkbox',
        'label' => esc_html__('Display Featured Image', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_activate_post_featutred_image', 
      ));

      $wp_customize->add_setting('codepress_corporate_activate_post_comment', array(
          'default' => 1,
          'priority' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));
      $wp_customize->add_control('codepress_corporate_activate_post_comment', array(
        'type' => 'checkbox',
        'label' => esc_html__('Activate post comment', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_activate_post_comment',      
      )); 


      $wp_customize->add_setting('codepress_corporate_single_post_layout', array(
        'default' => 'left_content',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'codepress_corporate_page_post_layout_sanitize'
      ));

      $wp_customize->add_control( 'codepress_corporate_single_post_layout', array(
        'type' => 'radio',
        'label' => esc_html__('Layout for Single Post', 'codepress-corporate'),
        'section' => 'codepress_corporate_default_layout_setting',
        'settings' => 'codepress_corporate_single_post_layout',
        'choices' => array(
          'left_content' => esc_html__('Right Sidebar','codepress-corporate'),
          'right_content' => esc_html__('Left Sidebar','codepress-corporate'),
          'content_full_area' => esc_html__('No Sidebar Full width','codepress-corporate'),
          'content_middle_area' => esc_html__('Both Sidebar Centered content','codepress-corporate')
        )
      ));

      $wp_customize->add_panel( 'contact_setting_panel',
      array(
         'title' => esc_html__( 'Contact settings' , 'codepress-corporate'),
         'description' => esc_html__( 'Change contact settings from here', 'codepress-corporate' ),
         'priority' => 50,
         'capability' => 'edit_theme_options'
         ));
  //Contact form section

      $wp_customize->add_section( 'codepress_corporate_contact_form_section' , array(
          'title' => esc_html__( 'Contact Form', 'codepress-corporate' ),
          'panel' => 'contact_setting_panel',
          'priority' => 20,
        ));

  //Active contact Area

      $wp_customize->add_setting('codepress_corporate_contact_setting_activate_home', array(
          'default' => 1,
          'priority' => 20,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_contact_setting_activate_home', array(
        'type' => 'checkbox',
        'label' => esc_html__('Activate in template home', 'codepress-corporate'),
        'section' => 'codepress_corporate_contact_form_section',
        'settings' => 'codepress_corporate_contact_setting_activate_home',      
      ));


    //title
      $wp_customize->add_setting('codepress_corporate_contact_title', array(  
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field'
          ));
      $wp_customize->add_control('codepress_corporate_contact_title', array(
        'type' => 'text',
        'label' => esc_html__('Title', 'codepress-corporate'),
        'description' => esc_html__( 'Enter Title for Contact area', 'codepress-corporate' ),
        'section' => 'codepress_corporate_contact_form_section',
        'settings' => 'codepress_corporate_contact_title'
      ));

//shortcode area
    
    //shortcode contact page       
      $wp_customize->add_setting('codepress_corporate_contact_form_shortcode', array(          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field'
          ));
      $wp_customize->add_control('codepress_corporate_contact_form_shortcode', array(
        'type' => 'text',
        'label' => esc_html__('Conatct page Shortcode', 'codepress-corporate'),
        'description' => esc_html__( 'Enter Shortcode for contact page template ', 'codepress-corporate' ),
        'section' => 'codepress_corporate_contact_form_section',
        'settings' => 'codepress_corporate_contact_form_shortcode'
      ));
      
     //shortcode template home page  
      $wp_customize->add_setting('codepress_corporate_teplate_home_shortcode', array(          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field'
          ));
      $wp_customize->add_control('codepress_corporate_teplate_home_shortcode', array(
        'type' => 'text',
        'label' => esc_html__('Template Home Shortcode', 'codepress-corporate'),
        'description' => esc_html__( 'Enter Shortcode for Template Home ', 'codepress-corporate' ),
        'section' => 'codepress_corporate_contact_form_section',
        'settings' => 'codepress_corporate_teplate_home_shortcode'
      ));


    // googel map area 

      $wp_customize->add_section( 'codepress_corporate_google_map' , array(
          'title' => esc_html__( 'Google Map', 'codepress-corporate' ),
          'panel' => 'contact_setting_panel',
          'priority' => 30,
        ));

       $wp_customize->add_setting('codepress_corporate_google_map_activate_home', array(
          'default' => 1,
          'priority' => 10,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_checkbox_sanitize'
          ));

      $wp_customize->add_control('codepress_corporate_google_map_activate_home', array(
        'type' => 'checkbox',
        'label' => esc_html__('Activate in template home', 'codepress-corporate'),
        'section' => 'codepress_corporate_google_map',
        'settings' => 'codepress_corporate_google_map_activate_home',      
        ));

       $wp_customize->add_setting('codepress_corporate_google_map_frame', array(          
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'codepress_corporate_sanitize_google_map'
          ));
      $wp_customize->add_control('codepress_corporate_google_map_frame', array(
        'type' => 'textarea',
        'label' => esc_html__('Google Map iFrame ', 'codepress-corporate'),
        'description' => esc_html__( 'Enter Map iframe', 'codepress-corporate' ),
        'section' => 'codepress_corporate_google_map',
        'settings' => 'codepress_corporate_google_map_frame'
      ));


   // sanitization works

    require get_template_directory() . '/inc/customizer-helper.php';

}

add_action('customize_register', 'codepress_corporate_customize_register');