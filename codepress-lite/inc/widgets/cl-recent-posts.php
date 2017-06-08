<?php
/**
 * Recent Posts widget
 *
 * @package Codepress Lite Since 0.0.3
 */

add_action('widgets_init', 'codepress_lite_register_recent_posts_widget');

function codepress_lite_register_recent_posts_widget() {
    register_widget('Codepress_lite_recent_posts');
}


/**
 * CODEPRESS Recent Posts Widget Class
 */
class Codepress_lite_recent_posts extends WP_Widget {
	function __construct() { 
		$widget_ops = array( 
			'classname' => 'codepress_lite_recent_posts widget_recent_post', 
			'description' => __('Displays Recent Posts', 'codepress-lite') 
		);
		
		parent::__construct('codepress_lite_recent_posts', esc_html__('&nbsp;CL - Recent Posts', 'codepress-lite'), $widget_ops);
	}
	
    function widget($args, $instance) {
		extract($args);
        
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		
		$number = isset($instance['number']) ? $instance['number'] : '';
          
		
        if (empty($instance['number']) || !$number = absint($instance['number'])) {
            $number = 4;
        } 
        
        $queryArgs = array( 
			'posts_per_page' => absint($number), 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => true, 
			'post_type' => 'post', 
            'orderby' => 'DESC'
		);
		
		
        $lt = new WP_Query($queryArgs);

        
        if ($lt->have_posts()) { 
            
			echo  $before_widget;
            ?>
        		<h3 class="widget-title"><?php echo esc_html($title); ?> </h3>
                
        		<div class="recent-post-wrapper">
  
			
            <?php
			
            while ($lt->have_posts()) : $lt->the_post();
                ?>
                
                    <div class="single-article clearfix">
        				<div class="article-content">
                        
                            <?php if (has_post_thumbnail() != '') { ?>
                                
            					<figure class="recent-post-img">
            						<a href="<?php the_permalink(); ?>"> 
                                    
                                    <?php the_post_thumbnail( 'thumbnail', array( 
                						'alt' => esc_attr(get_the_title()),
                						'title' => esc_attr(get_the_title()),  
                					)); ?>
                                    
                                    </a>
            					</figure>
                                
                            <?php } ?>
                            
        					<div class="recent-post-content">
        						<h3 class="entry-title"> 
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                                </h3>
        						<span class="category"><?php codepress_lite_category(); ?></span>
        					</div>
        				</div>
        			</div> <!-- single article end -->

                <?php
                
			endwhile;
			?>
            
            </div>
            
        
        <?php  
		echo $after_widget; 
        }
		
		wp_reset_postdata();
        
    }
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = codepress_lite_html_text_validate($new_instance['title']);
        $instance['number'] = absint($new_instance['number']);
        
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $number = (isset($instance['number']) && $instance['number'] != 0) ? $instance['number'] : 3;
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'codepress-lite'); ?>:<br />
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e("Enter the number of post you'd like to display", 'codepress-lite'); ?>:<br /><br />
                <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo absint($number); ?>" size="3" />
                <small class="s_red"><?php _e('default is 3', 'codepress-lite'); ?></small><br />
            </label>
        </p>
        
        <?php
    }
}