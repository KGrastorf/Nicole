<?php
/**
 * Blog widget
 *
 * @package Codepress Lite Since 0.0.3
 */

add_action('widgets_init', 'codepress_lite_blog_widget_register');

function codepress_lite_blog_widget_register() {
    register_widget('codepress_lite_blog');
}


class Codepress_lite_blog extends WP_Widget {
    
	function __construct() {
		$widget_ops = array( 
			'classname' => 'codepress_lite_blog widget-blog-post clearfix', 
			'description' => __('Best for Home Page', 'codepress-lite') 
		);
		
		parent::__construct('codepress_lite_blog',  esc_html__('&nbsp;CL - Blog Widget', 'codepress-lite'), $widget_ops);
	}
	
    function widget($args, $instance) {
		extract($args);
		$category = isset($instance['category']) ? $instance['category'] : '';
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $description = apply_filters('widget_title', empty($instance['description']) ? '' : $instance['description'], $instance, $this->id_base);
        
		
        
        
        $queryArgs = array( 
			'posts_per_page' => 3, 
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
					<div class="title-wrapper wow fadeInDown">
                    <?php if(!empty($title)): ?>
						<h2 class="widget-title"><?php echo esc_html($title); ?></h2>
                    <?php endif;
                        if(!empty($description)):
                     ?>
						<div class="widget-desc">
							<?php echo codepress_lite_html_text_validate($description); ?>
						</div>
                    <?php endif; ?>
					</div>
					<div class="col-wrapper clearfix">
						
           
        			<?php
        			
                    while ($lt->have_posts()) : $lt->the_post();
                    
                        ?>
                        
                        <div class="col-3 wow fadeInUp">
							<div class="cp-blog-wrapper">
								<div class="post-slide">
									<div class="post-img">
                                        <?php if(has_post_thumbnail()): ?>
										<a href="<?php the_permalink(); ?>">
                                            <?php
                                            the_post_thumbnail('codepress-lite-blog-thumb', array( 
                            						'alt' => esc_attr(get_the_title()), 
                            						'title' => esc_attr(get_the_title()), 
                                                    ));
                                             ?>
                                        </a>
                                        <?php endif; ?>
									</div>
									<div class="post-content">
										<div class="post-on">
											<span><?php echo esc_html( get_the_date( 'j M' ) );?></span>
											
										</div>
										<div class="auther-title-wrap">
										<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="auther"><span><?php _e('by', 'codepress-lite'); ?> </span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></div>
										</div>
											<div class="post-meta">
												<ul class="post-bar">
												<li class="comments"><i class="fa fa-comments-o"></i><?php comments_popup_link( '0', '1', '%', '', '-' ); ?></li>
													
                                                    
													<li><i class="fa fa-folder-open"></i><?php codepress_lite_category(1); ?></li>
                                                    
												</ul>
											</div>
										<div class="post-description">
                                            <?php codepress_lite_add_excerpt_length( apply_filters( 'codepress_lite_blog_excerpt_length', 20 ) );
                    					the_excerpt();
                    					codepress_lite_remove_excerpt_length();
                                            ?>
                                        </div>
										<a class="button" href="<?php the_permalink(); ?>"><?php echo __('We are Available', 'codepress-lite'); ?></a>
									</div>
								</div>
							</div>
						</div>
						
                       <?php
        			endwhile;
        			?>
                    
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
        $instance['description'] = codepress_lite_html_text_validate($new_instance['description']);
		$instance['category'] = absint($new_instance['category']);
        
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
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
        
        
        <?php
    }
}