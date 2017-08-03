$(document).ready(function() {
 
  $("#owl-slider-olive").owlCarousel({
 
      navigation : true, // Show next and prev buttons
      slideSpeed : 1000,
      paginationSpeed : 2000,
      singleItem:true,
        navigationText: ["<i class='fa fa-angle-double-left' aria-hidden='true'></i>","<i class='fa fa-angle-double-right' aria-hidden='true'></i>"],
      autoPlay : true,
    stopOnHover : true
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });
 
});

$(document).ready(function() {
 
  var owl = $("#top-rated-owl");
 
  owl.owlCarousel({
      items : 3, //10 items above 1000px browser width
      itemsDesktop : [1000,5], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
      slideSpeed : 1000,
      autoPlay : true,
    stopOnHover : true,
      navigation : false
  });
 
  // Custom Navigation Events
  $(".next").click(function(){
    owl.trigger('owl.next');
  })
  $(".prev").click(function(){
    owl.trigger('owl.prev');
  })
 
});

$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );
});

	$('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
        pickerPosition: "top-left"
    });

jQuery(function($) {
$(window).on('scroll', function(){
		if( $(window).scrollTop()>200 ){
			$('nav.om-nav').addClass('navbar-fixed-top');
		} else {
			$('nav.om-nav').removeClass('navbar-fixed-top');
		}
	});
$('#about-section').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
		if (visible) {
			$(this).find('.timer').each(function () {
				var $this = $(this);
				$({ Counter: 0 }).animate({ Counter: $this.text() }, {
					duration: 2000,
					easing: 'swing',
					step: function () {
						$this.text(Math.ceil(this.Counter));
					}
				});
			});
			$(this).unbind('inview');
		}
	});
});