// TABS
function tabsInit() {
    var tabs = jQuery('ul.tabs');
    tabs.each(function(i) {
        //Get all tabs
        var tab = jQuery(this).find('> li > a');
        tab.click(function(e) {

            //Get Location of tab's content
            var contentLocation = jQuery(this).attr('href');

            //Let go if not a hashed one
            if(contentLocation.charAt(0)=="#") {

                e.preventDefault();

                //Make Tab Active
                tab.removeClass('active');
                jQuery(this).addClass('active');

                //Show Tab Content & add active class
                jQuery(contentLocation).fadeIn().addClass('active').siblings().hide().removeClass('active');

            }
        });
    }); 
}

// Accordion

function accordionInit() {
  // Find Accordion List 
  jQuery('.accordion > li').each(function(i){
    var item=jQuery(this);
    // Hide Content 
    item.find('.accordion-content').slideUp(0);
    // On Click - Main Event
    item.find('.accordion-title').click(function(){
      var displ = item.find('.accordion-content').css('display');
      item.closest('ul').find('.accordion-title').each(function() {
        var li = jQuery(this).closest('li');
        li.find('.accordion-content').slideUp(300);
        jQuery(this).parent().removeClass("selected");
      });
      if (displ=="block") {
        item.find('.accordion-content').slideUp(300) 
        item.removeClass("selected");
      } else {
        item.find('.accordion-content').slideDown(300) 
        item.addClass("selected");
      }
    });
  });
  // Have one accordion already open 
  $('.accordion > li .selected').first().css("display", "block");
}

// Just good ole Toggles 
function ptoggles() {
  jQuery('.toggles > li').each(function(i){
    var photoggles=jQuery(this);
    photoggles.find('.toggle-content').slideUp(0);
    photoggles.find('.toggle-title').click(function(){
      var displ = photoggles.find('.toggle-content').css('display');
      if (displ=="block") {
        photoggles.find('.toggle-content').slideUp(300) 
      } else {
        photoggles.find('.toggle-content').slideDown(300) 
      }
    });
  });
}

// Poop

(function($) {
    var $window = $(window);

    $window.resize(function resize() {
        if ($window.width() < 514) {
            return $('.sidebar-stick').removeClass('-stick');
        }
          $('.sidebar-stick').addClass('-stick');


    }).trigger('resize');
})(jQuery);

// Responsive Navigation Menus
$(function() {
  var optrigger = $('.open-menu');
  menu          = $('#main-nav ul');
  menuHeight    = menu.height();

      $(optrigger).on('click', function(e) {
        e.preventDefault();
        menu.slideToggle();
      });

      $(window).resize(function(){
            var w = $(window).width();
            if(w > 320 && menu.is(':hidden')) {
              menu.removeAttr('style');
            }
        });
    });

// Smooth Scroll to the top 
function scrolltoTop(){
  $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
          $('.scrollup').fadeIn();
        } else {
          $('.scrollup').fadeOut();
        }
      }); 
      
      $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
}

// Full Height for DIV (To create full height cover design)


// Execute scripts on document ready
$(document).ready(function() {
    tabsInit();
    accordionInit();
    // Full Height
    function setHeight() {
    windowHeight = $(window).innerHeight();
    $('.viewport-height').css('height', windowHeight);
  };
    setHeight();
    $(window).resize(function() {
      setHeight();
    });
    // Immersion Backgrounds
  var introSlider = $('#intro-slider');
  introSlider.owlCarousel({
    items:1,
    loop:true,
    margin:0,
    nav:false,
    autoplay:true,
    autoplayTimeout:10000,
    autoplayHoverPause:false,
    responsive:false
  });
  $("#forward").click(function () {
    event.preventDefault();
    introSlider.trigger('next.owl.carousel');
  });
  $("#back").click(function () {
    event.preventDefault();
    introSlider.trigger('prev.owl.carousel');
  });

});