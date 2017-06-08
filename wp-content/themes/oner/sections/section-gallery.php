<?php
/**
 * Template part for displaying Gallery Section
 *
 * @package Oner
 */

$gallery_section_cat = get_theme_mod( 'gallery_section_cat' );
$gallery_section_count = get_theme_mod( 'gallery_section_count', 9 );
$gallery_section_grid_col = get_theme_mod('gallery_section_grid_col',3);  
$gallery_section_item_space = get_theme_mod('gallery_section_item_space');   
$gallery_section_title = get_theme_mod('gallery_section_title');   

$gallery_post = array(   
	'cat' => $gallery_section_cat,
	'posts_per_page' => intval($gallery_section_count)              
);

switch ($gallery_section_grid_col) {
	case 1:
		$grid_class = 'sixteen columns';
		$grid_wrapper_class = 'one-col-gallery';
		break;
	case 2:
		$grid_class = 'eight columns';
		$grid_wrapper_class = 'two-col-gallery';
		break;
	case 3:
		$grid_class = 'one-third column';
		$grid_wrapper_class = 'three-col-gallery';
		break;
	case 4:
		$grid_class = 'four columns';
		$grid_wrapper_class = 'four-col-gallery';
		break;
	default:
	    $grid_class = 'one-third column';
	    $grid_wrapper_class = 'three-col-gallery';
		break;
}

	if( $gallery_section_title ) {
		echo '<div class="section-head">';
		echo '<h1 class="title-divider">' . get_the_title(absint($gallery_section_title)) . '</h1>';
		$description =  get_post_field('post_excerpt',absint($gallery_section_title));
		if($description)
		echo '<p class="sub-description">' . $description . '</p>';
	    echo '</div>';
	}
	
	if ($gallery_section_cat) {
		$query = new WP_Query($gallery_post);        
		if( $query->have_posts()) : ?>
			<div class="gallery-wrapper <?php echo $grid_wrapper_class; ?> clearfix">  
				<?php while($query->have_posts()) :
						$query->the_post();
						if( has_post_thumbnail() ) : ?>
						    <li class="<?php echo $grid_class; ?>" style="padding: <?php echo $gallery_section_item_space.'px'; ?>">
						    	<div class="flex-image">
						    		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
						    		<div class="gallery-hover"><span><a href="<?php echo esc_url( get_permalink() ); ?>"><?php apply_filters('gallery_view_title',_e('View Project','oner')); ?></a></span></div>
						    	</div>
						    </li>
					    <?php endif;?>			   
				<?php endwhile; ?> 
			</div>
	
		<?php endif; ?>
	   <?php  
		$query = null;
		wp_reset_postdata();
	}