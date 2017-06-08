<?php
/**
 * Contact Info Widget
 *
 * @package codepress_corporate 
 */
add_action('widgets_init', 'codepress_corporate_register_contact_info_widget');

function codepress_corporate_register_contact_info_widget() {
    register_widget('codepress_corporate_contact_info');
}

class Codepress_Corporate_Contact_Info extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'codepress_corporate_contact_info', esc_html__('&nbsp; Corporate - Contact Info', 'codepress-corporate'), array(
            'description' => esc_html__('Displays Contact Info', 'codepress-corporate')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'contact_info_title' => array(
                'codepress_corporate_widgets_name' => 'contact_info_title',
                'codepress_corporate_widgets_title' => esc_html__('Title', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'text',
            ),

            'contact_info_address' => array(
                'codepress_corporate_widgets_name' => 'contact_info_address',
                'codepress_corporate_widgets_title' => esc_html__('Contact Address', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'textarea',
                'codepress_corporate_widgets_row' => '4'
            ),

            'contact_info_email' => array(
                'codepress_corporate_widgets_name' => 'contact_info_email',
                'codepress_corporate_widgets_title' => esc_html__('Email', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'text',
            ),

            'contact_info_phone' => array(
                'codepress_corporate_widgets_name' => 'contact_info_phone',
                'codepress_corporate_widgets_title' => esc_html__('Phone', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'text',
            ),

            
            'contact_info_skype' => array(
                'codepress_corporate_widgets_name' => 'contact_info_skype',
                'codepress_corporate_widgets_title' => esc_html__('Skype', 'codepress-corporate'),
                'codepress_corporate_widgets_field_type' => 'text',
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

        $contact_info_title = $instance['contact_info_title'];
        $contact_info_address = $instance['contact_info_address'];
        $contact_info_email = $instance['contact_info_email'];
        $contact_info_phone = $instance['contact_info_phone'];
        $contact_info_skype = $instance['contact_info_skype'];

       // echo $before_widget;
        ?>
        <!-- <div class="ap-contact-info"> -->
         <!-- <div class="footer-block"> -->
            <?php
                if (!empty($contact_info_title)): ?>
                    <?php  echo $before_title . esc_html($contact_info_title) . $after_title; ?> 
            <?php 
            endif;
            ?>

                <?php if (!empty($contact_info_address)): ?>
                    <div class="footer-info wow zoomIn">
                        <i class="fa fa-map-marker"></i> 
                        <div class="info"> 
                        <p><?php echo esc_html($contact_info_address); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                 <?php if (!empty($contact_info_email)): ?>
                    <div class="footer-info wow zoomIn">
                        <i class="fa fa-envelope"></i>
                        <div class="info">
                        <p><?php echo antispambot($contact_info_email); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="clearfix"></div>
                <?php if (!empty($contact_info_phone)): ?>
                    <div class="footer-info wow zoomIn">
                        <i class="fa fa-phone"></i>
                        <div class="info">
                        <p><?php echo esc_html($contact_info_phone); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
  
                <?php if (!empty($contact_info_skype)): ?>
                    <div class="footer-info wow zoomIn">
                        <i class="fa fa-skype"></i>
                        <div class="info">
                        <p><?php echo esc_html($contact_info_skype); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

       <!--  </div> -->
        
        <?php
       // echo $after_widget;
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