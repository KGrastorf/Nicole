<?php
/**
 * Services widget
 *
 * @package Codepress Lite Since 0.0.3
 */

add_action('widgets_init', 'codepress_lite_register_services_widget');

function codepress_lite_register_services_widget() {
    register_widget('codepress_lite_services');
}


/**
 * Powermag featured layout 1 Widget Class
 */
class codepress_lite_services extends WP_Widget {
    
	function __construct() {
		$widget_ops = array( 
			'classname' => 'codepress_lite_services widget-service-post clearfix', 
			'description' => __('Best for Home Page Sidebar', 'codepress-lite') 
		);
		
		parent::__construct('codepress_lite_services',  esc_html__('&nbsp;CL - Services Layout Widget', 'codepress-lite'), $widget_ops);
	}
	
    function widget($args, $instance) {
		extract($args);
		$category = isset($instance['category']) ? $instance['category'] : '';
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $description = apply_filters('widget_title', empty($instance['description']) ? '' : $instance['description'], $instance, $this->id_base);
		
		$number = isset($instance['number']) ? $instance['number'] : '';
        
		
        if (empty($instance['number']) || !$number = absint($instance['number'])) {
            $number = 3;
        } elseif ($number < 1) {
            $number = 1;
        } elseif ($number > 15) {
            $number = 15;
        }
        
        $queryArgs = array( 
			'posts_per_page' => absint($number), 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => true, 
			'post_type' => 'post', 
            'cat' => absint($category)
		);
		
		
        $lt = new WP_Query($queryArgs);

        
        if ($lt->have_posts()) { 
			echo  $before_widget; 
            ?> 
            <div class="section-wrapper"> 
				<div class="container">
                    
                    
                    <div class="title-icon-wrapper">
						<div class="title-wrapper wow fadeInDown">
						<?php if ($title) { 
                				echo  $before_title . esc_html($title). $after_title;
                			}
                            if($description != ''):
                            ?>
                            
						      <div class="widget-desc"><?php echo esc_html($description); ?></div>
                              
                        <?php endif; ?> 
                        </div>
					</div>
                    
                    <div class="service-detail">
						<div class="col-wrapper">
                    
                    
            <?php
			
			$count = 1;
            while ($lt->have_posts()) : $lt->the_post(); 
                
                if($count % 2 != 0){
                    ?>
                    
                    <article class="single-article clearfix"> 
						<div class="article-content col-2 wow fadeInLeft"> 
							<h3 class="entry-title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>
							<div class="entry-content">
								<?php codepress_lite_add_excerpt_length( apply_filters( 'codepress_lite_service_excerpt_length', 70 ) );
                					the_excerpt();
                					codepress_lite_remove_excerpt_length();
                                        ?>
							</div>
						</div>
						<div class="figure-wrap col-2 wow fadeInRight">
							<figure> <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('codepress-lite-services'); ?></a> </figure>
						</div>
					</article> <!-- single article end -->
                    
                    <?php
                }
                else
                {
                    ?>
                    <article class="single-article clearfix">
                        <div class="article-content col-2 cl-responsive wow fadeInLeft">
							<h3 class="entry-title"> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a> </h3>
							<div class="entry-content">
								<?php codepress_lite_add_excerpt_length( apply_filters( 'codepress_lite_service_excerpt_length', 70 ) );
                					the_excerpt();
                					codepress_lite_remove_excerpt_length();
                                        ?>					
							</div> 
						</div>
                        
						<div class="figure-wrap col-2 wow fadeInLeft">
							<figure> <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('codepress-lite-services'); ?></a> </figure>
						</div>
						<div class="article-content col-2 hidden wow fadeInRight">
							<h3 class="entry-title"> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a> </h3>
							<div class="entry-content">
								<?php codepress_lite_add_excerpt_length( apply_filters( 'codepress_lite_service_excerpt_length', 70 ) );
                					the_excerpt();
                					codepress_lite_remove_excerpt_length();
                                ?>						
							</div>
						</div>
					</article> <!-- single article end -->
                    
                    <?php
                }

                $count++;
			endwhile;
            
            
			?>
                        </div>
					</div>
            </div>
        </div>
        
        <?php  
		echo $after_widget; 
        }
		
		wp_reset_postdata();
    }
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = codepress_lite_html_text_validate($new_instance['title']);
        $instance['description'] = codepress_lite_html_text_validate($new_instance['description']);
		$instance['category'] = absint($new_instance['category']);
        $instance['number'] = absint($new_instance['number']);
        
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $number = (isset($instance['number']) && $instance['number'] != 0) ? $instance['number'] : 4;
        $category = isset($instance['category']) ? $instance['category'] : ''; 
        $description = isset($instance['description']) ? $instance['description'] : '';

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'codepress-lite'); ?>:<br />
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'codepress-lite'); ?>:<br />
                <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_html($description); ?></textarea>
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Choose Category', 'codepress-lite'); ?>:<br />
                <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat">
                    <option value=""><?php _e('Select Category', 'codepress-lite'); ?>&nbsp;</option>
				<?php 
					$tl_categs = get_categories( 'orderby=name&hide_empty=0' );
                    
					
					if (sizeof($tl_categs) > 0) {
						foreach($tl_categs as $tl_categ) {
							if ($category == $tl_categ->cat_ID) {
								echo '<option value="' . absint($tl_categ->cat_ID) . '" selected="selected">' . esc_attr($tl_categ->name) . '&nbsp;</option>';
							} else {
								echo '<option value="' . absint($tl_categ->cat_ID) . '">' . esc_attr($tl_categ->name) . '&nbsp;</option>';
							}
						}
					}
				?>
                </select>
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e("Enter the number of post you'd like to display", 'codepress-lite'); ?>:<br /><br />
                <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo absint($number); ?>" size="3" />
                <small class="s_red"><?php _e('default is 4', 'codepress-lite'); ?></small><br />
            </label>
        </p>
        
        <?php
    }
}