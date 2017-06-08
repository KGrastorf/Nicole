<?php
/**
 * The template for displaying meta box in page/post
 *
 * This adds Layout Options, Select Sidebar, Header Freatured Image Options, Single Page/Post Image Layout
 * This is only for the design purpose and not used to save any content
 *
 * @package Catch Themes
 * @subpackage Parallax Frame
 * @since Parallax Frame 0.1
 */

/**
 * Class to Add, Render and save metabox options
 *
 * @since Parallax Frame 0.1
 */
class parallax_frame_meta_box {
	private $meta_box;

	private $fields;

	/**
	* Constructor
	*
	* @since Parallax Frame 0.1
	*
	* @access public
	*
	*/
	public function __construct( $meta_box_id, $meta_box_title, $post_type ) {

		$this->meta_box = array (
			'id'        => $meta_box_id,
			'title'     => $meta_box_title,
			'post_type' => $post_type,
		);

		$this->fields = array(
			'parallax-frame-layout-option',
			'parallax-frame-header-image',
			'parallax-frame-sidebar-options',
			'parallax-frame-featured-image',
		);


		// Add metaboxes
		add_action( 'add_meta_boxes', array( $this, 'add' ) );

		add_action( 'save_post', array( $this, 'save' ) );
   	}

	/**
	* Add Meta Box for multiple post types.
	*
	* @since parallaxframe 1.
	*
	* @access public
	*/
	public function add($postType) {
		if ( in_array( $postType, $this->meta_box['post_type'] ) ) {
			add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $postType );
		}
	}

	/**
	* Renders metabox
	*
	* @since Parallax Frame 0.1
	*
	* @access public
	*/
	public function show() {
		global $post;

		$layout_options			= parallax_frame_metabox_layouts();
		$featured_image_options	= parallax_frame_metabox_featured_image_options();
		$header_image_options 	= parallax_frame_metabox_header_featured_image_options();


	    // Use nonce for verification
	    wp_nonce_field( basename( __FILE__ ), 'parallax_frame_custom_meta_box_nonce' );

	    // Begin the field table and loop  ?>
	    <div id="parallax-frame-ui-tabs" class="ui-tabs">
		    <ul class="parallax-frame-ui-tabs-nav" id="parallax-frame-ui-tabs-nav">
		    	<li><a href="#frag1"><?php esc_html_e( 'Layout Options', 'parallax-frame' ); ?></a></li>
		    	<li><a href="#frag3"><?php esc_html_e( 'Header Featured Image Options', 'parallax-frame' ); ?></a></li>
		    	<li><a href="#frag4"><?php esc_html_e( 'Single Page/Post Image Layout ', 'parallax-frame' ); ?></a></li>
		    </ul>
		    <div id="frag1" class="catch_ad_tabhead">
		    	<table id="layout-options" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                    <select name="parallax-frame-layout-option" id="custom_element_grid_class">
		      					<?php
								$metalayout = get_post_meta( $post->ID, 'parallax-frame-layout-option', true );

								if ( empty( $metalayout ) ){
									$metalayout = 'default';
								}

			                    foreach ( $layout_options as $field ) {
			                   	?>
			                   	<option value="<?php echo esc_attr( $field['value'] ); ?>" <?php selected( $metalayout, $field['value'] ); ?>><?php echo esc_html( $field['label'] ); ?></option>
		    					<?php
		    					} // end foreach
			                    ?>
		                    </select>
		                </tr>
		            </tbody>
		        </table>
		    </div>

	    	<div id="frag3" class="catch_ad_tabhead">
		    	<table id="header-image-metabox" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                    <?php
							 	$metaheader = get_post_meta( $post->ID, 'parallax-frame-header-image', true );

		                        if ( empty( $metaheader ) ){
		                            $metaheader='default';
		                        }
								?>

	                        <td width="20%">
	                        	<label class="description"><?php esc_html_e( 'Header Image Option', 'parallax-frame' ) ?>
	                            </label>
	                        </td>

	                        <td>
	                            <select name="parallax-frame-header-image">
	                                <?php
	                                foreach ( $header_image_options as $field ) {
	                        		?>
	                                <option value="<?php echo esc_attr( $field['value'] ); ?>" <?php selected( $metaheader, $field['value'] ); ?>><?php echo esc_html( $field['label'] ); ?></option>
	                              	<?php }//end foreach ?>
	                            </select>
	                        </td>
		                </tr>
		            </tbody>
		        </table>
		    </div>

		    <div id="frag4" class="catch_ad_tabhead">
		    	<table id="featured-image-metabox" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                     <select name="parallax-frame-featured-image" id="custom_element_grid_class">
			                     <?php
									$metaimage = get_post_meta( $post->ID, 'parallax-frame-featured-image', true );

									if ( empty( $metaimage ) ){
										$metaimage = 'default';
									}

				                    foreach ( $featured_image_options as $field ) {
				                   	?>
				                   <option value="<?php echo esc_attr( $field['value'] ); ?>" <?php selected( $metaimage, $field['value'] ); ?>><?php echo esc_html( $field['label'] ); ?></option>
			    					<?php
			    					} // end foreach
			                    ?>
			                </select>
		                </tr>
		            </tbody>
		        </table>
		    </div>
		</div>
	<?php
	}

	/**
	 * Save custom metabox data
	 *
	 * @action save_post
	 *
	 * @since Parallax Frame 0.1
	 *
	 * @access public
	 */
	public function save( $post_id ) {
		global $post_type;

		$post_type_object = get_post_type_object( $post_type );

	    if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
	    || ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
	    || ( ! in_array( $post_type, $this->meta_box['post_type'] ) )                  // Check if current post type is supported.
	    || ( ! check_admin_referer( basename( __FILE__ ), 'parallax_frame_custom_meta_box_nonce') )    // Check nonce - Security
	    || ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )  // Check permission
	    {
	      return $post_id;
	    }

	    foreach ( $this->fields as $field ) {
			$new = $_POST[ $field ];

			if ( '' == $new || array() == $new ) {
				continue;
			}
			else {
				if ( ! update_post_meta ( $post_id, $field, sanitize_key ( $new ) ) ) {
					add_post_meta( $post_id, $field, sanitize_key ( $new ), true );
				}
			}
		} // end foreach
	}
}

$parallax_frame_metabox = new parallax_frame_meta_box(
	'parallax-frame-options', 					//metabox id
	esc_html__( 'Parallax Frame Options', 'parallax-frame' ), //metabox title
	array( 'page', 'post' )				//metabox post types
);