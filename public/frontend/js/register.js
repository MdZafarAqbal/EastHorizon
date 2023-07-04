$(function() {
  $('[name|=cust_type]').on('change', function() {
    if(this.value == 'company') {
      $('#fname').val('');
      $('#lname').val('');
      $('#company-name').removeClass('collapse');
      $('#trn').removeClass('collapse');
      $('#first-name').addClass('collapse');
      $('#last-name').addClass('collapse');
    }

    else {
      $('#cname').val('');
      $('#trn-no').val('');
      $('#company-name').addClass('collapse');
      $('#trn').addClass('collapse');
      $('#first-name').toggleClass('collapse');
      $('#last-name').toggleClass('collapse');
    }
  });

  $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  $('.flash-message').css('opacity', 0);
  setTimeout(function() {
    $('.flash-message').remove();
  }, 4100);

  $('#fname').on('input focus', function() {
    let regex = /^[a-zA-Z ].{2,}$/;
    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();
    if($.trim($(this).val()) == '') {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The first name is required.</div>`);
    } else if (!$(this).val().match(regex)) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The first name must contain<li>at least 3 letters</li><li>only spaces and letters</li></div>`);
    } else {
      $(this).parent().append(`<i class="bx bxs-check-circle input-validate valid-input"></i>`);
    }

    $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  });

  $('#lname').on('input focus', function() {
    let regex = /^[a-zA-Z ].{2,}$/;
    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();
    if($.trim($(this).val()) == '') {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The last name is required.</div>`);
    } else if (!$(this).val().match(regex)) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The last name must contain<li>at least 3 letters</li><li>only spaces and letters</li></div>`);
    } else {
      $(this).parent().append(`<i class="bx bxs-check-circle input-validate valid-input"></i>`);
    }

    $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  });
  
  $('#cname').on('input focus', function() {
    let regex = /^.{3,}$/;
    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();
    if($.trim($(this).val()) == '') {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The company name is required.</div>`);
    } else if (!$(this).val().match(regex)) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The company name must be<li>at least 3 characters.</li></div>`);
    } else {
      $(this).parent().append(`<i class="bx bxs-check-circle input-validate valid-input"></i>`);
    }

    $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  });

  $('#trn-no').on('input focus', function() {
    let regex = /^(\d *){15,}$/;
    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();
    if($.trim($(this).val()) == '') {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The trn number is required.</div>`);
    } else if (!$(this).val().match(regex)) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The trn number must be<li>at least 15 digis.</li></div>`);
    } else {
      $(this).parent().append(`<i class="bx bxs-check-circle input-validate valid-input"></i>`);
    }

    $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  });
  
  $('#email').on('input focus', function() {
    let already;
    let data = $(this).val();
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (data.match(regex)) {
      $.ajax({
        url: '/already-user',
        async: false,
        cache: false,
        data: {
          email: data
        },
        success: function(resp) {
          if(resp == 1) {
            already = true;
          } else {
            already = false;
          }
        },
        error: function() {
          already = false;
        }
      });
    }

    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();

    if($.trim($(this).val()) == '') {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The email is required.</div>`);
    } else if (! data.match(regex)) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The email must be a valid email address</div>`);
    } else if (already) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The email has already been taken.</div>`);
    } else {
      $(this).parent().append(`<i class="bx bxs-check-circle input-validate valid-input"></i>`);
    }

    $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  });

  $('#password').on('input focus', function() {
    let regex = /^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[<>\{\}";:.,~!?@#$%^=&*\[\]\(\)¿§«»ω⊙¤°℃℉€¥£¢¡®©_\-+\^]).{8,}$/;
    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();
    if($.trim($(this).val()) == '') {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The password is required.</div>`);
    } else if (!$(this).val().match(regex)) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The password must contain<li>at least 8 characters</li><li>at least 1 letter</li><li>at least 1 digit</li><li>at least 1 special character</li></div>`);
    } else {
      $(this).parent().append(`<i class="bx bxs-check-circle input-validate valid-input"></i>`);
    }

    $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  });

  $('#confirm-password').on('input focus', function() {
    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();
    if($.trim($(this).val()) == '') {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The password confirmation is required.</div>`);
    } else if (!($(this).val() == $('#password').val())) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">The passwords must watch.</div>`);
    } else {
      $(this).parent().append(`<i class="bx bxs-check-circle input-validate valid-input"></i>`);
    }

    $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  });

  $('#fname, #lname, #cname, #trn-no, #email, #password, #confirm-password').on('blur', function() {
    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();
  });
});
