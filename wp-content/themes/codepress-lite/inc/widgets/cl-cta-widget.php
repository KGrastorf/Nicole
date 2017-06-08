<?php

/**
 * Call to Action Widget
 *
 * @package Codepress Lite since 0.0.3
 */
/**
 * Adds Codepress Lite Call to Action widget.
 */
add_action('widgets_init', 'codepress_lite_register_callto_action_widget');

function codepress_lite_register_callto_action_widget() {
    register_widget('codepress_lite_callto_action');
}

class codepress_lite_callto_action extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
     
    public function __construct() {
        $widget_ops = array( 
			'classname' => 'widget-call-to-action-post clearfix', 
			'description' => __('Call to action. Best for Home Page Sidebar', 'codepress-lite') 
		);
        parent::__construct(
            'codepress_lite_callto_action', esc_html__('&nbsp;CL : Call to action', 'codepress-lite'),
            $widget_ops
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $style = array(
            'style1' => __('Style 1', 'codepress-lite'), 
            'style2' => __('Style 2', 'codepress-lite'),
            );
        $fields = array(
            // This widget has no title
            // Other fields
            'callto_action_image' => array(
                'codepress_lite_widgets_name' => 'callto_action_image',
                'codepress_lite_widgets_title' => __('Background Image', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'upload',
            ),
            'callto_action_title' => array(
                'codepress_lite_widgets_name' => 'callto_action_title',
                'codepress_lite_widgets_title' => __('Title', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'text',
            ),
            'callto_action_content' => array(
                'codepress_lite_widgets_name' => 'callto_action_content',
                'codepress_lite_widgets_title' => __('Content', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'textarea',
                'codepress_lite_widgets_row' => '6'
            ),
            'callto_action_readmore' => array(
                'codepress_lite_widgets_name' => 'callto_action_readmore',
                'codepress_lite_widgets_title' => __('Read More Text', 'codepress-lite'),
                 'codepress_lite_widgets_desc' => __('Leave Empty not to show', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'text',
            ),
            'callto_action_readmore_link' => array(
                'codepress_lite_widgets_name' => 'callto_action_readmore_link',
                'codepress_lite_widgets_title' => __('Read More Link', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'url',
            ),
            'callto_action_style' => array(
                'codepress_lite_widgets_name' => 'callto_action_style',
                'codepress_lite_widgets_title' => __('Style', 'codepress-lite'),
                'codepress_lite_widgets_field_type' => 'select',
                'codepress_lite_widgets_field_options' => $style
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

        $callto_action_title = $instance['callto_action_title'];
        $callto_action_content = $instance['callto_action_content'];
        $callto_action_readmore = $instance['callto_action_readmore'];
        $callto_action_readmore_link = $instance['callto_action_readmore_link'];
        $callto_action_style = $instance['callto_action_style'];
        $callto_action_image = $instance['callto_action_image']; 

        echo $before_widget; ?>
        
            <?php if($callto_action_style == 'style1'): ?>
            
			<div class="section-wrapper" <?php if(!empty($callto_action_image)){ ?>style="background-image: url('<?php echo esc_url($callto_action_image); ?>');" <?php } ?>> 
				<div class="parallax-overlay"></div>
				<div class="container">
					<div class="cta-wrapper">
                    <?php if(!empty($callto_action_title)): ?>
                    
						<h3 class="cta-title wow fadeInDown"><?php echo esc_textarea($callto_action_title); ?></h3>
                        
                    <?php endif; 
                    if(!empty($callto_action_content)):
                    ?>
						<div class="entry-content wow zoomIn"><?php echo codepress_lite_html_text_validate($callto_action_content); ?></div>
                    
                    <?php endif; 
                    if(!empty($callto_action_readmore)):
                    ?>
						<a href="<?php echo esc_url($callto_action_readmore_link); ?>" class="cta-readmore wow fadeInUp"><?php echo esc_html($callto_action_readmore); ?></a>
                        
                    <?php endif; ?>
					</div>
				</div>
			</div>
            
            <?php endif; 
            //no-background Great <span class="green">Experiece </span><span class="golden">Awesome Creativity</span> starts with us, you will <span class="red">THANK</span> us later
            if($callto_action_style == 'style2'):
            ?>
            
            
			<div class="section-wrapper no-background wow zoomIn"> 
				<div class="container">
					<div class="cta-wrapper">
						<div class="cta-desc wow fadeInDown">
							<?php echo codepress_lite_html_text_validate($callto_action_content); ?>
						</div>
						<div class="cta-btn-wrapper wow fadeInDown"><a href="<?php echo esc_url($callto_action_readmore_link); ?>" class="cta-readmore"><?php echo esc_html($callto_action_readmore); ?></a>	</div>
					</div>
				</div>
			</div>
		  <?php endif; ?>
		
        <?php 
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	codepress_lite_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
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
     * @param	array $instance Previously saved values from database.
     *
     * @uses	codepress_lite_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $codepress_lite_widgets_field_value = !empty($instance[$codepress_lite_widgets_name]) ? esc_attr($instance[$codepress_lite_widgets_name]) : '';
            codepress_lite_widgets_show_widget_field($this, $widget_field, $codepress_lite_widgets_field_value);
        }
    }

}
