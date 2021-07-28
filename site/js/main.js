/* Cookie Functions */
var cookie_name = "applefox_age";
var cookie_duration = 1;

function set_cookie ( cookie_name, cookie_value, lifespan_in_days, valid_domain ) {
    var domain_string = valid_domain ?
                       ("; domain=" + valid_domain) : '' ;
    document.cookie = cookie_name +
                       "=" + encodeURIComponent( cookie_value ) +
                       "; max-age=" + 60 * 60 *
                       24 * lifespan_in_days +
                       "; path=/" + domain_string ;
}
function get_cookie ( cookie_name ) {
	var nameEQ = cookie_name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;

}

/* Check for Age Cookie */
function agecheck_init() {
	var agecheck = get_cookie(cookie_name);
	if (agecheck == null) {
		// Redirect to Age Check
		var hturl = window.location.href;
		hturl.substr(0, hturl.lastIndexOf("/"));
		console.log("showing url")
		console.log(hturl);
		//window.location.href = 'agegate.html';
		//$(location).attr('href', 'http://applefox.com/main/agegate.html');
		$(location).attr('href', hturl+'agegate.html');
	}
}

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
			if ($('#age-box').is(':checked')) {

				// Everything is good. Set cookie
				set_cookie( cookie_name, cookie_value, cookie_duration );

				// Redirect to previous page or index page
				var referrer =  document.referrer;
				if (referrer) {
					$(location).attr('href', referrer);
				} else {
					$(location).attr('href', 'http://applefox.com/main/');
				}
			} else {
				setErrorMsg("Please tick the checkbox.");
			}
		}
	}

}
function is_valid_date(ddlDay, ddlMonth, ddlYear) {
    var date = new Date(ddlYear + "-" + (ddlMonth) + "-" + ddlDay);
	console.log(date);
    var inputDate = ddlYear + "-" + (ddlMonth - 1) + "-" + ddlDay;
    var parsedDate = date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate();

	// date is invalid
    if (date == "Invalid Date") {
        return false;
    }

    // date is valid
    return true;
}
function get_age(ddlDay, ddlMonth, ddlYear) {
	var now = new Date();
    var born = new Date(ddlYear, ddlMonth - 1, ddlDay);
	var birthday = new Date(now.getFullYear(), born.getMonth(), born.getDate());
	if (now >= birthday)
		return now.getFullYear() - born.getFullYear();
	else
		return now.getFullYear() - born.getFullYear() - 1;
}

// Return errors if any
function setErrorMsg(errorMsg) {
	$(".errors").html(errorMsg).show();
}

$(document).ready(function() {

	// Check cookie
	if (!$('#agegate').length) { // If this is not agegate page
		agecheck_init();
	}

	// Age check form
	$("#agegate").submit(function(e) {
		e.preventDefault();

		agecheck_validate();
	});

});