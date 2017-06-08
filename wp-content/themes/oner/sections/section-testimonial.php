<?php
/**
 * Template part for displaying Testimonial Section
 *
 * @package Oner
 */

$testimonial_section_cat = get_theme_mod( 'testimonial_section_cat' );
$testimonial_section_count = get_theme_mod( 'testimonial_section_count', 9 ); 
$testimonial_section_title = get_theme_mod('testimonial_section_title');   
 
$testimonial_post = array(   
	'cat' => $testimonial_section_cat,
	'posts_per_page' => intval($testimonial_section_count)              
);

	if( $testimonial_section_title ) {
		echo '<div class="section-head">';
		echo '<h1 class="title-divider">' . get_the_title(absint($testimonial_section_title)) . '</h1>';
		$description = get_post_field('post_excerpt',absint($testimonial_section_title));
		if($description)
		echo '<p class="sub-description">' . $description . '</p>';
        echo '</div>';
	}


	if ($testimonial_section_cat) {
		$query = new WP_Query($testimonial_post);        
		if( $query->have_posts()) : ?>
			<div class="testimonial-container clearfix"> 
			<div class="testimonials">  
			    <ul class="slides">
					<?php while($query->have_posts()) :
							$query->the_post();?>
							<li>
								<div class="testimony"><div class="t-inner"><?php
								    the_content(); ?>
								</div></div><?php
								if( has_post_thumbnail() ) : ?>
							    	<div class="client-pic">
							    		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
							    	</div>
							    <?php endif;
							    the_title('<h4 class="client">','</h4>');?>	
						    </li>		   
					<?php endwhile; ?>
				</ul>
				</div>
			</div>
	
		<?php endif; ?>
	   <?php  
		$query = null;
		wp_reset_postdata();
	}