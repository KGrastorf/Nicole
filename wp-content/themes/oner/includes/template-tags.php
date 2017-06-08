<?php
/**
 * Custom template tags for this theme.
 *   
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Oner
 */
      

if ( ! function_exists( 'oner_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
	function oner_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation clearfix" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'oner' ); ?></h1>
			<div class="nav-links">
				<?php
					previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'oner' ) );
					next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'oner' ) );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'oner_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function oner_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('') ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'oner' ),
		'<i class="fa fa-clock-o"></i> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( '%s', 'post author', 'oner' ),
		'<i class="fa fa-user"></i> <span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
	edit_post_link( __( 'Edit', 'oner' ), '<span class="edit-link"><i class="fa fa-pencil"></i> ', '</span>' );
}
endif;

if ( ! function_exists( 'oner_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function oner_entry_footer() {
	// Hide category and tag text for pages.
	
	if ( 'post' == get_post_type() ) {    
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'oner' ) );
		if ( $categories_list ) {
			printf( '<span class="cat-links"><i class="fa fa-folder-open"></i> ' . __( '%1$s ', 'oner' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'oner' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tags"></i> ' . __( '%1$s ', 'oner' ) . '</span>', $tags_list );
		}
	}
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'oner_categorized_blog' ) ) {
	function oner_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'oner_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'oner_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so oner_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so oner_categorized_blog should return false.
			return false;
		}
	}
}

/**
 * Flush out the transients used in oner_categorized_blog.
 */
if ( ! function_exists( 'oner_category_transient_flusher' ) ) {
	function oner_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'oner_categories' );
	}
}
add_action( 'edit_category', 'oner_category_transient_flusher' );
add_action( 'save_post',     'oner_category_transient_flusher' );

// Recent Posts with featured Images to be displayed on home page
if( ! function_exists('oner_recent_posts') ) {
	function oner_recent_posts() {      
		$output = '';
		$posts_per_page  = get_theme_mod('recent_posts_count', 3 );
		// WP_Query arguments
		$args = array (
			'post_type'              => 'post',
			'post_status'            => 'publish',   
			'posts_per_page'         => $posts_per_page,
			'ignore_sticky_posts'    => true,
			'order'                  => 'DESC',
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() && get_theme_mod('enable_recent_post_service',true) ) {
			$output .= '<div class="post-wrapper">';  
			$output .= '<div class="container">';  
			$output .= '<h1 class="title-divider">' . apply_filters('oner_post_title',__('Recent Post','oner') ) . '</h1>';
			$output .= '<div class="latest-posts">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$output .= '<div class="one-third column">';
				$output .= '<div class="latest-post">';
						$output .= '<div class="latest-post-thumb">'; 
								if ( has_post_thumbnail() ) {
									$output .= get_the_post_thumbnail($query->post->ID ,'oner-recent_posts_img');
								}
								else {
									$output .= '<img src="' . esc_url( get_stylesheet_directory_uri() ) . '/images/no-image.png" alt="" >';
								}
							$output .= '</div><!-- .latest-post-thumb -->';
					    $output .= '<h3><a href="'. esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
						$output .='<div class="entry-meta">';
							$output .='<span class="data-structure"><span class="dd">' . get_the_time('F j, Y').'</span></span>';
							$output .= oner_get_author();
							$output .= oner_get_comments_meta();  
						$output .='</div><!-- entry-meta -->';
							
						$output .= '<div class="latest-post-content">';
						$output .= '<p>' . get_the_excerpt() . '</p>';
					$output .= '</div><!-- .latest-post-content -->';
					$output .= '<p><a href="' . esc_url( get_permalink() ) . '" class="btn-readmore">' . __( 'Read More','oner' ) .'</a></p>';
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
	}
}

/**
  * Generates Breadcrumb Navigation
  */
 
 if( ! function_exists( 'oner_breadcrumbs' )) {
 
	function oner_breadcrumbs() {
		/* === OPTIONS === */
		$text['home']     = __( '<i class="fa fa-home"></i>','oner' ); // text for the 'Home' link
		$text['category'] = __( 'Archive by Category "%s"','oner' ); // text for a category page
		$text['search']   = __( 'Search Results for "%s" Query','oner' ); // text for a search results page
		$text['tag']      = __( 'Posts Tagged "%s"','oner' ); // text for a tag page
		$text['author']   = __( 'Articles Posted by %s','oner' ); // text for an author page
		$text['404']      = __( 'Error 404','oner' ); // text for the 404 page

		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$breadcrumb_char = get_theme_mod( 'breadcrumb_char', '1' );
		if ( $breadcrumb_char ) {
		 switch ( $breadcrumb_char ) {
		 	case '2' :
		 		$delimiter = ' // ';
		 		break;
		 	case '3':
		 		$delimiter = ' > ';
		 		break;
		 	case '1':
		 	default:
		 		$delimiter = ' &raquo; ';
		 		break;
		 }
		}

		$before      = '<span class="current">'; // tag before the current crumb
		$after       = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$homeLink = home_url() . '/';
		$linkBefore = '<span typeof="v:Breadcrumb">';
		$linkAfter = '</span>';
		$linkAttr = ' rel="v:url" property="v:title"';
		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

		if (is_home() || is_front_page()) {

			if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';

		} else {

			echo '<div id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
				}
				echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
				}
   
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . $post_type->labels->singular_name . $after;

			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				printf($link, get_permalink($parent), $parent->post_title);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_tag() ) {
				echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {
		 		global $author;
				$userdata = get_userdata($author);
				echo $before . sprintf($text['author'], $userdata->display_name) . $after;

			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page', 'oner' ) . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}

			echo '</div>';

		}
	
	} // end oner_breadcrumbs()

}

