jQuery(document).ready(function($){ 

//Responsive Menu
$(function() {
  $(".cc-trigger").click(function() {
    $(".cc-menu").slideToggle("fast");
  });
});   

//Submenu Dropdown Toggle
    if($('li.menu-item-has-children ul').length){
        $('li.menu-item-has-children').append('<div class="cl_drop_menu"><i class="fa fa-angle-down"></i></div>');
        
        //Dropdown Button
        $('.cl_drop_menu').on('click', function() {
            $(this).prev('ul').slideToggle(500);
            if($(this).children('.fa').hasClass('fa-angle-up'))
            {
                $(this).children('.fa').removeClass('fa-angle-up');
                $(this).children('.fa').addClass('fa-angle-down');
            }
            else{
                $(this).children('.fa').removeClass('fa-angle-down');
                $(this).children('.fa').addClass('fa-angle-up');
            }
            
        });
        
        // $(".main-navigation.toggled li.menu-item-has-children ul").hide(); 
        
        //Disable dropdown parent link
        
    }
/*
    // run test on initial page load
    checkSize();

    // run test on resize of the window
    $(window).resize(checkSize);
*/

//Function to the css rule
//function checkSize(){
    //if ($("div#cc-menu").css("display") == "none" ){
        //alert('test');
        // your code here
        //Stickybar
if($('.header').length){ 
 var stickyNavTop = $('.headersticky').offset().top;
 var stickyNav = function(){
 var scrollTop = $(window).scrollTop();
  if (scrollTop > stickyNavTop) {
         $('.headersticky').addClass('sticky');
          } else {
              $('.headersticky').removeClass('sticky');
          }
      };
      stickyNav(); 
      $(window).scroll(function() {
          stickyNav();
      });
  }
    //}
//}


  
//Search
$(function() {
  $(".search-icon").click(function() {
    $(".s-form").slideToggle("fast");
  });
}); 
 


 
//Banner Slider
$(".owl-carousel").owlCarousel({ 
    items:1, 
    loop:true,
    nav:true,
    dots:true, 
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"], 
    
}); 
 
 
// Testimonial Slider
$(".owl-testimonial").owlCarousel({
    items:1, 
    loop:true,
    nav:false,
    dots:true, 
    navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"], 
}); 

$(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('.scroll-top-wrapper').addClass("show");
    }
    else{
        $('.scroll-top-wrapper').removeClass("show");
    }
});
    $(".scroll-top-wrapper").on("click", function() {
     $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});
 

/** JS for search form */
 $('.search_submit i').click(function(){
       $( '.search-form' ).submit();
  });

 //wow
wow = new WOW({
    animateClass: 'animated',
    offset: 120
});
wow.init();  
  
 
});