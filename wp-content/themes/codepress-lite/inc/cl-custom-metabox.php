<?php
/** 
 * Page/Post Sidebar Layout metabox
 * 
 * author @CodeTrendy
 * since version 0.0.3 
 *
 *
 * @package Codepress Lite
 */
add_action('add_meta_boxes', 'codepress_lite_add_sidebar_layout_box');
function codepress_lite_add_sidebar_layout_box()
{
    
     add_meta_box(
                 'codepress_lite_sidebar_layout', // $id
                 'Sidebar Layout', // $title
                 'codepress_lite_sidebar_layout_callback', // $callback
                 'post', // $page
                 'normal', // $context
                 'high'); // $priority
    
    
    add_meta_box(
                 'codepress_lite_sidebar_layout', // $id
                 'Sidebar Layout', // $title
                 'codepress_lite_sidebar_layout_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority
   
                 
}
$codepress_lite_sidebar_layout = array(
        'left-sidebar' => array(
                        'value'     => 'left-sidebar',
                        'label'     => esc_html__( 'Left sidebar', 'codepress-lite' ),
                        'thumbnail' => esc_url(CODEPRESS_LITE_ADMIN_IMAGES_URL . '/left-sidebar.png')
                    ), 
        'right-sidebar' => array(
                        'value' => 'right-sidebar',
                        'label' => esc_html__( 'Right sidebar (default)', 'codepress-lite' ),
                        'thumbnail' => esc_url(CODEPRESS_LITE_ADMIN_IMAGES_URL . '/right-sidebar.png')
                    ),
        
        'both-sidebar' => array(
                        'value'     => 'both-sidebar',
                        'label'     => esc_html__( 'Both sidebar', 'codepress-lite' ),
                        'thumbnail' => esc_url(CODEPRESS_LITE_ADMIN_IMAGES_URL . '/both-sidebar.png')
                    ),   
                    
       
        'no-sidebar' => array(
                        'value'     => 'no-sidebar',
                        'label'     => esc_html__( 'No sidebar', 'codepress-lite' ),
                        'thumbnail' => esc_url(CODEPRESS_LITE_ADMIN_IMAGES_URL . '/no-sidebar.png')
                    )   
                    
                        

    );
    

function codepress_lite_sidebar_layout_callback()
{ 
global $post , $codepress_lite_sidebar_layout;
wp_nonce_field( basename( __FILE__ ), 'codepress_lite_sidebar_layout_nonce' ); 
?>

<table class="form-table">
<tr>
<td colspan="4"><em class="f13"><?php _e('Choose Sidebar Template', 'codepress-lite')?></em></td>
</tr>

<tr>
<td>
<?php  
   foreach ($codepress_lite_sidebar_layout as $field) {  
                $codepress_lite_sidebar_metalayout = get_post_meta( $post->ID, 'codepress_lite_sidebar_layout', true ); ?>

                <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
                <input type="radio" name="codepress_lite_sidebar_layout" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], $codepress_lite_sidebar_metalayout ); if(empty($codepress_lite_sidebar_metalayout) && $field['value']=='right-sidebar'){ checked('right-sidebar','right-sidebar'); } ?>/>&nbsp;<?php echo esc_attr($field['label']); ?>
                </label>
                </div>
                <?php } // end foreach 
                ?>
                <div class="clear"></div>
</td>
</tr>
<tr>
    <td><em class="f13"><?php printf( __('You can set up the sidebar content %1$s', 'codepress-lite'), '<a href="'. admin_url('/widgets.php') .'" target="_blank">'. esc_html__('Here', 'codepress-lite') .'</a>' ) ?> </em></td>
</tr>
</table>

<?php } 

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function codepress_lite_save_sidebar_layout( $post_id ) { 
    global $codepress_lite_sidebar_layout, $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'codepress_lite_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'codepress_lite_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
    

    foreach ($codepress_lite_sidebar_layout as $field) {  
        //Execute this saving function
        $codepress_lite_old = get_post_meta( $post_id, 'codepress_lite_sidebar_layout', true); 
        $codepress_lite_new = sanitize_text_field($_POST['codepress_lite_sidebar_layout']);
        if ($codepress_lite_new && $codepress_lite_new != $codepress_lite_old) {  
            update_post_meta($post_id, 'codepress_lite_sidebar_layout', $codepress_lite_new);  
        } elseif ('' == $codepress_lite_new && $codepress_lite_old) {  
            delete_post_meta($post_id,'codepress_lite_sidebar_layout', $codepress_lite_old);  
        } 
     } // end foreach   
     
}
add_action('save_post', 'codepress_lite_save_sidebar_layout');