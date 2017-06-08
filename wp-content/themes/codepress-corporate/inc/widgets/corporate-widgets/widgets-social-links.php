<?php
/**
 * social lik  footer widget
 *
 * @package codepress_corporate 
 */

add_action('widgets_init', 'codepress_corporate_contact_social_link_widget');

function codepress_corporate_contact_social_link_widget() {
    register_widget('codepress_corporate_social_link');
}

class Codepress_Corporate_Social_Link extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'codepress_corporate_social_link', esc_html__('&nbsp; Corporate - Social Link', 'codepress-corporate'), array(
            'description' => esc_html__('Displays social media links', 'codepress-corporate')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(

            'socila_facebook' => array(
                'codepress_corporate_widgets_name' => 'socila_facebook',
                'codepress_corporate_widgets_title' => esc_html__('Facebook', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'url',
                'codepress_corporate_widgets_row' => '4'
            ),

            'socila_twitter' => array(
                'codepress_corporate_widgets_name' => 'socila_twitter',
                'codepress_corporate_widgets_title' => esc_html__('Twitter', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'url',
            ),

            'socila_google_plus' => array(
                'codepress_corporate_widgets_name' => 'socila_google_plus',
                'codepress_corporate_widgets_title' => esc_html__('Google Plus', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'url',
            ),
            
            'socila_instagram' => array(
                'codepress_corporate_widgets_name' => 'socila_instagram',
                'codepress_corporate_widgets_title' => esc_html__('Instagram', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'url',
            ),
            
            'social_youtube' => array(
                'codepress_corporate_widgets_name' => 'social_youtube',
                'codepress_corporate_widgets_title' => esc_html__('YouTube', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'url',
                'codepress_corporate_widgets_row' => '3'
            ),

            'social_pinterest' => array(
                'codepress_corporate_widgets_name' => 'social_pinterest',
                'codepress_corporate_widgets_title' => esc_html__('Pinterest', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'url',
                'codepress_corporate_widgets_row' => '3'
            ),

            'social_rss' => array(
                'codepress_corporate_widgets_name' => 'social_rss',
                'codepress_corporate_widgets_title' => esc_html__('RSS Feed', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'url',
                'codepress_corporate_widgets_row' => '3'
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

        $socila_facebook = $instance['socila_facebook'];
        $socila_twitter = $instance['socila_twitter'];
        $socila_google_plus = $instance['socila_google_plus'];
        $socila_instagram = $instance['socila_instagram'];
        $social_youtube = $instance['social_youtube'];
        $social_pinterest = $instance['social_pinterest'];
        $social_rss = $instance['social_rss'];
        

        echo $before_widget;
        ?>

            <ul class="footer-social wow zoomIn">
                <?php if (!empty($socila_facebook)): ?>
                    <li><a href="<?php echo esc_url($socila_facebook); ?>" target= "_blank"><i class="fa fa-facebook"></i></a></li>
                <?php endif; ?>

                <?php if (!empty($socila_twitter)): ?>
                    <li><a href="<?php echo esc_url($socila_twitter); ?>" target= "_blank"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>

                <?php if (!empty($socila_google_plus)): ?>
                    <li><a href="<?php echo esc_url($socila_google_plus); ?>" target= "_blank"><i class="fa fa-google-plus"></i></a></li>
                <?php endif; ?>

                <?php if (!empty($socila_instagram)): ?>
                    <li><a href="<?php echo esc_url($socila_instagram); ?>" target= "_blank"><i class="fa fa-instagram"></i></a></li>
                <?php endif; ?>

                <?php if (!empty($social_pinterest)): ?>
                    <li><a href="<?php echo esc_url($social_pinterest); ?>" target= "_blank"><i class="fa fa-pinterest"></i></a></li>
                    <?php endif; ?>

                <?php if (!empty($social_rss)): ?>
                    <li><a href="<?php echo esc_url($social_rss); ?>" target= "_blank"><i class="fa fa-rss"></i></a></li>
                    <?php endif; ?>

           </ul>
      <!--   </div> -->
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    codepress_corporate_widgets_updated_field_value()     defined in widget-fields.php
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

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    codepress_corporate_widgets_show_widget_field()       defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $codepress_corporate_widgets_field_value = !empty($instance[$codepress_corporate_widgets_name]) ? esc_attr($instance[$codepress_corporate_widgets_name]) : '';
            codepress_corporate_widgets_show_widget_field($this, $widget_field, $codepress_corporate_widgets_field_value);
        }
    }

}