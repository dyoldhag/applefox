(function ($) {
  $(function () {
    $('a[href*="#"]:not([href="#"])').click(function () {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top - 15
          }, 1000);
          return false;
        }
      }
    });
    if (window.location.hash) {
      var target = window.location.hash;
      if (target.length && $(target).length) {
        $('html, body').animate({
          scrollTop: target.offset().top - 15
        }, 1000);
      }
    }

    $(".bar").click(function () {
      if ($('.collapsed').length) {
        $('.bar').addClass('animate');
        $('html').addClass('overflow-hidden');
      } else {
        $('.bar').removeClass('animate');
        $('html').removeClass('overflow-hidden');
      }
    });

    $(document).click(function (e) {
      if (!$(e.target).is('.bar , .navbar-collapse')) {
        if ($('.collapsed').length) {} else {
          $('.bar').trigger("click");
        }
      }
    });

    if (navigator.platform == 'MacIntel') {
      jQuery('body').addClass('MacIntel');
    }
  });

  $(window).load(function () {

    var $_adminBar = $('#wpadminbar'),
        $_body = $('body'),
        $_wrapper = $('#wrapper'),
        $_window = $(this),
        isHomePage = $_body.hasClass('home'),
        bodyInitTop = $_adminBar.length > 0 ? $_adminBar.outerHeight() : 0,
        currentScrollTop = 0;

    function init() {
      disableClick();
      contactFormHook();
    }
    init();

    function isIe() {
      var pattern = /Trident\/[0-9]+\.[0-9]+/;

      return pattern.test(navigator.userAgent);
    }

    function isEdge() {
      var pattern = /Edge\/[0-9]+\.[0-9]+/;

      return pattern.test(navigator.userAgent);
    }

    function disableClick() {
      $('.noclick').on('click', function () {
        return false;
      });
    }

    function contactFormHook() {
      if ($('.wpcf7').length < 1) return false;

      var wpcf7Elm = document.querySelector('.wpcf7');

      wpcf7Elm.addEventListener('wpcf7invalid', function (event) {
        $('.wpcf7 .wpcf7-not-valid').eq(0).focus();
      }, false);
    }

    function scrollToPosition(pos, second) {
      $('html, body').animate({
        scrollTop: pos
      }, second * 1000);
    }

    $(window).resize(function () {

      // Resize

    });

    /* Check for Age Cookie */
    var cookie_name = "applefox_age";
    var cookie_duration = 1;

    function set_cookie(cookie_name, cookie_value, lifespan_in_days, valid_domain) {
      var domain_string = valid_domain ? "; domain=" + valid_domain : '';
      document.cookie = cookie_name + "=" + encodeURIComponent(cookie_value) + "; max-age=" + 60 * 60 * 24 * lifespan_in_days + "; path=/" + domain_string;
    }

    function get_cookie(cookie_name) {
      var nameEQ = cookie_name + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1, c.length);
        }if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
    }

    function agecheck_init() {
      var agecheck = get_cookie(cookie_name);
      if (agecheck == null && document.location.pathname != '/terms-conditions.html') {
        $(location).attr('href', '/agegate.html');
      }
    }

    jQuery('#age-dd').on('change keypress keyup', function (e) {
      if ($(this).val().length == 2) {
        $("#age-mm").focus();
      }
    });
    jQuery('#age-mm').on('change keypress keyup', function (e) {
      if ($(this).val().length == 2) {
        $("#age-yy").focus();
      }
    });

    /* Age Check Form Functions */
    function agecheck_validate() {
      $(".errors").hide();
      var cookie_value;
      var txt_dd = $("#age-dd").val();
      var txt_mm = $("#age-mm").val();
      var txt_yyyy = $("#age-yy").val();
      // Validate date range
      if (!is_valid_date(txt_dd, txt_mm, txt_yyyy)) {
        setErrorMsg("Please enter a valid date.");
      } else {
        cookie_value = get_age(txt_dd, txt_mm, txt_yyyy);
        if (cookie_value < 21) {
          setErrorMsg("You must be 21 and above to view this site.");
        } else {
          // if ($('#age-box').is(':checked')) {

          // Everything is good. Set cookie
          set_cookie(cookie_name, cookie_value, cookie_duration);

          // Redirect to previous page or index page
          // var referrer = document.referrer;
          // if (referrer) {
          //     $(location).attr('href', referrer);
          // } else {
          //     $(location).attr('href', '/');
          // }
          $(location).attr('href', '/');
          // } else {
          //     setErrorMsg("Please tick the checkbox.");
          // }
        }
      }
    }

    function is_valid_date(ddlDay, ddlMonth, ddlYear) {
      if (ddlDay != '' && ddlMonth != '' && ddlYear != '') {
        var date = new Date(ddlYear + "-" + ddlMonth + "-" + ddlDay);
        var inputDate = ddlYear + "-" + (ddlMonth - 1) + "-" + ddlDay;
        var parsedDate = date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate();
        // date is invalid
        if (date == "Invalid Date") {
          return false;
        }
        // date is valid
        return true;
      } else {
        return false;
      }
    }

    function get_age(ddlDay, ddlMonth, ddlYear) {
      var now = new Date();
      var born = new Date(ddlYear, ddlMonth - 1, ddlDay);
      var birthday = new Date(now.getFullYear(), born.getMonth(), born.getDate());
      if (now >= birthday) return now.getFullYear() - born.getFullYear();else return now.getFullYear() - born.getFullYear() - 1;
    }

    // Return errors if any
    function setErrorMsg(errorMsg) {
      $(".errors").html(errorMsg).show();
    }

    $(document).ready(function () {
      // Check cookie
      if (!$('#agegate').length) {
        // If this is not agegate page
        agecheck_init();
      }
      // Age check form
      $("#agegate").submit(function (e) {
        e.preventDefault();
        agecheck_validate();
      });
    });
    /* END Check for Age Cookie */
  });
})(jQuery);