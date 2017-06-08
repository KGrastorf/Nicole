<?php
/**
 * Template part for displaying Slider Section
 *
 * @package Oner
 */

$slider_section_cat = get_theme_mod( 'slider_section_cat', '' );
$slider_section_slider_count = get_theme_mod( 'slider_section_slider_count', 5 );   

		$slider_posts = array(   
			'cat' => $slider_section_cat,
			'posts_per_page' => intval($slider_section_slider_count)              
		);

		if ($slider_section_cat) {
			$query = new WP_Query($slider_posts);        
			if( $query->have_posts()) : ?>
				<div class="flexslider">  
					<ul class="slides">
						<?php while($query->have_posts()) :
								$query->the_post();
								if( has_post_thumbnail() ) : ?>
								    <li>
								    	<div class="flex-image">
								    	   <div class="oner-slide-overlay"></div>
								    		<?php the_post_thumbnail('full'); ?>
								    	</div>
								    	<div class="flex-caption">
								    		<?php the_content( __('Read More','oner') ); ?>
								    	</div>
								    </li>
							    <?php endif;?>			   
						<?php endwhile; ?>
					</ul>
				</div>
		
			<?php endif; ?>
		   <?php  
			$query = null;
			wp_reset_postdata();
		}