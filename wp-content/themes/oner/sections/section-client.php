<?php
/**
 * Template part for displaying Client Section
 *
 * @package Oner
 */

$client_section_cat = get_theme_mod( 'client_section_cat' );
$client_section_count = get_theme_mod( 'client_section_count', 9 ); 
$client_section_title = get_theme_mod('client_section_title');   
$client_section_item_space = get_theme_mod('client_section_item_space');

$client_post = array(   
	'cat' => $client_section_cat,  
	'posts_per_page' => intval($client_section_count)              
);

	if( $client_section_title ) {
		echo '<div class="section-head">';
		echo '<h1 class="title-divider">' . get_the_title(absint($client_section_title)) . '</h1>';
		$description = get_post_field('post_excerpt',absint($client_section_title));
		if($description)
		echo '<p class="sub-description">' . $description . '</p>';
	    echo '</div>';
	}

	if ($client_section_cat) {
		$query = new WP_Query($client_post);        
		if( $query->have_posts()) : ?>
			<div class="client-wrapper clearfix"> 
				<ul class="slides"> 
					<?php while($query->have_posts()) :
							$query->the_post();
							if( has_post_thumbnail() ) : ?>
							    <li style="padding: <?php echo $client_section_item_space.'px'; ?>">
							    	<div class="flex-image">
							    		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
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