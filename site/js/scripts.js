/**
 * Handle toggling the navigation menu for small screens.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};
} )();


( function( $ ) {
	/**
	 * Google Analytics
	 * Note: the WP Yoast GA plugin replaced ga() with __gaTracker()
	 **/
	OT.GA_API = {};
	
	OT.GA_API.sendEvent = function( category, action, label ) {
		//console.log( category, action, label );
		if( typeof __gaTracker == 'function' ) {
			__gaTracker( 'send', 'event', category, action, label );
		}
	};
	
	// Validate email addresses
	$.fn.validateEmail = function(sEmail){	
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if( filter.test(sEmail) )
			return true;
		else
			return false;
	}

	// Feature detection
	var testVideoTag = document.createElement('video'),
		testCanvasTag = document.createElement('canvas'),
		isCanvasSupported = ( testCanvasTag.getContext ) ? true : false,
		isMP4Supported = ( typeof testVideoTag.canPlayType == 'undefined' || testVideoTag.canPlayType == '') ? false : true;


	// Browser detection
	var isMobile = OT.isMobile,
		//isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent || navigator.vendor || window.opera),
		isLteIE9 = $('html').hasClass('ie9') || $('html').hasClass('ie8');
		/*isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)
		isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    isIE     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;*/
	
	// Redeem closing time
	OT.before12 = function() {
    var d = new Date();
		if( d.getHours() > 23 && d.getHours() < 12 )
			return true;
    else if( d.getHours() == 23 && d.getMinutes() > 30 )
			return true;
		else
			return false;
	};
	OT.before12Msg = 'Sorry, pints can only be redeemed after 12pm. Please try again later.';
	
	/* Initialise variables */
	var throttleTimer,
		winWidth,
		winHeight,
		sklr;
		
	/* Fix jQuery CORS for IE9/8 */
	if( isLteIE9 )
		$.support.cors = true;
	

	checkResponsive();



	

	function checkTimeForLaunch() {
		var diff = ( new Date("2017/08/11 00:00:00") - new Date() ) / 1000;	
		console.log(diff);
		var days = parseInt(diff/60/60/24);
		console.log(days);
		var hours = parseInt((diff - (days*24*60*60))/60/60);
		var minutes = parseInt((diff - (days*24*60*60 + hours*60*60))/60);
		var seconds = parseInt((diff - (days*24*60*60 + hours*60*60 + minutes*60)));		
		$("#daymarker").text(days);
		$("#hourmarker").text(hours);
		$("#minmarker").text(minutes);
		$("#secmarker").text(seconds);				

		//console.log("interval set");
	}
	checkTimeForLaunch();	
	setInterval(checkTimeForLaunch, 1000);
	
	/**
	 * On page load
	 **/
	 
	$(window).on('load', function() {
		winHeight = $( window ).height();
		winWidth = $( window ).width();
		//winHeight = $.fn.viewport().height;
		enforcePageMinHeight();
		
		if (winWidth<=767)
		{
			console.log("in foxmask");
			if ($('#foxmaskmarker').hasClass("foxmask"))
			{
				$('#foxmaskmarker').removeClass('foxmask');
			}
		}
		else
		{			
			setupMaskedFoxes();
		}
	});
	
	/**
	 * On window resize
	 **/
		
	$(window).on('resize', function() {
		clearTimeout(throttleTimer);
		throttleTimer = setTimeout(checkResponsive, 200);
	});
	
	function checkResponsive() {
		//winWidth = $.fn.viewport().width;
		winHeight = $( window ).height();
		//winHeight = $.fn.viewport().height;
		winWidth = $( window ).width();
		
		enforcePageMinHeight();
	}
	
	
	/**
	 * UI-related functions
	 **/
	 
	// Enforce Page Content min height
	function enforcePageMinHeight() {
		if( !$('body').hasClass('page-template-gamepage') || isMobile ) return;
		
		//$('#content').css('height', 'auto');
		//if ( $('#page').height() < winHeight )
			$('#content').height( winHeight - $('#masthead').height() - $('#colophon').height() );	
	}
	
	// Read more - Cider Making Process
	$('.panel-row-style-howitsmade .textwidget a.button').on('click', function(e){
		e.preventDefault();
		
		$(this).hide();
		$('.panel-row-style-howitsmade #cider-making-process').addClass('expanded');
	});
	

	
	function setupMaskedFoxes() {
		console.log("seting up masked foxes");
		if( !$('img.fox-masked').length || isMobile || !isCanvasSupported ) return;
	
		console.log("masked fox starting now");
		$('.foxmask img.fox-masked').maskedFox({
			maskerImage: 'img/fox-mask-cream3.png',
			maskedVideo: 'img/fox-masked-liquid2.mp4',
			id: 'foxMaskedCream'
		});
		$('.foxmaskblack img.fox-masked').maskedFox({
			maskerImage: 'img/fox-mask-cream3.png',
			maskedVideo: 'img/fox-masked-liquid2.mp4',
			id: 'foxMaskedBlack'
		});
	}
	

	
	
} )( jQuery );