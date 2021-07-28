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
      $('.bar').removeClass('collapsed');
    }else{
      $('.bar').removeClass('animate');
      $('html').removeClass('overflow-hidden');
      $('.bar').addClass('collapsed');
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


  ///////////////////////////ANSWER///////////////////////////
  function incrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).data('field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
  
    if (!isNaN(currentVal)) {
      parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
    } else {
      parent.find('input[name=' + fieldName + ']').val(0);
    }
  }
  
  function decrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).data('field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
  
    if (!isNaN(currentVal) && currentVal > 0) {
      parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
    } else {
      parent.find('input[name=' + fieldName + ']').val(0);
    }
  }
  
  $('.input-group').on('click', '.button-plus', function(e) {
    incrementValue(e);
  });
  
  $('.input-group').on('click', '.button-minus', function(e) {
    decrementValue(e);
  });  
  ///////////////////////////END-ANSWER///////////////////////////
});
