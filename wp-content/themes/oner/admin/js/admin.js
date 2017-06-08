(function( $ ) {


		support = $('<a class="oner-docs doc btn-free-for-pro"></a>')
				.attr('href','https://www.webulousthemes.com/theme/oner-pro/')
				.attr('target','_blank')
				.text('Upgrade to Pro -$39');

        $('.preview-notice').append(support);
		

		$('.oner-docs').on('click',function(e){
			e.stopPropagation();
		})


})( jQuery );
