<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Bizgrowth
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
<div class="header <?php if( !is_front_page() && !is_home() ){ ?>headerinner<?php } ?>">
        <div class="container">
            <div class="logo">
            			<?php bizgrowth_the_custom_logo(); ?>
                        <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                        <span><?php bloginfo('description'); ?></span>
            </div><!-- logo -->
             <div class="toggle">
                <a class="toggleMenu" href="<?php echo esc_url('#');?>"><?php esc_attr_e('Menu','bizgrowth'); ?></a>
             </div><!-- toggle --> 
            <div class="sitenav">
                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
            </div><!-- site-nav -->
            <div class="clear"></div>
        </div><!-- container -->
  </div><!--.header -->

<?php if ( is_front_page() && ! is_home() ) { ?>
<!-- Slider Section -->
<?php for($sld=7; $sld<10; $sld++) { ?>
<?php if( get_theme_mod('page-setting'.$sld)) { ?>
<?php $slidequery = new WP_query('page_id='.get_theme_mod('page-setting'.$sld,true)); ?>
<?php while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
$img_arr[] = $image;
$id_arr[] = $post->ID;
endwhile;
}
}
?>
<?php if(!empty($id_arr)){ ?>
<section id="home_slider">
<div class="slider-wrapper theme-default">
<div id="slider" class="nivoSlider">
	<?php 
	$i=1;
	foreach($img_arr as $url){ ?>
    <img src="<?php echo esc_url($url); ?>" title="#slidecaption<?php echo $i; ?>" />
    <?php $i++; }  ?>
</div>   
<?php 
$i=1;
foreach($id_arr as $id){ 
$title = get_the_title( $id ); 
$post = get_post($id); 
$content = apply_filters('the_content', substr(strip_tags($post->post_content), 0, 100)); 
?>                 
<div id="slidecaption<?php echo $i; ?>" class="nivo-html-caption">
<div class="slide_info">
<h2><?php echo $title; ?></h2>
<p><?php echo $content; ?></p>
<a class="slide_more" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_attr_e('Read More', 'bizgrowth');?></a>
</div>
</div>      
<?php $i++; } ?>       
 </div>
<div class="clear"></div>        
</section>
<?php } else { ?>
<section id="home_slider">
<div class="slider-wrapper theme-default">
<div id="slider" class="nivoSlider">
    <img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider1.jpg" alt="" title="#slidecaption1" />
    <img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider2.jpg" alt="" title="#slidecaption2" />
    <img src="<?php echo get_template_directory_uri(); ?>/images/slides/slider3.jpg" alt="" title="#slidecaption3" />
</div>                    
                  <div id="slidecaption1" class="nivo-html-caption">
                    <div class="slide_info">
                            <h2><?php esc_attr_e('Multipurpose WordPress themes','bizgrowth'); ?></h2>
                            <p><?php esc_attr_e('Bizgrowth is a free Multipurpose WordPress themes its use for business, corporate, industrial and commercial websites.','bizgrowth'); ?></p>
                           <a class="slide_more" href="<?php echo esc_url('#');?>"><?php esc_attr_e('Read More', 'bizgrowth');?></a>
                           
                    </div>
                    </div>
                    
                    <div id="slidecaption2" class="nivo-html-caption">
                        <div class="slide_info">
                                <h2><?php esc_attr_e('Pixel Perfect WordPress themes','bizgrowth'); ?></h2>
                                <p><?php esc_attr_e('Bizgrowth theme is pixel perfect accuracy and clean coded as well as cross browser compatibility.','bizgrowth'); ?></p> 
                                <a class="slide_more" href="<?php echo esc_url('#');?>"><?php esc_attr_e('Read More', 'bizgrowth');?></a>                      
                        </div>
                    </div>
                    
                    <div id="slidecaption3" class="nivo-html-caption">
                        <div class="slide_info">
                                <h2><?php esc_attr_e('User Friendly Theme Customization','bizgrowth'); ?></h2>
                                <p><?php esc_attr_e('Bizgrowth theme is easy to customize WordPress theme. it is User friendly customizer options. anyone customize theme without knowledge of html','bizgrowth'); ?></p>
                                <a class="slide_more" href="<?php echo esc_url('#');?>"><?php esc_attr_e('Read More', 'bizgrowth');?></a>
                        </div>
                    </div>
</div>
<div class="clear"></div>
</section><!-- Slider Section -->
<?php } } ?>

<?php if ( is_front_page() && ! is_home() ) { ?>    
  
  		<?php if ( get_theme_mod( 'page-column1') != "" || get_theme_mod( 'page-column2') != "" || get_theme_mod( 'page-column3') != "" || get_theme_mod( 'page-column4') != ""){ ?>
		 <section id="wrapsecond">
            	<div class="container">
                    <div class="services-wrap">                       
                        <?php for($p=1; $p<5; $p++) { ?>       
                        <?php if( get_theme_mod('page-column'.$p,false)) { ?>          
                            <?php $queryxxx = new WP_query('page_id='.get_theme_mod('page-column'.$p,true)); ?>				
                                    <?php while( $queryxxx->have_posts() ) : $queryxxx->the_post(); ?> 
                                    <div class="fourbox <?php if($p % 4 == 0) { echo "last_column"; } ?>">                      
                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                      <?php if(has_post_thumbnail() ) { ?>
                                        <div class="thumbbx"><?php the_post_thumbnail( array(85,85, true) );?></div>
                                      <?php } ?>
                                      <h3><?php the_title(); ?></h3>
                                    </a> 
                                    <?php echo bizgrowth_content(20); ?>
                                    <a class="ReadMore" href="<?php echo esc_url( get_permalink() ); ?>">                                      
                                     <?php esc_attr_e('Read More','bizgrowth'); ?>
                                    </a>                                    
                                    </div>
                                    <?php endwhile;
                                    wp_reset_query(); ?>
                        
                        <?php }} ?>  
                    <div class="clear"></div>  
               </div><!-- services-wrap-->
              <div class="clear"></div>
            </div><!-- container -->
       </section>
	   <?php } ?>
	   
	   
	   <?php if ( get_theme_mod( 'page-setting1' ) != "" ) { ?>
       <section id="wrapfirst">
            	<div class="container">
                    <div class="welcomewrap">
						<?php if( get_theme_mod('page-setting1')) { ?>
						<?php $queryvar = new WP_query('page_id='.get_theme_mod('page-setting1' ,true)); ?>
						<?php while( $queryvar->have_posts() ) : $queryvar->the_post();?> 		
						<div class="welcomecontent">
						 <h3><?php the_title(); ?></h3> 
						 <div style="margin-bottom:px;" class="UnderLine"><span class="hr-style"></span></div>        
						 <?php the_content(); ?>
						 <a class="ReadMore" href="<?php echo esc_url( get_permalink() ); ?>">                                      
							<?php esc_attr_e('Read More','bizgrowth'); ?>
						  </a> 
						 </div>
						  <div class="welcomethumb">
						 <?php the_post_thumbnail( array(570,380, true));?>  
						 </div>                  
						 <div class="clear"></div>
						<?php endwhile; } ?> 
               		</div><!-- welcomewrap-->
              <div class="clear"></div>
            </div><!-- container -->
       </section>  
	   <?php } ?>
	        
	<?php }?>