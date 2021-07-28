$(function () {
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
      } if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  function agecheck_init() {
    var agecheck = get_cookie(cookie_name);
    if(sessionStorage.getItem("pathurl_level") == '1'){
      sessionStorage.removeItem("pathurl");
    }else{
      sessionStorage.setItem("pathurl", document.location.pathname);
      sessionStorage.setItem("pathurl_level", '1');
    }
    
    if (agecheck == null && document.location.pathname != '/terms-and-conditions') {
      $(location).attr('href', '/age-gate');
    }
  }

  jQuery('#age-dd').on('change keypress keyup', function (e) {
    if(jQuery.isNumeric(e.target.value) == false){
      var y = e.target.value.replace(/[A-Za-z]/g, '');
      e.target.value = y
    }else{
      if ($(this).val().length == 2) {
        $("#age-mm").focus();
      }
    }
    
  });
  jQuery('#age-mm').on('change keypress keyup', function (e) {
    if(jQuery.isNumeric(e.target.value) == false){
      var y = e.target.value.replace(/[A-Za-z]/g, '');
      e.target.value = y
    }else{
      if ($(this).val().length == 2) {
        $("#age-yy").focus();
      }
    }
  });

  jQuery('#age-yy').on('change keypress keyup', function (e) {
    if(jQuery.isNumeric(e.target.value) == false){
      var y = e.target.value.replace(/[A-Za-z]/g, '');
      e.target.value = y
    }
  });

  /* Age Check Form Functions */
  function agecheck_validate() {
    $(".errors").removeClass('showerror');
    var cookie_value;
    var txt_dd = $("#age-dd").val();
    var txt_mm = $("#age-mm").val();
    var txt_yyyy = $("#age-yy").val();
    // Validate date range
    if (!is_valid_date(txt_dd, txt_mm, txt_yyyy)) {
      setErrorMsg("You are not old enough to enter this site.");//Please enter a valid date.
    } else {
      cookie_value = get_age(txt_dd, txt_mm, txt_yyyy);
      if (cookie_value < 21) {
        setErrorMsg("You are not old enough to enter this site.");
      } else {
        set_cookie(cookie_name, cookie_value, cookie_duration);
        if(sessionStorage.getItem("pathurl")){
          $(location).attr('href', sessionStorage.getItem("pathurl"));
        }else{
          $(location).attr('href', '/foxit');
        }
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
    if (now >= birthday) return now.getFullYear() - born.getFullYear(); else return now.getFullYear() - born.getFullYear() - 1;
  }

  // Return errors if any
  function setErrorMsg(errorMsg) {
    $(".errors").html(errorMsg).addClass('show-error-text');
    $(".agecheck").addClass('show-error-input');
  }

  $(document).ready(function () {
    // Check cookie
    if (!$('#agegatefrm').length) {
      // If this is not agegatefrm page
      agecheck_init();
    }
    // Age check form
    $("#agegatefrm").submit(function (e) {
      e.preventDefault();
      agecheck_validate();
    });
  });

});