if ( ! function_exists( 'oner_get_author' ) ) {
	function oner_get_author() {
		$byline = sprintf(
			_x( '%s', 'post author', 'oner' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> ' . esc_html( get_the_author() ) . '</a></span>'
		);	

		return $byline;
	}
}

if ( ! function_exists( 'oner_author' ) ) {
	function oner_author() {
	   echo oner_get_author();
	}
}  


if ( ! function_exists( 'oner_get_comments_meta' ) ) {
	function oner_get_comments_meta() {

	    $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

	    if ( comments_open() ) {
		  if ( $num_comments == 0 ) {
		    $comments = __('No Comments','oner');
		  } elseif ( $num_comments > 1 ) {
		    $comments = $num_comments . __(' Comments','oner');
		  } else {
		    $comments = __('1 Comment','oner');  
		  }
		  $write_comments = '<span class="comments-link"><i class="fa fa-comments"></i><a href="' . get_comments_link() .'">'. $comments.'</a></span>';
		} else{
			$write_comments = '<span class="comments-link"><i class="fa fa-comments"></i><a href="' . get_comments_link() .'">'. __('Leave a comment', 'oner').'</a></span>';
		}
		return $write_comments;	
    }
}


if ( ! function_exists( 'oner_comments_meta' ) ) {
	function oner_comments_meta() {	
		echo oner_get_comments_meta();
	} 
}



if ( ! function_exists( 'oner_edit' ) ) { 
	function oner_edit() {
		edit_post_link( __( 'Edit', 'oner' ), '<span class="edit-link"> ', '</span>' );
	}
}

if ( ! function_exists( 'oner_related_posts' ) ) {
	// Related Posts Function by Tags (call using oner_related_posts(); ) /NecessarY/ May be write a shortcode?
	function oner_related_posts() {
		echo '<ul id="webulous-related-posts">';
		global $post;
		$post_hierarchy = get_theme_mod('related_posts_hierarchy','1');
		$relatedposts_per_page  =  get_option('post_per_page') ;
		if($post_hierarchy == '1') {
			$related_post_type = wp_get_post_tags($post->ID);
			$tag_arr = '';
			if($related_post_type) {
				foreach($related_post_type as $tag) { 
					$tag_arr .= $tag->slug . ',';
			    }
		        $args = array(
		        	'tag' =>  esc_html( $tag_arr ),
		        	'numberposts' => intval( $relatedposts_per_page ), /* you can change this to show more */
		        	'post__not_in' => array($post->ID)
		     	);
		   }
		}else {
			$related_post_type = get_the_category($post->ID); 
			if ($related_post_type) {
				$category_ids = array();
				foreach($related_post_type as $category) {
				     $category_ids = $category->term_id; 
				}  
				$args = array(
					'category__in' => absint($category_ids),
					'post__not_in' => array($post->ID),
					'numberposts' => intval( $relatedposts_per_page ), 
		        );
		    }
		}
		if( $related_post_type ) {
	        $related_posts = get_posts($args);
	        if($related_posts) {
	        	foreach ($related_posts as $post) : setup_postdata($post); ?>
		           	<li class="related_post">
		           		<a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('recent-work'); ?></a>
		           		<a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		           	</li>
		        <?php endforeach; }
		    else {
	            echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'oner' ) . '</li>'; 
			 }
		}else{
			echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'oner' ) . '</li>';
		}
		wp_reset_query();
		
		echo '</ul>';
	}
}



