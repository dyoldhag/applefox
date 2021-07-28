$(function () {
  $('a[href*="#"]:not([href="#"])').click(function() {
    var href = $(this).attr("href"),
        offsetTop = href === "#" ? 0 : $(href).offset().top;
    $('html, body').stop().animate({ 
        scrollTop: offsetTop
    }, 1000);
    e.preventDefault();
  });

  
  function getOperatingSystem() {
    if($(window).width() > 767){
      var OSName="";
      if (navigator.appVersion.indexOf("Win")!=-1) {OSName="Windows";}
      else if (navigator.appVersion.indexOf("Mac")!=-1) {
        if(navigator.vendor == 'Google Inc.'){
          OSName="Linux";
        }else{
          OSName="MacOS";
        }
      }
      else if (navigator.appVersion.indexOf("X11")!=-1) {OSName="UNIX";}
      else if (navigator.appVersion.indexOf("Linux")!=-1) {OSName="Linux";}
      return OSName;
    }else{
      var userAgent = navigator.userAgent || navigator.vendor || window.opera || navigator.platform;  
      if( userAgent.match( /iPad/i ) || userAgent.match( /iPhone/i ) || userAgent.match( /iPod/i ) )
      {
        return 'iOS';
      }
      else if( userAgent.match( /Android/i ) )
      {
        return 'Android';
      }
      else
      {
        return ''; 
      }
    }
    
  }
  
  $('body').removeClass('iOS').removeClass('Android').removeClass('Windows').removeClass('MacOS').removeClass('UNIX').removeClass('Linux');
  $('body').addClass(getOperatingSystem());
  $(window).resize(function () {
    $('body').removeClass('iOS').removeClass('Android').removeClass('Windows').removeClass('MacOS').removeClass('UNIX').removeClass('Linux');
    $('body').addClass(getOperatingSystem());
    // alert($( window ).width() +"x"+$( window ).height());
  });

  $( ".bar" ).click(function() {     
    if($('.collapsed').length){
      $('.bar').addClass('animate');
      $('html').addClass('overflow-hidden');
    }else{
      $('.bar').removeClass('animate');
      $('html').removeClass('overflow-hidden');
    }
  });

  $(document).click(function(e) {
    if (!$(e.target).is('.bar , .navbar-collapse')) {
      if($('.collapsed').length){
        
      }else{
        $('.bar').trigger( "click" );
      }
    }
  });
});
