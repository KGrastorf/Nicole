<?php

/*
*   This is the single post widget function 
*   @package codepress_corporate
*
*/


add_action('widgets_init', 'codepress_corporate_register_single_post_widget');

function codepress_corporate_register_single_post_widget() {
    register_widget('Codepress_corporate_single_post');
}

class Codepress_Corporate_Single_Post extends WP_Widget {



    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'codepress_corporate_single_post', esc_html__('&nbsp; Corporate - About Us', 'codepress-corporate'), array(
            'description' => esc_html__('About Us widget', 'codepress-corporate')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    public function widget_fields() { 
        $fields = array(
            // This widget has no title
            // Other fields
            'post_id' => array(
                'codepress_corporate_widgets_name' => 'post_id',
                'codepress_corporate_widgets_title' => esc_html__('Post', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'selectpost',
            ),
            'display_title' => array(
                'codepress_corporate_widgets_name' => 'display_title',
                'codepress_corporate_widgets_title' => esc_html__('Show post title', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'checkbox'
            ),
            'display_thumbnail' => array(
                'codepress_corporate_widgets_name' => 'display_thumbnail',
                'codepress_corporate_widgets_title' => esc_html__('Show featured image', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'checkbox'
            ),
            'display_excerpt' => array(
                'codepress_corporate_widgets_name' => 'display_excerpt',
                'codepress_corporate_widgets_title' => esc_html__('Show excerpt', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'checkbox'
            ),
            'read_more_text' => array(
                'codepress_corporate_widgets_name' => 'read_more_text',
                'codepress_corporate_widgets_title' => esc_html__('Read more link text', 'codepress-corporate'),
                'codepress_corporate_pro_widgets_description' => esc_html__('Leave empty for no link', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'text'
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

        $post_id = $instance['post_id'];
        $display_title = $instance['display_title'];
        $display_thumbnail = $instance['display_thumbnail'];
        $display_excerpt = $instance['display_excerpt'];
        $read_more_text = $instance['read_more_text'];

        $page_query = new WP_Query(array('p'=>absint($post_id)));
           //No need to do anything if 'post_id' field is empty
        while($page_query->have_posts()) {  $page_query->the_post();

                echo $before_widget;
                ?>
              <!--   <div class="footer-block"> -->
                        
                     
                            <?php if (isset($display_title) ) : ?> 
                                <h2>  <?php the_title(); ?></h2> 
                            <?php endif; 
                                if ($display_thumbnail && has_post_thumbnail()):
                            ?>
                                <div class="widget-preview-thumbnail"> <?php the_post_thumbnail('medium-thumbnail'); ?> </div>
                            <?php 
                                endif;
                                if ($display_excerpt):
                                     codepress_corporate_add_excerpt_length( apply_filters( 'codepress_corporate_aboutUs_excerpt_length', 40 ) );
                                        the_excerpt();
                                        codepress_corporate_remove_excerpt_length();
                                    ?> 
                                
                            <?php 
                                endif;
                                if ($read_more_text):
                                ?>
                                <div class="widget-preview-more"><a class="read-more ap-bttn" href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo esc_html($read_more_text); ?></a></div>
                                <?php
                                endif;
                            ?>
                        
                <!--     </div> -->
                    
                <?php
                echo $after_widget;
            }
            wp_reset_postdata();
        }


    /*

     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    codepress_corporate_widgets_updated_field_value()       defined in widget-fields.php
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
            $instance[$codepress_corporate_widgets_name] = codepress_corporate_widgets_updated_field_value($widget_field, $new_instance[$codepress_corporate_widgets_name]);
        }

        return $instance;
    }

    /*
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    codepress_corporate_widgets_show_widget_field()     defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) { 

            // Make array elements available as variables
            extract($widget_field);
            $codepress_corporate_widgets_field_value = isset($instance[$codepress_corporate_widgets_name]) ? esc_attr($instance[$codepress_corporate_widgets_name]) : '';
            codepress_corporate_widgets_show_widget_field($this, $widget_field, $codepress_corporate_widgets_field_value);
        }
    }



}