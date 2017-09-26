
$(document).ready(function(){
    
      //enabling smooth scrooling on the sections
  $("#menus a, #down").on('click', function(event) {

      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 500, function(){
     
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        });
      } // End if
  });
   
    $(window).scroll(function () {

      // console.log($(window).scrollTop());
        if ($(this).scrollTop() < 50) {
            $('header').removeClass('sticky');
        } else {
            $('header').addClass('sticky');
        }
        
    });
    

    // menu overlay 
   
      $(window).load(function(){
        

       $('.menu-item').hover(function(){

        $(this).find('.caption').slideDown(400);
        }, function(){
            $(this).find('.caption').slideUp(400);
        });

      });

   

    // smoothscroll to top
        $( "#goTop" ).hide();
   
        $( window ).scroll( function () {
            if ( $( this ).scrollTop() > 100 ) {
                $( '#goTop' ).fadeIn();
            } else {
                $( '#goTop' ).fadeOut();
            }
        });

        // scroll body to 0px on click
        $( '#goTop a' ).click( function () {
            $( 'body,html' ).animate( {
                scrollTop: 0
            }, 800 );
            return false;
        });
  
   //navbar collapes for mobile 
   
    $('.navbar-collapse a').on('click',function(){
        $(".navbar-collapse").collapse('hide');
     });

        $(window).on('scroll', function() {
          if ($(".navbar").offset().top > 100) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
              } else {
                $(".navbar-fixed-top").removeClass("top-nav-collapse");
              }
        }); 

        // cart section script
        // $('.cart-wrapper').hide();
      $('.cart-icon').on('click', function () {
        
          $('.cart-wrapper').show();
          if ($(window).width() > 768) {
            $('#cart-section').addClass('wow animated slideInRight');
          }


      });

      $('.back').on('click', function () {
          
         $('.cart-wrapper').hide();
      
      });


});

