<?php
/**
 * Team widget
 *
 * @package Codepress Lite Since 0.0.3
 */

add_action('widgets_init', 'codepress_lite_clients_widget_register');

function codepress_lite_clients_widget_register() {
    register_widget('codepress_lite_clients');
}


class codepress_lite_clients extends WP_Widget {
    
	function __construct() {
		$widget_ops = array( 
			'classname' => 'codepress_lite_clients widget-client-post clearfix', 
			'description' => __('Best for Home Page', 'codepress-lite') 
		);
		
		parent::__construct('codepress_lite_clients', esc_html__('&nbsp;CL - Client Slider Widget', 'codepress-lite'), $widget_ops);
	}
	
    function widget($args, $instance) {
		extract($args);
		$category = isset($instance['category']) ? absint($instance['category']) : '';
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $description = apply_filters('widget_title', empty($instance['description']) ? '' : $instance['description'], $instance, $this->id_base);
		
		$number = isset($instance['number']) ? $instance['number'] : '';
        
		
        if (empty($instance['number']) || !$number = absint($instance['number'])) {
            $number = 8;
        } elseif ($number < 1) {
            $number = 8;
        } elseif ($number > 15) {
            $number = 15;
        }
     
        
        $queryArgs = array( 
			'posts_per_page' => absint($number), 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => true, 
			'post_type' => 'post', 
            'cat' => $category
		);
		
		
        $lt = new WP_Query($queryArgs);
        
        
        if ($lt->have_posts()) { 
			echo  $before_widget;
            ?> 
            
            
			<div class="section-wrapper">
				<div class="container">
                <?php if(!empty($title)): ?>
				    <h2 class="widget-title wow fadeInDown"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
					<div class="">
                    
					<div class="client-slider">
            			<?php
            			
                        while ($lt->have_posts()) : $lt->the_post();
                            if(has_post_thumbnail()):
                            ?>
                            <div class="item wow zoomIn">
                				<?php 
                                the_post_thumbnail( 'thumbnail', array( 
                        						'alt' => esc_attr(get_the_title()), 
                        						'title' => esc_attr(get_the_title())
                                                ));
                                ?>
                			</div>
                            <?php endif; ?>
            				
                           <?php
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
		
		$instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['description'] = sanitize_text_field($new_instance['description']);
		$instance['category'] = absint($new_instance['category']);
        $instance['number'] = absint($new_instance['number']);
        
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $number = (isset($instance['number']) && $instance['number'] != 0) ? $instance['number'] : 8;
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
                <small class="s_red"><?php _e('default is 8', 'codepress-lite'); ?></small><br />
            </label>
        </p>
        
        <?php
    }
}