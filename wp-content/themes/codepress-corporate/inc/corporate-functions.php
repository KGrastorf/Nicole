<?php 

//BreadCrumbs fucntions defination




/*************************************************************************************************************************/
/*Sidebar layout function start */
/*************************************************************************************************************************/

//main content area                          

/****************************************************************************************/

//add_filter( 'body_class', 'codepress_corporate_sidebar_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function codepress_corporate_sidebar_layout_class() {
  
  global $post;

  if( $post ) { $layout_meta = get_post_meta( $post->ID, 'codepress_corporate_page_layout', true ); }
 

  if( is_home() ) {
    $queried_id = get_option( 'page_for_posts' );
    $layout_meta = get_post_meta( $queried_id, 'codepress_corporate_page_layout', true );
    $classes = 'left-content';
    
  }
  else{
    $layout_meta = 'left_content';
  }


  if( empty( $layout_meta ) || is_archive() || is_search() || is_single() || is_page() ) { $layout_meta = 'default_layout'; }

  if(  $layout_meta == 'default_layout' ) {
    if( is_page() ) {
      $page_layout = get_post_meta($post->ID, 'codepress_corporate_page_layout', true);
      
//var_dump($page_layout);
      if( $page_layout == 'left-content' ) { $classes = 'left-content'; }
      elseif( $page_layout == 'right-content' ) { $classes = 'right-content'; }
      elseif( $page_layout == 'content-full-area' ) { $classes = 'content-full-area'; }
      elseif( $page_layout == 'content-middle-area' ) { $classes = 'content-middle-area'; }
      elseif( $page_layout == '' ){
        $classes = 'left-content';
      }
      else
      {
        $classes = 'left-content';
      }
    }

    elseif( class_exists( 'WooCommerce' )  && ( is_product() || is_shop() || is_product_tag() || is_product_category() || is_product_taxonomy() ) ) { 
    $codepress_corporate_woo_layout = get_theme_mod( 'codepress_corporate_woocommerce_layout', 'right_content' );
    
    if( $codepress_corporate_woo_layout == 'left_content' ) { $classes = 'left-content'; }
    elseif( $codepress_corporate_woo_layout == 'right_content' ) { $classes = 'right-content'; }
    elseif( $codepress_corporate_woo_layout == 'content_full_area' ) { $classes = 'content-full-area'; }
    elseif( $codepress_corporate_woo_layout == 'content_middle_area' ) { $classes = 'content-middle-area'; }
    else
    {
        $classes = 'left-content';
    }

    }

    elseif( is_archive() ) {
      $codepress_corporate_archive_page_layout = get_theme_mod( 'codepress_corporate_archive_page_layout', 'right_content');

      if( $codepress_corporate_archive_page_layout == 'left_content' ) { $classes = 'left-content'; }
      elseif( $codepress_corporate_archive_page_layout == 'right_content' ) { $classes = 'right-content'; }
      elseif( $codepress_corporate_archive_page_layout == 'content_full_area' ) { $classes = 'content-full-area'; }
      elseif( $codepress_corporate_archive_page_layout == 'content_middle_area' ) { $classes = 'content-middle-area'; }
      else{  $classes = 'left-content'; }
    }
    elseif( is_single() ) {
     $codepress_corporate_single_post_layout = get_theme_mod( 'codepress_corporate_single_post_layout', 'right_content' );

      if( $codepress_corporate_single_post_layout == 'left_content' ) { $classes = 'left-content'; }
      elseif( $codepress_corporate_single_post_layout == 'right_content' ) { $classes = 'right-content'; }
      elseif( $codepress_corporate_single_post_layout == 'content_full_area' ) { $classes = 'content-full-area'; }
      elseif( $codepress_corporate_single_post_layout == 'content_middle_area' ) { $classes = 'content-middle-area'; }
      else{ $classes = 'left-content'; }
    }

    elseif( is_search() ) { 
    $codepress_corporate_search_page_layout = get_theme_mod( 'codepress_corporate_search_page_layout', 'right_content' );

    if( $codepress_corporate_search_page_layout == 'left_content' ) { $classes = 'left-content'; }
    elseif( $codepress_corporate_search_page_layout == 'right_content' ) { $classes = 'right-content'; }
    elseif( $codepress_corporate_search_page_layout == 'content_full_area' ) { $classes = 'content-full-area'; }
    elseif( $codepress_corporate_search_page_layout == 'content_middle_area' ) { $classes = 'content-middle-area'; }
    else{ $classes = 'left-content'; }

    }
    
  }

  elseif( $layout_meta == 'left-content' ) { $classes = 'left-content'; }
  elseif( $layout_meta == 'right-content' ) { $classes = 'right-content'; }
  elseif( $layout_meta == 'content-full-area' ) { $classes = 'content-full-area'; }
  elseif( $layout_meta == 'content-middle-area' ) { $classes = 'content-middle-area'; }
  else
  {
    $classes = '';
  }


  return $classes;
  
}

/****************************************************************************************/

if ( ! function_exists( 'codepress_corporate_sidebar_select' ) ) :
/**
 * Function to select the sidebar
 */
function codepress_corporate_sidebar_select() {
  global $post;

  if( $codepress_corporate_post ) { $layout_meta = get_post_meta( $post->ID, 'codepress_corporate_page_layout', true ); }

  if( is_home() ) {
    $queried_id = get_option( 'page_for_posts' );
    $layout_meta = get_post_meta( $queried_id, 'codepress_corporate_page_layout', true );
  }


  elseif( $layout_meta == 'right_sidebar' ) { get_sidebar(); }
  elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }
}
endif;

/****************************************************************************************/
/****************************************************************************************/


/****************************************************************************************/
//layout sidebar function
/****************************************************************************************/

function codepress_corporate_sidebar_class( $layout_class ) {

  if( $layout_class == 'right-content' ) {
            $sidebar = 'left-sb';
        } 
        elseif( $layout_class == 'content-full-area' ) {
            $sidebar = 'full-con';
          }
          elseif(is_search()){
              
              $sidebar = 'search-sb';
            
          }
        else{
            $sidebar = '';
          }

         return  $sidebar;
}