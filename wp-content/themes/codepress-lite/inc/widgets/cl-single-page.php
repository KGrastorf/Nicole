<?php

/**
*	This is the single page widget function 
*	@package Codepress Lite
*
*/


add_action('widgets_init', 'codepress_lite_register_single_page_widget');

function codepress_lite_register_single_page_widget() {
    register_widget('codepress_lite_single_page');
}

class Codepress_lite_single_page extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        
        $widget_ops = array( 
			'classname' => 'widget-about-post clearfix', 
			'description' => __('Best for Home Page Sidebar', 'codepress-lite') 
		);
        parent::__construct(
                'codepress_lite_single_page', esc_html__('&nbsp;CL - Single Page', 'codepress-lite'), 
                $widget_ops
                
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // This widget has no title
            // Other fields
            'page_id' => array(
                'codepress_lite_widgets_name' => 'page_id',
                'codepress_lite_widgets_title' => __('Page', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'selectpage',
            ),
            
            'description' => array(
                'codepress_lite_widgets_name' => 'description',
                'codepress_lite_widgets_title' => __('Description', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'textarea',
            ),
            
            'display_title' => array(
                'codepress_lite_widgets_name' => 'display_title',
                'codepress_lite_widgets_title' => __('Show page title', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'checkbox'
            ),
            'display_thumbnail' => array(
                'codepress_lite_widgets_name' => 'display_thumbnail',
                'codepress_lite_widgets_title' => __('Show featured image', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'checkbox'
            ),
            'display_excerpt' => array(
                'codepress_lite_widgets_name' => 'display_excerpt',
                'codepress_lite_widgets_title' => __('Show excerpt', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'checkbox'
            ),
            'read_more_text' => array(
                'codepress_lite_widgets_name' => 'read_more_text',
                'codepress_lite_widgets_title' => __('Read more link text', 'codepress-lite'),
                'codepress_lite_widgets_description' => __('Leave empty for no link', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'text'
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $post_id = $instance['page_id'];
        $display_title = $instance['display_title'];
        $display_thumbnail = $instance['display_thumbnail'];
        $display_excerpt = $instance['display_excerpt'];
        $read_more_text = $instance['read_more_text'];
        $description = $instance['description'];
        //$post_object = get_post($post_id);
        $page_query = new WP_Query( array( 'page_id'=>absint($post_id) ) ) ;

        // No need to do anything if 'post_id' field is empty
        while($page_query->have_posts()) {
            $page_query->the_post();

                echo $before_widget;
                ?>
                
			<div class="section-wrapper clearfix">
				<div class="container">
                    
					<div class="title-wrapper wow fadeInDown">
						<?php
                        if (!empty($display_title) && $display_title != 0) {
                            ?>
                            <h3 class="widget-title"> <?php the_title(); ?> </h3>
						      <div class="widget-desc"><?php echo esc_html($description); ?></div>
                              <?php } ?>
					</div>
					<div class="about-wrapper">
						<div class="about-us clearfix">
                            
							<div class=" about-text wow fadeInLeft">
                            <?php
                            if ($display_excerpt == 1): ?>
								<?php the_excerpt(); ?>

                                <?php endif;
                                if (!empty($read_more_text)): ?>
                                    <div class="widget-preview-more"><a class="cl-read-more" href="<?php the_permalink(); ?>"> <?php echo esc_html($read_more_text); ?></a></div> 
                                <?php
                                endif; ?>
							</div>
                            <?php
                            if ($display_thumbnail == 1 && has_post_thumbnail()): ?>
							<div class="about-image image-layout-one wow fadeInRight">
								<?php the_post_thumbnail('codepress-lite-who-we-are', array( 
            						'alt' => esc_attr(get_the_title()),
            						'title' => esc_attr(get_the_title()),
            					));  ?>
							</div>
                            <?php endif; ?>
						</div>	
					</div>
				</div>
			</div>	
		
                <?php
                echo $after_widget;
            
        }
        wp_reset_postdata();
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    codepress_lite_widgets_updated_field_value()       defined in widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$codepress_lite_widgets_name] = codepress_lite_widgets_updated_field_value($widget_field, $new_instance[$codepress_lite_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    codepress_lite_widgets_show_widget_field()     defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $codepress_lite_widgets_field_value = isset($instance[$codepress_lite_widgets_name]) ? esc_attr($instance[$codepress_lite_widgets_name]) : '';
            codepress_lite_widgets_show_widget_field($this, $widget_field, $codepress_lite_widgets_field_value);
        }
    }

}