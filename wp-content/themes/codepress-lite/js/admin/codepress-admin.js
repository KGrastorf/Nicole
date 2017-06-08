jQuery(document).ready(function($) {

   $(document).on('click', '.codepress_lite-font-group li', function(){
	   	   var test = $(this).parents('#codepress_lite-font-awesome-list').attr('class');
           //alert(test);
           $('.codepress_lite-font-group li').removeClass();
	    $(this).addClass('selected');
	    var aa = $(this).parents('#codepress_lite-font-awesome-list').find('.codepress_lite-font-group li.selected').children('i').attr('class');
    	$(this).parents('#codepress_lite-font-awesome-list').siblings('p').find('.hidden-icon-input_'+test).val(aa);
    	$(this).parents('#codepress_lite-font-awesome-list').siblings('p').find('.icon-receiver_'+test).html('<i class="'+aa+'"></i>');
	    return false;
   });
    $('#upload-btn').click(function(){
		$('#optionsframework form').attr('action','');
	});
});


jQuery(document).ready(function($){

	var codepress_lite_upload;
	var codepress_lite_selector;

	function codepress_lite_widget_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		codepress_lite_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( codepress_lite_upload ) {
			codepress_lite_upload.open();
		} else {
			// Create the media frame.
			codepress_lite_upload = wp.media.frames.codepress_lite_upload =  wp.media({
				// Set the title of the modal.
				title: $el.data('choose'),

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: $el.data('update'),
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			codepress_lite_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = codepress_lite_upload.state().get('selection').first();
				codepress_lite_upload.close();
				codepress_lite_selector.find('.upload').val(attachment.attributes.url);
				if ( attachment.attributes.type == 'image' ) {
					codepress_lite_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '" width="100%"><a class="remove-image">Remove</a>').slideDown('fast');
				}
				codepress_lite_selector.find('.upload-button-widget').unbind().addClass('remove-file-widget').removeClass('upload-button-widget').val(codepress_lite_widget_l10n.remove);
				codepress_lite_selector.find('.of-background-properties').slideDown();
				codepress_lite_selector.find('.remove-image, .remove-file-widget').on('click', function() {
					codepress_lite_widget_remove_file( $(this).parents('.section') );
				});
			});

		}

		// Finally, open the modal.
		codepress_lite_upload.open();
	}

	function codepress_lite_widget_remove_file(selector) {
		selector.find('.remove-image').hide();
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file-widget').unbind().addClass('upload-button-widget').removeClass('remove-file-widget').val(codepress_lite_widget_l10n.upload);
		// We don't display the upload button if .upload-notice is present
		// This means the user doesn't have the WordPress 3.5 Media Library Support
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.upload-button-widget').remove();
		}
		selector.find('.upload-button-widget').on('click', function(event) {
			codepress_lite_widget_add_file(event, $(this).parents('.sub-option'));
		});
	}
    $(document).on('click', '.remove-image, .remove-file-widget' , function() {
		codepress_lite_widget_remove_file( $(this).parents('.sub-option') );
    });

    $(document).on('click','.upload-button-widget', function( event ) {
    	codepress_lite_widget_add_file(event, $(this).parents('.sub-option'));
    });

});
