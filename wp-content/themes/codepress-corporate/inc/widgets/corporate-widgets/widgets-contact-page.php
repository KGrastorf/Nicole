<?php
/**
 * ContactPage widget
 *
 * @package codepress_corporate 
 */


	// Register and load the widget
	function codepress_corporate_contact_widgets() {
	    register_widget( 'codepress_corporate_contact_widget' );
	}
	add_action( 'widgets_init', 'codepress_corporate_contact_widgets' );

// Creating the widget
	class Codepress_corporate_contact_widget extends WP_Widget {
	 
	function __construct() {
		parent::__construct(
			'codepress_corporate_contact_widgets', // Base ID
			esc_html__('&nbsp; Corporate - Contact', 'codepress-corporate'), // Widget Name
			array(
				'contactpage' => 'codepress_corporate_contact_widget',
				'description' => esc_html__('Corporate Contact widgets.','codepress-corporate'),
			),
			array(
				'width' => 200,
			)
		);
		
	 }
	
	public function widget( $args, $instance ) {

	
	$address = $instance[ 'address' ];
	$phone = $instance[ 'phone' ];
	$email = $instance[ 'email' ];
	$skype = $instance[ 'skype' ];
	 
	echo $args['before_widget']; ?>

		<div class="contact-all-info">
			<div class="contact-single wow zoomIn">
				<i class="fa fa-map-marker"></i>
				<?php if(!empty( $address)) { ?>
					<h4><?php echo esc_html($address); ?></h4>
				<?php } ?>	
			</div>
			<div class="contact-single wow zoomIn">
					<i class="fa fa-phone"></i>
				<?php if(!empty( $phone )) { ?>
				 	<h4><?php echo esc_html($phone); ?></h4>
				 <?php }  ?>
			</div>

            <div class="clearfix"></div>
			<div class="contact-single wow zoomIn">
					<i class="fa fa-envelope-o"></i>
				<?php if(!empty( $email )) { ?>
				  	<h4><?php echo antispambot($email); ?></h4>
				<?php } ?>
			</div>
			<div class="contact-single wow zoomIn">
					<i class="fa fa-skype"></i>
				<?php if(!empty( $skype )) { ?>
					<h4><?php echo esc_html($skype); ?></h4>
				<?php }  ?>	
			</div>
		</div>
 
	<?php
	echo $args['after_widget'];
	}
	         
// Widget Backend

	public function form( $instance ) {

//Address
	if ( isset( $instance[ 'address' ])){
	$address = $instance[ 'address' ];
	}
	else {
	$address = '';
	}



//Phone
	if ( isset( $instance[ 'phone' ])){
	$phone = $instance[ 'phone' ];
	}
	else {
	$phone = '';
	}

	

//Email
	if ( isset( $instance[ 'email' ])){
	$email = $instance[ 'email' ];
	}
	else {
	$email = '';
	}


//skype
	if ( isset( $instance[ 'skype' ])){
	$skype = $instance[ 'skype' ];
	}
	else {
	$skype = '';
	}

	
	?>
	

	<h4 for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e( 'Address:','codepress-corporate' ); ?></h4>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />


	<h4 for="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>"><?php esc_html_e( 'Phone:','codepress-corporate' ); ?></h4>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />


	<h4 for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>"><?php echo antispambot( 'Email:','codepress-corporate' ); ?></h4>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />

	
	<h4 for="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>"><?php esc_html_e( 'Skype:','codepress-corporate' ); ?></h4>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype' )); ?>" type="text" value="<?php echo esc_attr( $skype ); ?>" />

	
	<?php
    }
	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
	
	$instance = array();
	
		$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? esc_attr( $new_instance['phone'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? esc_attr( $new_instance['address'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? esc_attr( $new_instance['email'] ) : '';
		$instance['skype'] = ( ! empty( $new_instance['skype'] ) ) ? esc_attr( $new_instance['skype'] ) : '';
		
		return $instance;
	}
	}
	?>