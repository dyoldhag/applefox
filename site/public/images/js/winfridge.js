$(function () {

  // $.ajaxSetup({
  //   headers: {
  //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });

  window.addEventListener('load', function(e) {

    jQuery('#preferred').SumoSelect();

    jQuery('#icnumber').on('change keypress keyup', function(e) {
      if(jQuery.isNumeric(e.target.value) == false){
        var y = e.target.value.replace(/[A-Za-z]/g, '');
        e.target.value = y
      }else{
        var x = e.target.value.replace(/\D/g, '').match(/(\d{6})(\d{2})(\d{4})/);
        if(x)
          e.target.value = x[1]+'-'+x[2]+'-'+x[3];
      }
    });
    jQuery('#phone').on('change keypress keyup', function(e) {
      if(jQuery.isNumeric(e.target.value) == false){
        var y = e.target.value.replace(/[A-Za-z]/g, '');
        e.target.value = y
      }else{
        var x = e.target.value.replace(/\D/g, '').match(/(\d{3})(\d{3})(\d{4})/);
        if(x)
          e.target.value = x[1]+'-'+x[2]+x[3];
      }
    });
    jQuery('#email').on('change keypress keyup', function(e) {
      $('.invalid-message').hide();
    });

    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {

        if(jQuery('#email').val()){
          jQuery('.invalid-feedback-email').html('Please input a valid email');
        }else{
          jQuery('.invalid-feedback-email').html('Email is required');
        }

        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }else{
          $('.btn-submit').attr("disabled", true);
        }
        $('.invalid-message').hide();
        form.classList.add('was-validated');
      }, false);
    });
  }, false);

  function spacing_result_text(){
    var bottom = ( $( window ).height() - $('.result img').height() )/2;
    $(".result-text").css("bottom", bottom);
  }
  $(window).resize(function () {
    spacing_result_text();
  });
  spacing_result_text();

});
