$(function() {
  $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  $('.flash-message').css('opacity', 0);
  setTimeout(function() {
    $('.flash-message').remove();
  }, 4100);
  
  $('#email').on('input focus', function() {
    let exist;
    let data = $(this).val();
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (data.match(regex)) {
      $.ajax({
        url: '/user-exists',
        async: false,
        cache: false,
        data: {
          email: data
        },
        success: function(resp) {
          if(resp == 1) {
            exist = true;
          } else {
            exist = false;
          }
        },
        error: function() {
          exist = false;
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
    } else if (!exist) {
      $(this).parent().append(`<i class="bx bxs-x-circle input-validate input-error"></i>`);
      $(this).closest('.form-group').append(`<div class="error">Invalid user email address.</div>`);
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
      $(this).closest('.form-group').append(`<div class="error">Invalid password</div>`);
    } else {
      $(this).parent().append(`<i class="bx bxs-check-circle input-validate valid-input"></i>`);
    }

    $('.signing-img-container').css('height', $('.shop-signing').outerHeight());
  });

  $('#email, #password').on('blur', function() {
    $(this).nextAll('.input-validate:first').remove();
    $(this).parent().next('.error').remove();
  });
});