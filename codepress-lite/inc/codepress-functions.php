<?php
add_action( 'admin_init', 'codepress_lite_admin_script' );

    function codepress_lite_admin_script() {
        /* Register our script. */
        
        
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
        wp_enqueue_style('codepress-lite-admin-css', get_template_directory_uri() . '/css/admin/admin.css');
        
        wp_enqueue_script( 'codepress-lite-admin-js', get_template_directory_uri() . '/js/admin/codepress-admin.js', array('jquery'), '20130115', true );
    }


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function codepress_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'codepress-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'codepress-lite' ),
		'id'            => 'left-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Home Page Widget', 'codepress-lite' ),
		'id'            => 'home-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'codepress-lite' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'codepress-lite' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'codepress-lite' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'codepress-lite' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Sidebar Right', 'codepress-lite' ),
		'id'            => 'woocommerce-sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Sidebar left', 'codepress-lite' ),
		'id'            => 'woocommerce-sidebar-left',
		'description'   => esc_html__( 'Add widgets here.', 'codepress-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s wow fadeInUp">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'codepress_lite_widgets_init' );
 

// codepress widgets init

require get_template_directory() . '/inc/cl-widgets.php';

// footer block count
function codepress_lite_footer_count(){
	$codepress_lite_count = 0;
	if(is_active_sidebar('footer-1'))
	$codepress_lite_count++;

	if(is_active_sidebar('footer-2'))
	$codepress_lite_count++;

	if(is_active_sidebar('footer-3'))
	$codepress_lite_count++;
    
    if(is_active_sidebar('footer-4'))
	$codepress_lite_count++;


	return $codepress_lite_count;
}

function codepress_lite_slider()
{
        $slider_category = get_theme_mod('codepress_lite_slider_category_setting');
        $slider_read_more = get_theme_mod('codepress_lite_slider_read_more_setting', __('Read More', 'codepress-lite'));
       
         ?> 
              <input type="hidden" class="cl-smooth-scrolling" value="true" />
                
            <?php if(!empty($slider_category) && $slider_category != 0){
                    
                    $slider_args = array('post_type' => 'post',
                                        'posts_per_page' => 3,
                                        'post_status' => 'publish',
                                        'cat' => absint($slider_category) );
                    $slider_query = new WP_Query($slider_args); 
                    $slider_count = $slider_query->post_count;
                    ?>   
                    
        <script type="text/javascript">
        	jQuery(document).ready(function() { 

        	 jQuery('.banner-slider').owlCarousel({
			    autoplay:false, 
			    animateOut:'fadeOut',
			    dots:false, 
			    loop: <?php echo $slider_count <= 1 ? 'false' : 'true'; ?>,
			    nav:false,
			    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			    responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:1
			        },
			        1000:{
			            items:1
			        }
			    }
			});

        });

        </script>
    
    	<div class="main-banner">
    		<div class="banner-slider">
                
                
                  <?php  
                    while($slider_query->have_posts()){
                        $slider_query->the_post();
                        ?>
                        <div class="banner-item">
            				<div class="parallax-overlay"></div>
            				<figure>
            					<?php the_post_thumbnail(); ?>
            				</figure>
            				<div class="slider-caption-wrapper clearfix">
            					<div class="container">
            						<h3 class="slider-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>
            						<div class="slider-desc">
                                        <?php codepress_lite_add_excerpt_length( apply_filters( 'codepress_lite_slider_excerpt_length', 13 ) );
                    					the_excerpt();
                    					codepress_lite_remove_excerpt_length();
                                            ?>
                                    </div>
            						
                                    <div class="slider-button">
            							 <a href="<?php the_permalink(); ?>"> <?php echo esc_html($slider_read_more); ?> </a> 
            						</div>  
                                    
            					</div>
            				</div>
            			</div>
                        <?php
                    }
                    
                
                ?>

    		</div>
    		
			<div class="dropdown"><a class="dropdown-icon" href="#main-content-section"><i class="fa fa-angle-down"></i></a></div>
		</div> 
    <?php
    } 
    wp_reset_postdata();
}

add_action('codepress_lite_main_slider','codepress_lite_slider');



if ( !function_exists('codepress_lite_category') ) :
   function codepress_lite_category($count = '') { 
      global $post;
      $categories = get_the_category();
      $separator = '&nbsp;';
      $output = '';
      if($categories) {
        $i = 1;
         foreach($categories as $category) {
            
               $output .= '<a href="'.esc_url(get_category_link( $category->term_id )).'"  rel="category tag">'.esc_html($category->cat_name).'</a>'.$separator;
                if($count == $i)
                break;
      }
         
         echo trim($output, $separator);
      }
   }
