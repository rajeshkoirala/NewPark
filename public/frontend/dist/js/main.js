jQuery(document).ready(function($){
	var MqL = 1200;
	moveNavigation();
	$(window).on('resize', function(){
		(!window.requestAnimationFrame) ? setTimeout(moveNavigation, 300) : window.requestAnimationFrame(moveNavigation);
	});

	//mobile - open lateral menu clicking on the menu icon
	$('.om-nav-trigger').on('click', function(event){
		event.preventDefault();
		if( $('.om-main-content').hasClass('nav-is-visible') ) {
			closeNav();
			$('.om-overlay').removeClass('is-visible');
		} else {
			$(this).addClass('nav-is-visible');
			$('.om-primary-nav').addClass('nav-is-visible');
			$('.om-main-header').addClass('nav-is-visible');
			$('.om-main-content').addClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').addClass('overflow-hidden');
			});
			toggleSearch('close');
			$('.om-overlay').addClass('is-visible');
            
            if($(window).width() < 1199){
            $(this).hide();
            $('.om-search-trigger').hide();
            /*$('.om-header-buttons .cart').hide();*/
            $('body').addClass('body-fixed');
            $('ul.is-hidden').removeClass('custom-scroll');
                }
		}
	});

	//open search form
	$('.om-search-trigger').on('click', function(event){
		event.preventDefault();
		toggleSearch();
		closeNav();
	});

	//close lateral menu on mobile 
	/*$('.om-overlay').on('swiperight', function(){
		if($('.om-primary-nav').hasClass('nav-is-visible')) {
			closeNav();
			$('.om-overlay').removeClass('is-visible');
		}
	});
	$('.nav-on-left .om-overlay').on('swipeleft', function(){
		if($('.om-primary-nav').hasClass('nav-is-visible')) {
			closeNav();
			$('.om-overlay').removeClass('is-visible');
		}
	});*/
	$('.om-overlay').on('click', function(){
		closeNav();
		toggleSearch('close')
		$('.om-overlay').removeClass('is-visible');

         if($(window).width() < 1199){
        $('.om-nav-trigger').show();
        $('.om-search-trigger').show();
        $('.om-header-buttons .cart').show();
        $('body').removeClass('body-fixed');
         }
        /*if($(window).width() > 480 ){
            $('.om-header-buttons .cart').hide();
        }*/
	});


	//prevent default clicking on direct children of .om-primary-nav 
	$('.om-primary-nav').children('.has-children').children('a').on('click', function(event){
		event.preventDefault();
	});
	//open submenu
	$('.has-children').children('a').on('click', function(event){
		if( !checkWindowWidth() ) event.preventDefault();
		var selected = $(this);
		if( selected.next('ul').hasClass('is-hidden') ) {
			//desktop version only
			selected.addClass('selected').next('ul').removeClass('is-hidden').end().parent('.has-children').parent('ul').addClass('moves-out');
			selected.parent('.has-children').siblings('.has-children').children('ul').addClass('is-hidden').end().children('a').removeClass('selected');
			$('.om-overlay').addClass('is-visible');
			
            
		} else {
			selected.removeClass('selected').next('ul').addClass('is-hidden').end().parent('.has-children').parent('ul').removeClass('moves-out');
			$('.om-overlay').removeClass('is-visible');
		}
		toggleSearch('close');
	});

	//submenu items - go back link
	$('.go-back').on('click', function(){
		$(this).parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('moves-out');
	});

	function closeNav() {
		$('.om-nav-trigger').removeClass('nav-is-visible');
		$('.om-main-header').removeClass('nav-is-visible');
		$('.om-primary-nav').removeClass('nav-is-visible');
		$('.has-children ul').addClass('is-hidden');
		$('.has-children a').removeClass('selected');
		$('.moves-out').removeClass('moves-out');
		$('.om-main-content').removeClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$('body').removeClass('overflow-hidden');
		});
	}

	function toggleSearch(type) {
		if(type=="close") {
			//close serach 
			$('.om-search').removeClass('is-visible');
			$('.om-search-trigger').removeClass('search-is-visible');
			$('.om-overlay').removeClass('search-is-visible');
			$('body').removeClass('body-fixed');
            
		} else {
			//toggle search visibility
			$('.om-search').toggleClass('is-visible');
			$('.om-search-trigger').toggleClass('search-is-visible');
			$('.om-overlay').toggleClass('search-is-visible');
			if($(window).width() > MqL && $('.om-search').hasClass('is-visible')) $('.om-search').find('input[type="search"]').focus();
			($('.om-search').hasClass('is-visible')) ? $('.om-overlay').addClass('is-visible') : $('.om-overlay').removeClass('is-visible') ;
		}
	}

	function checkWindowWidth() {
		//check window width (scrollbar included)
		var e = window, 
            a = 'inner';
        if (!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        if ( e[ a+'Width' ] >= MqL ) {
			return true;
		} else {
			return false;
		}
	}

	function moveNavigation(){
		var navigation = $('.om-nav');
  		var desktop = checkWindowWidth();
        if ( desktop ) {
			navigation.detach();
			navigation.insertBefore('.om-header-buttons');
		} else {
			navigation.detach();
			navigation.insertAfter('.om-main-content');
		}
	}
    $('.has-children, .om-search-trigger').on('click',function(){
        $('header').toggleClass('sub-menu-active');
//        if(!$('header').hasClass('top-nav-collapse')){
//            $('header').css({
//                "background-color": '#000'
//            }); 
//        }
    })
});





