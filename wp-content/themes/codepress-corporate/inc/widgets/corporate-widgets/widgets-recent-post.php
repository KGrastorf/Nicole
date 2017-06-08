<?php
/**
 * Adds codepress_corporate_recent_post  widget.
 *
 * @package codepress_corporate 
 */

        function codepress_corporate_recent_post_widget_registration() {
        
          register_widget('Codepress_Corporate_Recent_Posts_CC');
        }
        add_action('widgets_init', 'codepress_corporate_recent_post_widget_registration');



class Codepress_Corporate_Recent_Posts_CC extends WP_Widget {

    public function __construct() {
        $widget_ops = array(

            'classname' => 'widget_recent_entries',
            'description' => esc_html__( 'Your site&#8217;s most recent Posts.', 'codepress-corporate') );
        
        parent::__construct('widget_recent_entries', esc_html__('&nbsp; Corporate - Recent Posts', 'codepress-corporate'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';
    }

    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'codepress-corporate' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? $instance['number'] : 5;
        if ( ! $number )
            $number = 5;

        
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => absint($number),
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );

            if ($r->have_posts()) :
        ?>
    
        <?php echo $args['before_widget']; ?>
        
       <section id="recent-posts-2" class="widget widget_recent_entries">
            <?php if ( $title ) : ?>
               <?php echo $args['before_title'] . esc_html($title) . $args['after_title']; ?>
           <?php endif; ?>
            <ul>
        
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            
                <?php
                global $post;
                ?>


                <li>
                    <div class="recent-post wow fadeInUp">
                    <?php 
                    if ( has_post_thumbnail()) : ?>
                        <div class="post-img">

                            <?php 

                            the_post_thumbnail('thumbnail', array( 
                            'alt' => esc_attr(get_the_title()),
                            'title' => esc_attr(get_the_title()), 
                            'style' => 'width:82px; height:72px;' 
                            )); ?>
                            
                        </div>
                        
                        <?php endif; ?>
                        
                        <div class="post-dtl">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <ul>
                            <?php
                                $i=1;
                                    $posttags = get_the_tags();
                                    if ($posttags) {
                                      foreach($posttags as $tag) { ?>
                                      <li><a href="<?php echo esc_url(site_url() . '/tag/'. $tag->slug); ?>"><i class="fa fa-tags"></i> <?php  echo esc_html($tag->name . ' '); ?></a></li>
                                <?php
                                    if( $i++ == 3 ) break;
                                      }
                                    }                               
                                ?> 
                            </ul> 
                            
                        </div>
                    </div> 
                </li>
            
        <?php endwhile; ?>
        

        <?php echo $args['after_widget']; ?>
    </ul>
    </section>
    

        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;
    }


    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = absint($new_instance['number']);
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? $new_instance['show_date'] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ?  $instance['title']  : '';
        $number    = isset( $instance['number'] ) ?  $instance['number']  : 5;        
?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'codepress-corporate' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'codepress-corporate' ); ?></label>
        <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo absint($number); ?>" size="3" /></p>

<?php
    }
}