<?php 

 add_action( 'add_meta_boxes', 'codepress_corporate_add_custom_box' );
/**
 * Add Meta Boxes.
 */
function codepress_corporate_add_custom_box() {
    // Adding layout meta box for page
    add_meta_box( 
        'page-layout',
         esc_html__( 'Select Layout', 'codepress-corporate' ),
        'codepress_corporate_page_layout',
        'page',
        'normal',
        'default' );
   }

/****************************************************************************************/

global $codepress_corporate_page_layout;
$allowed_html = codepress_corporate_expanded_alowed_tags();
$codepress_corporate_page_layout = array(
                           
            'left-sidebar'          => array(
                                            'id'            => 'codepress_corporate_page_layout',
                                            'value'         => 'right-content',
                                            'label'         => esc_html__( 'Left Sidebar', 'codepress-corporate' ),
                                            'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'
                                            ),
    
            'right-sidebar'        => array(
                                            'id'            => 'codepress_corporate_page_layout',
                                            'value'         => 'left-content',
                                            'label'         => codepress_corporate_textarea_saniize( 'Right sidebar<br>(default)', array('br') ),
                                            'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
                                            ),
            'no-sidebar-content-centered' => array(
                                            'id'            => 'codepress_corporate_page_layout',
                                            'value'         => 'content-middle-area',
                                            'label'         => esc_html__( 'Both Sidebar', 'codepress-corporate' ),
                                            'thumbnail' => get_template_directory_uri() . '/images/both-sidebar.png'
                                            ),
            'no-sidebar-full-width' => array(
                                            'id'            => 'codepress_corporate_page_layout',
                                            'value'         => 'content-full-area',
                                            'label'         => esc_html__( 'Full Width', 'codepress-corporate' ),
                                            'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png'
                                            )
            
        );

/************************************************************************************************************************************/

/**
 * Displays metabox to for select layout option
 */
function codepress_corporate_page_layout() {
    global $codepress_corporate_page_layout, $post;

    // Use nonce for verification
    wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );
    ?>

    <table class="form-table">
    <tr>
    <td colspan="4"><em class="f13"><?php esc_html_e('Choose Sidebar Template', 'codepress-corporate' )?></em></td>
    </tr>

    <tr>
    <td>
<?php 
    foreach ($codepress_corporate_page_layout as $field) { 
        $layout_meta = get_post_meta( $post->ID, $field['id'], true );
        
        if( empty( $layout_meta ) ) { $layout_meta = 'left-content'; }
        ?>
            <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr($field['label']); ?>" /></span></br>
                <input class="" type="radio" name="<?php echo esc_attr($field['id']); ?>" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], $layout_meta ); if(empty($layout_meta) && $field['value'] == 'left-content'){ checked('left-content','left-content'); } ?>&nbsp;<?php echo esc_attr($field['label']); ?>
                
                </label>
            </div>
        <?php
    }
    ?>
    </td></tr>
    </table>
    <?php 
}

/******************************************************************************************************************************/

add_action('pre_post_update', 'codepress_corporate_save_custom_meta');
/**
 * save the custom metabox data
 * @hooked to pre_post_update hook
 */
function codepress_corporate_save_custom_meta( $post_id ) {
    global $codepress_corporate_page_layout, $post;

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
      return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) 
      return;

    if ('page' == $_POST['post_type']) { 
      if (!current_user_can( 'edit_page', $post_id ) ) 
         return $post_id; 
   }
   elseif (!current_user_can( 'edit_post', $post_id ) ) { 
      return $post_id;
   }

    foreach ($codepress_corporate_page_layout as $field) {
        //Execute this saving function
        $old = get_post_meta( $post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}

?>