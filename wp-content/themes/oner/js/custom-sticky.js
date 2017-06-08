(function($){
	// Sticky Header Options 

	$(window).scroll(function() {
			if(screen.width > 780 ) {
		        $('.site-header').addClass("sticky-nav");
		       	$('.home .site-content').css("top",($('.site-header').height() -2 ) );
		       	$('.breadcrumb').css("top",($('.site-header').height() -2 ) );
		       	$('.breadcrumb').css("margin-bottom",($('.site-header').height() -2 ) );
		        $('.site-footer').css("margin-top",($('.site-header').height() -2 ) );  
	        }
        }); 

})(jQuery); 