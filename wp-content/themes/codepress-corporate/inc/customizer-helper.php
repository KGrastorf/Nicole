<?php 


   // checkbox sanitization
   function codepress_corporate_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }

 /** Sanitize textarea */ 
  function codepress_corporate_sanitize_textarea( $input ) {

  $codepress_corporate_allowedposttags = array(
    'a' => array(
        'href' => array(),
        'title' => array()
     ),

    'span' => array(
        'class' => array(),
        'id'    => array(),
        'style' => array(),
      ),

    'br' => array(),
    'em' => array(),
    'strong' => array(),
);
  
  $output = wp_kses_post( $input, $codepress_corporate_allowedposttags);
  return $output;
  }
  //add_filter( 'of_sanitize_textarea', 'codepress_corporate_sanitize_textarea' );


/** Sanitization google map */
  function codepress_corporate_sanitize_google_map( $input ) {

     $codepress_corporate_allowedposttags['iframe']=array(

      'align' => true,
      'width' => true,
      'height' => true,
      'frameborder' => true,
      'name' => true,
      'src' => true,
      'id' => true,
      'class' => true,
      'style' => true,
      'scrolling' => true,
      'marginwidth' => true,
      'marginheight' => true,

      );

  $output = wp_kses( $input, $codepress_corporate_allowedposttags);
  return $output;
  }
  //add_filter( 'of_sanitize_textarea', 'codepress_corporate_sanitize_textarea' );


  // Sanitize logo palcaement 

  function codepress_corporate_sanitize_logo_placement( $input ) {
    $valid = array(
        'left' => esc_html__('Left', 'codepress-corporate'),
        'right' => esc_html__('Right','codepress-corporate'),
        'center' => esc_html__('Center','codepress-corporate'),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/****************************************************************************************************************************/

//Single Post Layout

 function codepress_corporate_header_logo_sanitize( $input ) {
    $valid = array(
        'header_text_only' => esc_html__('Header Text Only', 'codepress-corporate'),
        'header_logo_only' => esc_html__('Header Logo Only', 'codepress-corporate'), 
        'show_both'        => esc_html__('Show Both','codepress-corporate'),
        'disable'          => esc_html__('Disable','codepress-corporate')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}




 function codepress_corporate_woo_layout_sanitize( $input ) {
    $valid = array(
        'left_content'        => esc_html__('Right Sidebar','codepress-corporate'),
        'right_content'       => esc_html__('Left Sidebar','codepress-corporate'),
        'content_full_area'   => esc_html__('No Sidebar Full width','codepress-corporate'),
        'content_middle_area' => esc_html__('Both Sidebar Centered content','codepress-corporate')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}



//Single Post Layout

 function codepress_corporate_page_post_layout_sanitize( $input ) {
    $valid = array(
        'left_content' => esc_html__('Right Sidebar','codepress-corporate'),
        'right_content' => esc_html__('Left Sidebar','codepress-corporate'),
        'content_full_area' => esc_html__('No Sidebar Full width','codepress-corporate'),
        'content_middle_area' => esc_html__('Both Sidebar Centered content','codepress-corporate')
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/**********************************************************************************************************************************/

   //Number Sanitization
    function codepress_corporate_sanitize_number( $int ) {
      return absint( $int );
    } 

    //Email sanitization
    function codepress_corporate_sanitize_email( $email ) {
      if(is_email( $email )){
        return $email;
      }else{
        return '';
      }
    }

    // radio button sanitization
   function codepress_corporate_related_posts_sanitize($input) {
      $valid_keys = array(
         'categories' => esc_html__('Related Posts By Categories', 'codepress-corporate'),
         'tags' => esc_html__('Related Posts By Tags', 'codepress-corporate')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }