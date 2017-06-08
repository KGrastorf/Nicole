<?php
/**
 * Home Portfolio widget
 *
 * @package Codepress Lite Since 0.0.3
 */

add_action('widgets_init', 'codepress_lite_register_codepress_lite_home_portfolio_widget');

function codepress_lite_register_codepress_lite_home_portfolio_widget() {
    register_widget('codepress_lite_home_portfolio');
}


/**
 * Powermag featured layout 1 Widget Class
 */
class codepress_lite_home_portfolio extends WP_Widget {
    
	function __construct() {
		$widget_ops = array( 
			'classname' => 'codepress_lite_home_portfolio widget_work_block', 
			'description' => __('Best for Home Page Sidebar', 'codepress-lite') 
		);
		
		parent::__construct('codepress_lite_home_portfolio',  esc_html__('&nbsp;CL - Home Portfolio Layout Widget', 'codepress-lite'), $widget_ops);
	}
	
    function widget($args, $instance) {
		extract($args);
		$category = isset($instance['category']) ? $instance['category'] : '';
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $description = apply_filters('widget_title', empty($instance['description']) ? '' : $instance['description'], $instance, $this->id_base);
		
		$number = isset($instance['number']) ? (int) $instance['number'] : '';
        
		
        if (empty($instance['number']) || !$number = absint($instance['number'])) {
            $number = 8;
        } elseif ($number < 1) {
            $number = 8;
        } elseif ($number > 15) {
            $number = 8;
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
	            <div class="work-wrapper">
	            	<div class="title-wrapper wow fadeInDown">
                        <div class="container">
		                <?php if(!empty($title)): ?>
                        <h3 class="widget-title"><?php echo esc_html($title); ?></h3>
                        <?php endif; 
                        if(!empty($description)):
                        ?>
		                <div class="widget-desc"><?php echo esc_html($description); ?></div>
                        <?php endif; ?>
                        </div>
		            </div>

    <div id="tabs">
	  <div id="tabs-1">
		  <div class="tab-content-wrapper">
 
            <?php
			
            while ($lt->have_posts()) : $lt->the_post();
                ?>
                
                
				<?php if(has_post_thumbnail()): 
                        $port_cat_name = get_the_category(); 
                        $cat_i = 1;
                        $cat_count = sizeof($port_cat_name);
                    ?>
				  	<div class="work-block  wow fadeInUp">
				        <figure class="work-img">
				            <?php 
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'codepress-lite-portfolio-thumb', false );
                            if(!empty($image[0])){
                             ?>
                            <img src="<?php echo esc_url($image[0]); ?>">
                            <?php } ?>
				        </figure>
				        <div class="work-content-wrapper">
				            <div class="work-text">
				                <h3 class="project-title">
									<a alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
				                <div class="project-content">
				                    <?php foreach($port_cat_name as $key)
                                        {
                                            if($cat_i == $cat_count || $cat_i == 5){
                                                $separator ='';
                                            }
                                            else{
                                                $separator = ' / ';
                                            }
                                            ?>
                                            <a href="<?php echo site_url().'/category/'.$key->slug; ?>"><?php echo esc_attr($key->cat_name); ?></a><?php echo $separator; ?>
                                            <?php
                                            if($cat_i == 5){
                                                break;
                                            }
                                            $cat_i++;
                                        } ?>
				                </div>
				            </div>    
				        </div>
				    </div>
                    
                    <?php endif; 
                    
			endwhile;
            
            
			?>
            </div>
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