endif;



// codepress_lite Breadcrumbs

function codepress_lite_breadcrumbs($delimiter='') {
	  global $post;
      //$codepress_lite_breadcrumb_option_single = get_post_meta( $post->ID, 'codepress_lite_breadcrumbs_options', true ); 
      //$codepress_lite_breadcrumb_option_text_single = get_post_meta( $post->ID, 'codepress_lite_breadcrumbs_separator', true );
      $codepress_lite_et_to = get_theme_mod('codepress_lite_breadcrumbs_activate',1);
      //$codepress_lite_breadcrumb_option_single = 'enable-breadcrumbs';
      
      
      if($codepress_lite_et_to == 1):
        
	  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
         if(!empty($delimiter))
         {
            $delimiter = '<span class="breadcrumb_separator">'.balanceTags($delimiter).'</span>';
                 
    }     
	  elseif(isset($codepress_lite_et_to['breadcrumb_separator'])){
	  	$delimiter = '<span class="breadcrumb_separator">'.$codepress_lite_et_to['breadcrumb_separator'].'</span>';
	  }else{
	  $delimiter = '<span class="breadcrumb_separator"> / </span>'; // delimiter between crumbs
		} 

	  if(isset($codepress_lite_et_to['breadcrumb_home_text'])){
	  $home = $codepress_lite_et_to['breadcrumb_home_text'];
		}else{
		$home = __('Home', 'codepress-lite'); // text for the 'Home' link
		}

	  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	  $before = '<span class="current">'; // tag before the current crumb
	  $after = '</span>'; // tag after the current crumb
	  
	  $homeLink = esc_url( home_url() );
	  
	  if (is_home() || is_front_page()) {
	  
	    if ($showOnHome == 1) echo '<div id="codepress_lite--breadcrumbs"><div class="pm-container"><a href="' . esc_url($homeLink) . '" class="breadcrumb_home_text">' . esc_html($home) . '</a></div></div>';
	  
	  } else {
	  
	    echo '<div id="codepress_lite--breadcrumbs"><div class="pm-container"><a href="' . esc_url($homeLink) . '" class="breadcrumb_home_text">' . esc_html($home) . '</a> ' . balanceTags($delimiter) . ' ';
	  
	    if ( is_category() ) {
	      $thisCat = get_category(get_query_var('cat'), false);
	      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . balanceTags($delimiter) . ' ');
	      echo balanceTags($before) . single_cat_title('', false)  . balanceTags($after);
	  
	    } elseif ( is_search() ) {
	      echo balanceTags($before) . __('Search', 'codepress-lite') .'"' . get_search_query() . '"' . balanceTags($after);
	  
	    } elseif ( is_day() ) {
	      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . balanceTags($delimiter) . ' ';
	      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . balanceTags($delimiter) . ' ';
	      echo balanceTags($before) . get_the_time('d') . balanceTags($after);
	  
	    } elseif ( is_month() ) {
	      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . balanceTags($delimiter) . ' ';
	      echo balanceTags($before) . get_the_time('F') . balanceTags($after);
	  
	    } elseif ( is_year() ) {
	      echo balanceTags($before) . get_the_time('Y') . balanceTags($after);
	  
	    } elseif ( is_single() && !is_attachment() ) {
	      if ( get_post_type() != 'post' ) {
	        $post_type = get_post_type_object(get_post_type());
	        $slug = $post_type->rewrite;
	        echo '<a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
	        if ($showCurrent == 1) echo ' ' . balanceTags($delimiter) . ' ' . balanceTags($before) . get_the_title() . balanceTags($after);
	      } else {
	        $cat = get_the_category(); $cat = $cat[0];
	        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
	        echo $cats;
	        if ($showCurrent == 1) echo balanceTags($before) . get_the_title() . balanceTags($after);
	      }
	  
	    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	      $post_type = get_post_type_object(get_post_type());
	      echo balanceTags($before) . $post_type->labels->singular_name . balanceTags($after);
	  
	    } elseif ( is_attachment() ) {
	      $parent = get_post($post->post_parent);
	      $cat = get_the_category($parent->ID); $cat = $cat[0];
	      echo get_category_parents($cat, TRUE, ' ' . balanceTags($delimiter) . ' ');
	      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
	      if ($showCurrent == 1) echo ' ' . balanceTags($delimiter) . ' ' . balanceTags($before) . get_the_title() . balanceTags($after);
	  
	    } elseif ( is_page() && !$post->post_parent ) {
	      if ($showCurrent == 1) echo balanceTags($before) . get_the_title() . balanceTags($after);
	  
	    } elseif ( is_page() && $post->post_parent ) {
	      $parent_id  = $post->post_parent;
	      $breadcrumbs = array();
	      while ($parent_id) {
	        $page = get_page($parent_id);
	        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	        $parent_id  = $page->post_parent;
	      }
	      $breadcrumbs = array_reverse($breadcrumbs);
	      for ($i = 0; $i < count($breadcrumbs); $i++) {
	        echo $breadcrumbs[$i];
	        if ($i != count($breadcrumbs)-1) echo ' ' . balanceTags($delimiter) . ' ';
	      }
	      if ($showCurrent == 1) echo ' ' . balanceTags($delimiter) . ' ' . balanceTags($before) . get_the_title() . balanceTags($after);
	  
	    } elseif ( is_tag() ) {
	      echo balanceTags($before) . single_tag_title('', false)  . balanceTags($after);
	  
	    } elseif ( is_author() ) {
	       global $author;
	      $userdata = get_userdata($author);
	      echo balanceTags($before) . $userdata->display_name . balanceTags($after);
	  
	    } elseif ( is_404() ) {
	      echo balanceTags($before) . __('Error 404', 'codepress-lite') . balanceTags($after);
	    }
	  
	    if ( get_query_var('paged') ) {
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
	      echo esc_html__('Page' , 'codepress-lite') . ' ' . get_query_var('paged');
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
	    }
	  
	    echo balanceTags('</div></div>');
	  
	  }
      endif;
	}
    
    
    // body class for page post archives
    function codepress_lite_page_post_layout($codepress_lite_classes){
    //$codepress_lite_et_to = codepress_lite_get_options_values();
    global $post;
    //echo $post -> ID;
    //print_r($post);
    $codepress_lite_post_class = get_post_meta(get_the_ID(),'codepress_lite_sidebar_layout', true );
    $codepress_lite_default_sidebar_layout = get_theme_mod('codepress_lite_default_sidebar_setting', 'right-sidebar');
    
        if(is_home() && is_page_template('template-parts/t-home.php') && is_front_page())
        {
            $codepress_lite_classes[]= '';
            
        }
        elseif(is_home())
        {
            $codepress_lite_classes[] = $codepress_lite_default_sidebar_layout;
        }
        
        elseif( class_exists( 'WooCommerce' ) && is_product()){
            if(empty($codepress_lite_default_sidebar_layout)){
                $codepress_lite_classes[] = 'right-sidebar';
            }
            
            else{
                $codepress_lite_classes[]= $codepress_lite_default_sidebar_layout;
            }
        }
        elseif(is_singular()){
            
    	    $codepress_lite_post_class = get_post_meta( $post -> ID, 'codepress_lite_sidebar_layout', true );
            //echo $codepress_lite_post_class;// die();
            //var_dump($codepress_lite_post_class); //die();
    	    if(empty($codepress_lite_post_class)){
            $codepress_lite_post_class = 'right-sidebar';
            $codepress_lite_classes[] = $codepress_lite_post_class;
            }
            else{
            $codepress_lite_post_class = get_post_meta( $post -> ID, 'codepress_lite_sidebar_layout', true );
            $codepress_lite_classes[] = $codepress_lite_post_class;
            }
		}
        
        elseif(is_archive()){
            if(empty($codepress_lite_default_sidebar_layout)){
                $codepress_lite_classes[] = 'right-sidebar';
            }
            
            else{
                $codepress_lite_classes[]= $codepress_lite_default_sidebar_layout;
            }
        }
        
        elseif(is_search()){
            if(empty($codepress_lite_default_sidebar_layout)){
                $codepress_lite_classes[] = 'right-sidebar';
            }
            
            else{
                $codepress_lite_classes[]= $codepress_lite_default_sidebar_layout;
            }
        }
        elseif(is_404()){
            if(empty($codepress_lite_default_sidebar_layout)){
                $codepress_lite_classes[] = 'right-sidebar';
            }
            
            else{
                $codepress_lite_classes[]= $codepress_lite_default_sidebar_layout;
            }
        }
        
        elseif(class_exists('WooCommerce') && is_woocommerce()){
            if(empty($codepress_lite_default_sidebar_layout)){
                $codepress_lite_classes[] = 'right-sidebar';
            }
            
            else{
                $codepress_lite_classes[]= $codepress_lite_default_sidebar_layout;
            }
        }
        
        
        
        else{
            
		  $codepress_lite_classes[] = 'right-sidebar';	
		
        }
        //$codepress_lite_classes[] = 'no-sidebar';
    
//    
//    elseif($codepress_lite_et_to['page_layout'] == 'fullwidth'){
//        $codepress_lite_classes[]='fullwidth';
//    }   
    //print_r($codepress_lite_classes_body);
    return $codepress_lite_classes;
}
add_filter( 'body_class', 'codepress_lite_page_post_layout' );


