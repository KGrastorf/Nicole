(function($){

	$(function(){
        if( $.fn.flexslider ) {
		    $('.flexslider').flexslider();   
            $('.testimonial-container').flexslider({          
                controlNav: false,
                directionNav: true
            });
            $('.client-wrapper').flexslider({
                animation: "slide",
                animationLoop: true,
                itemWidth: 350,
                controlNav: false,
                directionNav: false,
                itemMargin: 0
            });
        }
	});


})(jQuery);


// jQuery powered scroll to top

jQuery(document).ready(function(){

    //Check to see if the window is top if not then display button
    jQuery(window).scroll(function(){ 
        if (jQuery(this).scrollTop() > 100) {
            jQuery('.scroll-to-top').fadeIn();
        } else {
            jQuery('.scroll-to-top').fadeOut();  
        }
    });

    //Click event to scroll to top
    jQuery('.scroll-to-top').click(function(){
        jQuery('html, body').animate({scrollTop : 0},800);
        return false;  
    });
    

});