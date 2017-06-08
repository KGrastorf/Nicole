<?php
/**
 * The front page template file.
 *
 * @package Oner
  */
 
if ( 'posts' == get_option( 'show_on_front' ) ) { 
	get_template_part('index');
} else {
 
get_header(); 
$enabled_sections = oner_one_page_get_sections(); ?>

<?php do_action('oner_before_content'); ?>

	<div id="content" class="site-content" style="padding-top:0;">

<?php

	    if( is_array( $enabled_sections ) ){
	        foreach( $enabled_sections as $section ){ 
        	    /**
                 * Hook before section
                 */

                do_action('onepage_before_section_'.$section['id'] );  
                do_action( 'onepage_before_section_part', $section ); ?>

                <?php  if( ( $section['id'] == 'slider' ) ) {  ?>

	                <section id="<?php echo esc_attr( $section['id'] ); ?>" class="<?php echo 'class-'. esc_attr( $section['id'] ); ?>">
	                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
	                </section><?php
                }else{ ?>

	                <section id="<?php echo esc_attr( $section['id'] ); ?>" class="<?php echo 'class-'. esc_attr( $section['id'] ); ?>">
	                   <div class="container">
	                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
	                   </div>
	                </section><?php
                }

                /**
                 * Hook after section
                 */
                do_action('onepage_after_section_part', $section );
                do_action('onepage_after_section_'.$section['id']);
	        }
	    }

        if( get_theme_mod('page_content_status',false) ) :
			 while ( have_posts() ) : the_post(); ?>
                <div class="container">
				    <?php get_template_part( 'template-parts/content', 'page' ); ?>
                </div><?php 
                endwhile; // end of the loop.
		endif; 

 get_footer(); 
 
}