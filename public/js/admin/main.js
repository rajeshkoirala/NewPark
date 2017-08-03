// Sidebar Toggle
$(document).ready(function(){
    $('.sidebar-toggle').click(function(){
        $('#wrapper').toggleClass('sidebar-hidden');

        if($('#wrapper').hasClass('sidebar-hidden')){
            $('#wrapper').removeClass('push-left');
          } else {
            $('#wrapper').addClass('push-left');
          }
        return false;
    });
});


$(function(){
    // Hide sidebar in mobile And Tablet
    var hideSidebar = function(){
      var browserWidth = $(window).width();
      if(browserWidth <= 992){
        $('#wrapper').addClass('sidebar-hidden');
      } else {
        $('#wrapper').removeClass('sidebar-hidden');
      }
    } // end hidesidebar

    // Refresh window width while browser resize
    setInterval(function(){
      $(window).resize(function(){
        hideSidebar();
      });
    }, 200);

    hideSidebar();

    // Scroll to fixed
    $('.header-topbar').scrollToFixed();
});