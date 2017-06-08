<?php
/**
 * Template part for displaying Blog Section
 *
 * @package Oner
 */

$recent_posts_count = get_theme_mod('blog_section_recent_posts_count',get_option('post_per_page'));
$blog_section_title = get_theme_mod('blog_section_title');

$output = '';
        $cat = get_theme_mod( 'exclude_cat_section' ); 
        $cat_not_in = explode(',', $cat);

		// WP_Query arguments
		$args = array (
			'post_type'              => 'post',
			'post_status'            => 'publish',   
			'posts_per_page'         => intval($recent_posts_count),
			'ignore_sticky_posts'    => true,
			'order'                  => 'DESC',
			'category__not_in'       => $cat_not_in 
		);
		

		// The Query
		$query = new WP_Query( $args );
		//echo '<pre>',print_r($query),'</pre>';

		// The Loop
		if ( $query->have_posts() ) {
			$output .= '<div class="post-wrapper">';  
			$output .= '<div class="container">'; 

			if( $blog_section_title ) { 
				$output .= '<div class="section-head">';
				$output .= '<h1 class="title-divider">' . get_the_title(absint($blog_section_title)) . '</h1>';
				$description = get_post_field('post_excerpt',absint($blog_section_title) );
				if($description)
				$output .= '<p class="sub-description">' . $description  . '</p>';
				$output .= '</div>';
			}
 
			$output .= '<div class="latest-posts">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$output .= '<div class="eight columns">';
				$output .= '<div class="latest-post">';
						$output .= '<div class="latest-post-thumb">'; 
								if ( has_post_thumbnail() ) {
									$output .= get_the_post_thumbnail($query->post->ID ,'oner-recent_posts_img');
									$output .='<span class="date-structure"><span class="dd">' . get_the_time('j').'</span>
										<span class="mm">' . get_the_time('M').'</span>
									</span>';
								}
								else {
									$output .= '<img src="' . esc_url( get_stylesheet_directory_uri() ) . '/images/no-image.png" alt="" >';
									$output .='<span class="date-structure"><span class="dd">' . get_the_time('j').'</span>
										<span class="mm">' . get_the_time('M').'</span>
									</span>';
								}
							$output .= '</div><!-- .latest-post-thumb -->';
					    $output .= '<h3><a href="'.esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
						$output .='<div class="entry-meta">';
							$output .= oner_get_author();
							$output .= '<span class="edit-link"> <a href="'. esc_url( get_permalink() ).'" class="edit-post-link">'.__('Edit','oner') .'</a></span>';
							$output .= oner_get_comments_meta();
						$output .='</div><!-- entry-meta -->';
							
						$output .= '<div class="latest-post-content">';
						$output .= '<p>' . get_the_excerpt() . '</p>';
					$output .= '</div><!-- .latest-post-content -->';
					$output .= '<p><a href="' . esc_url(get_permalink()) . '" class="btn-readmore">' . __( 'Read More','oner' ) .'</a></p>';
					$output .= '</div>';
				$output .= '</div><!-- .latest-post -->';
			}
			$output .= '</div><!-- latest post end -->';
			$output .= '</div><!-- container close -->';
			$output .= '</div><!-- .post-wrapper -->';
		} 
		$query = null;
		// Restore original Post Data
		wp_reset_postdata();
		echo $output; 