<?php
/**
 * Template part for displaying CTA Section
 *
 * @package Oner
 */

$cta_section_content = get_theme_mod('cta_section_content');


	if( $cta_section_content ) {
		
		$args = array(
			'post_type' => 'page',
			'p' => $cta_section_content,
		);
		$query = new WP_Query($args);
		if( $query->have_posts()) : ?>
			<?php while($query->have_posts()) :
				$query->the_post(); ?>
					    <div class="cta-content-wrapper">
				    	    <?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					    	<div class="cta-content">
					        	<?php the_content( __( 'Read More', 'oner' ) ); ?>
					    	</div>
					   </div>
			<?php endwhile; ?>
		<?php endif; ?>   

		<?php  
			$query = null;
			$args = null;
			wp_reset_postdata(); 
	}