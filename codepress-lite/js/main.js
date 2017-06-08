/** 

v0.0.1 
@CodeTrendy
@Package Codepress Lite 
*/

jQuery(document).ready(function($) { 
    
    //Submenu Dropdown Toggle
    if($('li.menu-item-has-children ul').length){
        $('.menu-item-has-children').append('<div class="cl_drop_menu"><i class="fa fa-plus"></i></div>');
        
        //Dropdown Button
        $('.cl_drop_menu').on('click', function() {
            $(this).prev('ul').slideToggle(500);
            if($(this).children('.fa').hasClass('fa-plus'))
            {
                $(this).children('.fa').removeClass('fa-plus');
                $(this).children('.fa').addClass('fa-minus');
            }
            else{
                $(this).children('.fa').removeClass('fa-minus');
                $(this).children('.fa').addClass('fa-plus');
            }
            
        });
        
        $(".main-navigation.toggled li.menu-item-has-children ul").hide(); 
        
        //Disable dropdown parent link
        // $('li.menu-item-has-children > a').on('click', function(e) {
        //     e.preventDefault();
        // });
    }



 
$('#secondary .codepress_lite_team .team-slider').owlCarousel({
    items: 1,
    // autoplay:true,  
    dots:false, 
    loop:true,
    nav:false,
    singleItem: true, 
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
   
}) 
 
$('.cl_footer_wrapper .codepress_lite_team .team-slider').owlCarousel({
    items: 1,
    // autoplay:true,  
    dots:false, 
    loop:true,
    nav:false,
    singleItem: true, 
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
   
})

  $('.team-slider').owlCarousel({
    items: 4,
    // autoplay:true,  
    dots:true, 
    loop:true,
    margin: 10,
    nav:false,
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        600:{
            items:4
        },
        1000:{
            items:4
        }
    }
})

$('#secondary .codepress_lite_clients .client-slider').owlCarousel({
    items: 1,
    // autoplay:true,  
    dots:false, 
    loop:true,
    nav:false,
    singleItem: true, 
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
   
})

$('.cl_footer_wrapper .codepress_lite_clients .client-slider').owlCarousel({
    items: 1,
    // autoplay:true,  
    dots:false, 
    loop:true,
    nav:false,
    singleItem: true, 
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
   
})

$('.widget-area .owl-carousel').owlCarousel({
    items: 1,
    // autoplay:true,  
    dots:false, 
    loop:true,
    nav:false, 
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    
})
  $('.client-slider').owlCarousel({
    items: 5,
    // autoplay:true,  
    dots:false, 
    loop:true,
    nav:false, 
    margin: 24,
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        600:{
            items:4
        },
        1000:{
            items:5
        }
    }
})


 $(window).scroll(function() {   
        if ($(this).scrollTop() > 1){         
        $('.site-header').addClass("sticky");   
        }   
        else{       
        $('.site-header').removeClass("sticky");   
    }});
    
var val = $('.cl-smooth-scrolling').val();
  
if( val == 'true' ) {
    
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            var target = $(this.hash);
            if (location.hostname == this.hostname) {
                if (target.length !=0) {
                    $('html,body').animate({
                        scrollTop: target.offset().top -50
                    }, 1000);
                    return false;
                }
            }
        });
    });  

}
  
  $(".cl_search_icon i").click(function() {
  $(".hidden_search_form").slideToggle("fast");
}); 


//wow
wow = new WOW({
    animateClass: 'animated',
    offset: 120
});
wow.init();  
    
});