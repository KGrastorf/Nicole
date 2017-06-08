<?php
/**
 * Template part for displaying Service Section
 *
 * @package Oner
 */
 
$service_page1 = get_theme_mod('service_section_1');
$service_page2 = get_theme_mod('service_section_2');
$service_page3 = get_theme_mod('service_section_3');
$service_section_title = get_theme_mod('service_section_title');
$service_section_icon_1 = get_theme_mod('service_section_icon_1');
$service_section_icon_2 = get_theme_mod('service_section_icon_2');
$service_section_icon_3 = get_theme_mod('service_section_icon_3');


    if( $service_section_title ) {
		echo '<div class="section-head">';
		echo '<h1 class="title-divider">' . get_the_title(absint($service_section_title)) . '</h1>';
		$description = get_post_field('post_excerpt',absint($service_section_title));
		echo '<p class="sub-description">' . $description . '</p>';
	    echo '</div>';
	}

	if( $service_page1 || $service_page2 || $service_page3 ) {
		$service_pages = array($service_page1,$service_page2,$service_page3);
		$args = array(
			'post_type' => 'page',
			'post__in' => $service_pages,
			'posts_per_page' => -1,
			'orderby' => 'post__in'
		);
		$query = new WP_Query($args);
		if( $query->have_posts()) : ?>
			<div class="services-wrapper">
				<?php $i = 1;
				while($query->have_posts()) :
						$query->the_post(); ?>  
						    <div class="one-third service column">
						    	
						    	    <?php if($i == 1):
						    	      $icon_url =  $service_section_icon_1;
						    	      elseif($i == 2):
						    	       $icon_url =  $service_section_icon_2;
						    	      elseif($i == 3):
						    	       	$icon_url =  $service_section_icon_3;
						    	      endif;

					    	        if($icon_url): ?>
					    	          <i class="fa <?php echo $icon_url; ?>"></i><?php
					    	        elseif( has_post_thumbnail() ) : ?>
                                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('oner-recent_page_img'); ?></a><?php
					    	        endif; ?>
						    	
						    	<div class="service-content">
						    	    <?php the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
							    	<?php the_content( __( 'Read More', 'oner' ) ); ?>
						    	</div>
						    </div>
						    <?php $i++;
			    endwhile; ?>
			</div>

		<?php endif; ?>   
		<?php  
			$query = null;
			$args = null;
			wp_reset_postdata(); 
	}