// body class for site layout
    function codepress_lite_site_layout($codepress_lite_classes){
    //$codepress_lite_et_to = codepress_lite_get_options_values();
    
    $codepress_lite_site_layout = get_theme_mod('codepress_lite_site_layout', 'fluid');
    
        
        
        if($codepress_lite_site_layout == 'fluid'){
            
		  $codepress_lite_classes[] = 'fluid';	
		
        }
        elseif($codepress_lite_site_layout == '')
        {
            $codepress_lite_classes[] = 'fluid';
        }
        else{
            $codepress_lite_classes[] = 'boxed';
        }
        
    return $codepress_lite_classes;
}
add_filter( 'body_class', 'codepress_lite_site_layout' );


function codepress_lite_left_sidebar_layout()
{
    global $post;    
    $page_sidebar_layout = get_post_meta($post -> ID ,'codepress_lite_sidebar_layout', true); 
    if($page_sidebar_layout == 'left-sidebar'):
    ?>
    <aside id="secondary" class="widget-area" role="complementary">
	   <?php dynamic_sidebar('left-sidebar'); ?> 
    </aside><!-- #secondary -->
    <?php 
    endif;
}

function codepress_lite_right_sidebar_layout()
{
    global $post;
    //print_r($post);    
    $page_sidebar_layout = get_post_meta($post -> ID ,'codepress_lite_sidebar_layout', true); 
    if($page_sidebar_layout == 'right-sidebar'):
        get_sidebar();
    endif;
}

