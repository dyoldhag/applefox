/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 14);
/******/ })
/************************************************************************/
/******/ ({

/***/ 14:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(15);


/***/ }),

/***/ 15:
/***/ (function(module, exports) {

$(function () {

  // $.ajaxSetup({
  //   headers: {
  //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });

  window.addEventListener('load', function (e) {

    // jQuery('#preferred').SumoSelect();

    jQuery('#icnumber').on('change keypress keyup', function (e) {
      if (jQuery.isNumeric(e.target.value) == false) {
        var y = e.target.value.replace(/[A-Za-z]/g, '');
        e.target.value = y;
      } else {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{6})(\d{2})(\d{4})/);
        if (x) e.target.value = x[1] + '-' + x[2] + '-' + x[3];
      }
    });
    jQuery('#phone').on('change keypress keyup', function (e) {
      if (jQuery.isNumeric(e.target.value) == false) {
        var y = e.target.value.replace(/[A-Za-z]/g, '');
        e.target.value = y;
      } else {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{3})(\d{3})(\d{4})/);
        if (x) e.target.value = x[1] + '-' + x[2] + x[3];
      }
    });
    jQuery('#email').on('change keypress keyup', function (e) {
      $('.invalid-message').hide();
    });

    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {

        if (jQuery('#email').val()) {
          jQuery('.invalid-feedback-email').html('Please input a valid email');
        } else {
          jQuery('.invalid-feedback-email').html('Email is required');
        }

        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          $('.btn-submit').attr("disabled", true);
          // event.preventDefault();
          // var name = $("input[name=name]").val();
          // var icnumber = $("input[name=icnumber]").val();
          // var phone = $("input[name=phone]").val();
          // var email = $("input[name=email]").val();
          // var preferred = $("select[name=preferred]").val();
          // $.ajax({
          //   type:'POST',
          //   url:'/winner',
          //   data:{name:name, icnumber:icnumber, phone:phone, email:email, preferred:preferred},
          //   success:function(data){
          //     if(data.result == 'success'){
          //       $('.logo').remove();
          //       $('.result').fadeIn();
          //       $('#game-win').fadeOut();
          //       $('#game-win').remove();
          //       spacing_result_text();
          //     }
          //   }
          // });
        }
        $('.invalid-message').hide();
        form.classList.add('was-validated');
      }, false);
    });
  }, false);

  function spacing_result_text() {
    var bottom = ($(window).height() - $('.result img').height()) / 2;
    $(".result-text").css("bottom", bottom);
  }
  $(window).resize(function () {
    spacing_result_text();
  });
  spacing_result_text();
});

/***/ })

/******/ });