/*  Site Layout Option  */
if ( ! function_exists( 'oner_layout_class' ) ) {
	function oner_layout_class() {
	     $sidebar_position = get_theme_mod( 'sidebar_position', 'right' ); 
	     if( 'fullwidth' == $sidebar_position ) {
	     	echo 'sixteen';
	     }else{
	     	echo 'eleven';
	     }
	     if ( 'no-sidebar' == $sidebar_position ) {
	     	echo ' no-sidebar';
	     }
	}
}


/** One Page Theme
 * Function to get Sections 
 */
if ( ! function_exists( 'oner_one_page_get_sections' ) ) { 
	function oner_one_page_get_sections(){
	    $sections = array( 'slider', 'blog', 'gallery', 'service','team','testimonial','client','cta' );
	    $enabled_section = array();
	    foreach ( $sections as $section ){ 
	        if ( get_theme_mod( $section . '_section_status',1 ) == 1 ) {
	            $enabled_section[] = array(
	                'id' => $section,
	                'menu_text' => esc_html( get_theme_mod(  $section . '_section_id',$section ) ),
	            );
	        }
	    } 
	    return $enabled_section;  
	}
}

/**
 * Exclude post with Category from blog and archive page. 
*/
if ( ! function_exists( 'oner_one_page_exclude_cat' ) ) {
	function oner_one_page_exclude_cat( $query ){
	    $cat = esc_html( get_theme_mod( 'exclude_cat_section' ) );
	    
	    if( $cat && ! is_admin() && $query->is_main_query() ){
	        $cat_not_in = explode(',', $cat);
	        if( $query->is_home() || $query->is_archive() ) {
				$query->set( 'category__not_in', $cat_not_in );
			}
	    }    
	}
}
add_filter( 'pre_get_posts', 'oner_one_page_exclude_cat' );


/* Admin notice */
/* Activation notice */
add_action( 'load-themes.php',  'oner_one_activation_admin_notice'  );

if( !function_exists('oner_one_activation_admin_notice') ) {
	function oner_one_activation_admin_notice() {
        global $pagenow;
	    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
	        add_action( 'admin_notices', 'oner_admin_notice' );
	    } 
	} 
}

/**
 * Add admin notice when active theme
 *
 * @return bool|null
 */
function oner_admin_notice() { ?>
    <div class="updated notice notice-alt notice-success is-dismissible">
        <p><?php printf( __( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'oner' ), 'Oner', admin_url( 'themes.php?page=oner_upgrade' )  ); ?></p>
        <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=oner_upgrade' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Oner', 'oner' ); ?></a></p>
    </div><?php
}


add_action('wp_footer','oner_onepage_menu_scroll');
function oner_onepage_menu_scroll() { 
	if( !get_theme_mod('menu_section_section_menu',true) ){ ?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
			    $('#site-navigation').onePageNav({
			        currentClass: 'current-menu-item',
			        changeHash: false,
			        scrollSpeed: 1500,
			        scrollThreshold: 0.5,
			        filter: '', 
			        easing: 'swing',        
			    });
			});
		</script><?php
	}
}