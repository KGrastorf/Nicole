<?php
/**
 * Template part for displaying Team Section
 *
 * @package Oner
 */
 
$team_section_cat = get_theme_mod( 'team_section_cat' );
$team_section_count = get_theme_mod( 'team_section_count', 9 ); 
$team_section_title = get_theme_mod('team_section_title');   

$team_post = array(   
	'cat' => $team_section_cat,
	'posts_per_page' => intval($team_section_count)             
);

   if( $team_section_title ) {
		echo '<div class="section-head">';
		echo '<h1 class="title-divider">' . get_the_title(absint($team_section_title)) . '</h1>';
		$description = get_post_field('post_excerpt',absint($team_section_title));
		if($description)
		echo '<p class="sub-description">' . $description . '</p>';
	    echo '</div>';
	}


	if ($team_section_cat) {
		$query = new WP_Query($team_post);        
		if( $query->have_posts()) : ?>
			<div class="team-wrapper clearfix">  
				<?php while($query->have_posts()) :
						$query->the_post(); ?>
						<div class="one-third column"><?php
							if( has_post_thumbnail() ) : ?>
							    <li>
							    	<div class="flex-image">
							    		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
							    	</div>
							    	<div class="team-content">
								    	<?php the_content();?>
								    	</div><?php
								    	the_title('<h4>','</h4>');?>
							    	
							    </li>
						    <?php endif;?>		
					    </div>	   
				<?php endwhile; ?>
			</div>
	
		<?php endif; ?>
	   <?php  
		$query = null;
		wp_reset_postdata();
	}