/*
 jQuery placeholderTypewriter 
 */
(function ($) {
  "use strict";

  $.fn.placeholderTypewriter = function (options) {

    // Plugin Settings
    var settings = $.extend({
      delay: 50,
      pause: 1000,
      text: []
    }, options);

    // Type given string in placeholder
    function typeString($target, index, cursorPosition, callback) {

      // Get text
      var text = settings.text[index];

      // Get placeholder, type next character
      var placeholder = $target.attr('placeholder');
      $target.attr('placeholder', placeholder + text[cursorPosition]);

      // Type next character
      if (cursorPosition < text.length - 1) {
        setTimeout(function () {
          typeString($target, index, cursorPosition + 1, callback);
        }, settings.delay);
        return true;
      }

      // Callback if animation is finished
      callback();
    }

    // Delete string in placeholder
    function deleteString($target, callback) {

      // Get placeholder
      var placeholder = $target.attr('placeholder');
      var length = placeholder.length;

      // Delete last character
      $target.attr('placeholder', placeholder.substr(0, length - 1));

      // Delete next character
      if (length > 1) {
        setTimeout(function () {
          deleteString($target, callback)
        }, settings.delay);
        return true;
      }

      // Callback if animation is finished
      callback();
    }

    // Loop typing animation
    function loopTyping($target, index) {

      // Clear Placeholder
      $target.attr('placeholder', '');

      // Type string
      typeString($target, index, 0, function () {

        // Pause before deleting string
        setTimeout(function () {

          // Delete string
          deleteString($target, function () {
            // Start loop over
            loopTyping($target, (index + 1) % settings.text.length)
          })

        }, settings.pause);
      })

    }

    // Run placeholderTypewriter on every given field
    return this.each(function () {

      loopTyping($(this), 0);
    });

  };

}(jQuery));





(function ($) {
	"use strict";
    
    var $window = $(window),
            $body = $('body');
    
    /*=============================
                Sticky header
        ==============================*/
        $('.navbar-collapse a').on('click',function(){
          $(".navbar-collapse").collapse('hide');
        });

      /*  $window.on('scroll', function() {
          if ($(".navbar").offset().top > 100) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
              } else {
                $(".navbar-fixed-top").removeClass("top-nav-collapse");
              }
        });*/
    
     /*=============================
                Smoothscroll js
        ==============================*/
        $(function() {
          $('.custom-navbar a, a.scroll-btn').on('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 0
            }, 1000);
            event.preventDefault();
          });
        });  
            
        
        
        
    /*======================================
        jquery scroll spy
    ========================================*/
        $body.scrollspy({
        
            target : ".navbar-collapse",
            offset : 95
        
        });
        
        
     /*=================================
            Bootstrap menu fix
     ==================================*/
        $(".navbar-toggle").on("click", function(){
        
            $body.addClass("mobile-menu-activated");
        
        });
        
        $("ul.nav.navbar-nav li a").on("click", function(){
        
            $(".navbar-collapse").removeClass("in");
        
        });
    
    
    })(jQuery);



$( '.om-search-trigger').click(function() {
  $( "body" ).toggleClass( "body-fixed" );
});