function codepress_lite_footer()
{
    if ( is_active_sidebar( 'footer-1' ) ||  is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
    <div class="cl_footer_wrapper footer-column-<?php echo codepress_lite_footer_count(); ?>">
    <div class="container">
        
        <?php if(is_active_sidebar('footer-1')): ?>
        
            <div class="cl_footer_1 pm_footer">
                <?php dynamic_sidebar('footer-1'); ?>    
            </div>
            
        <?php 
        endif;
        
        if(is_active_sidebar('footer-2')):
        ?>
            
            <div class="cl_footer_2 pm_footer">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
            
        <?php 
        endif;
        
        if(is_active_sidebar('footer-3')):
        ?>
            
            <div class="cl_footer_3 pm_footer">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>
        <?php 
        endif;
        
        
        if(is_active_sidebar('footer-4')):
        ?>
            
            <div class="cl_footer_4 pm_footer">
                <?php dynamic_sidebar('footer-4'); ?>
            </div>
        <?php 
        endif;
        ?>
        </div>
    </div>
    
    <?php 
    endif;
    
}
function codepress_lite_custom_customize_enqueue() {
    
    wp_enqueue_script( 'codepress-lite-admin-js', CODEPRESS_LITE_JS_URL . '/admin/codepress-admin.js', array(), false , true );
	
}
add_action( 'customize_controls_enqueue_scripts', 'codepress_lite_custom_customize_enqueue' );
 
 


    






function codepress_lite_excerpt_length( $length = '' ) {

    if ( isset( $GLOBALS['codepress_lite_excerpt_length'] ) && $GLOBALS['codepress_lite_excerpt_length'] > 0 ) {
        return $GLOBALS['codepress_lite_excerpt_length'];
    } else {
        return 50;
    }
}
add_filter( 'excerpt_length', 'codepress_lite_excerpt_length', 99 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function codepress_lite_excerpt_more( $more = '' ) {
    return '...';
}
add_filter( 'excerpt_more', 'codepress_lite_excerpt_more' );

/**
 * Add custom excerpt length
 * @param $length
 */
function codepress_lite_add_excerpt_length( $length ){
    $length = absint( $length );
    $GLOBALS['codepress_lite_excerpt_length'] = $length;
}

/**
 * REMOVE custom excerpt length
 */
function codepress_lite_remove_excerpt_length (){
    if ( isset( $GLOBALS['codepress_lite_excerpt_length'] ) ) {
        unset( $GLOBALS['codepress_lite_excerpt_length'] );
    }
}
