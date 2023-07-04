$('#all-checkbox').on('change', function() {
  if(this.checked) {
    $('.item-checkbox').prop('checked', true);
    $('#action').removeAttr('disabled');
  }
  else {
    $('.item-checkbox').prop('checked', false);
    $('#action').attr('disabled', true);
  }
});

$('.item-checkbox').on('change', function() {
  if(! this.checked) {
    $('#all-checkbox').prop('checked', false);
  } else {
    $('#action').removeAttr('disabled');
  }

  if($('.item-checkbox:checked').length == $('.item-checkbox').length)
    $('#all-checkbox').prop('checked', true);

  if($('.item-checkbox:not(:checked)').length == $('.item-checkbox').length) {
    $('#action').attr('disabled', true);
  }
});

$('#action').on('click', function() {
  let total = Number($('#total').val()) + Number($('#tax').val()) - Number($('#discount').val());

  if(total >= 100) {
    if($('#all-checkbox').prop('checked')) {
      total = 0;
    }
    else {
      $('input:checkbox[name=item_checkbox]:checked').each(function() {
        total -= $(this).attr('data-total');
      });
    }

    if(total < 100) {
      if($(this).hasClass('item-cancel') && total == 0) {
        $('#reason-popup').css('width', '100%');
        $('#reason-popup').css('height', '100%');
        $('#reason-div').css('transform', 'scale(1)');
        $('body').css('height', '90vh');
        $('body').css('overflow', 'hidden');
      } else {
        $('#warning-popup').css('width', '100%');
        $('#warning-popup').css('height', '100%');
        $('#warning-div').css('transform', 'scale(1)');
        $('body').css('height', '90vh');
        $('body').css('overflow', 'hidden');

        $('#continue').on('click', function() {
          removePopup();
          $('#reason-popup').css('width', '100%');
          $('#reason-popup').css('height', '100%');
          $('#reason-div').css('transform', 'scale(1)');
          $('body').css('height', '90vh');
          $('body').css('overflow', 'hidden');
        });
      }
    } else {
      $('#reason-popup').css('width', '100%');
      $('#reason-popup').css('height', '100%');
      $('#reason-div').css('transform', 'scale(1)');
      $('body').css('height', '90vh');
      $('body').css('overflow', 'hidden');
    }
  } else {
    $('#reason-popup').css('width', '100%');
    $('#reason-popup').css('height', '100%');
    $('#reason-div').css('transform', 'scale(1)');
    $('body').css('height', '90vh');
    $('body').css('overflow', 'hidden');
  }
});

$('.reason-item').on('click', function() {
  $('.reason-item').css('color', 'rgb(67, 83, 255)');
  $('.reason-item').css('background-color', '#f2f4e6');
  $(this).css('color', '#fff');
  $(this).css('background-color', 'rgb(67, 83, 255)');
  $('#reason').val($(this).attr('id'));

  $('.pop-btn').removeAttr('disabled');

  if($(this).attr('id') == 'other')
    $('#other-text').removeClass('collapse');
  else
    $('#other-text').addClass('collapse');
});

$('.continue-action').on('click', function() {
  let action;
  if($(this).hasClass('cancel')) {
    action = 'cancel'
  } else if($(this).hasClass('return')) {
    action = 'return';
  }

  let order_id = $('#order').val();
  let all = 0;
  let items = new Array();
  let reason = $('#reason').val();
  if(reason == 'other') {
    if($('#other-text').val() != '')
      reason = $('#other-text').val();
  }

  if($('#all-checkbox').prop('checked')) {
    all = 1;
  }
  else {
    $('input[name=item_checkbox]:checked').each(function() {
      items.push($(this).val());
    });
  }

  removePopup();
  $('#otp-popup').css('width', '100%');
  $('#otp-popup').css('height', '100%');
  $('#otp-div').css('transform', 'scale(1)');
  $('body').css('height', '90vh');
  $('body').css('overflow', 'hidden');

  /* AJAX request to cancel items from order */
  $.ajax({
    type: 'get',
    url: '/action-email/' + action,
    data: {
      id: order_id,
      all: all,
      items: items,
      reason: reason
    },
    success: function(response) {

    },
    error: function() {
      
    }                
  }); 
});

$('#verify').on('click', function() {
  let order_id = $('#order').val();
  let all = 0;
  let items = new Array();
  let reason = $('#reason').val();
  if(reason == 'other') {
    if($('#other-text').val() != '')
      reason = $('#other-text').val();
  }

  if($('#all-checkbox').prop('checked')) {
    all = 1;
  }
  else {
    $('input[name=item_checkbox]:checked').each(function() {
      items.push($(this).val());
    });
  }

  let otp = '';
  $('.otp').each(function() {
    otp += $(this).val();
  });

  /* AJAX request to cancel items from order */
  $.ajax({
    type: 'get',
    url: '/order-cancel',
    data: {
      id: order_id,
      all: all,
      items: items,
      reason: reason,
      otp: otp
    },
    success: function(response) {
    },
    error: function() {
      alert("An error occured while cancel operation");
    }                
  }); 
});

$('#continue-return').on('click', function() {
  let order_id = $('#order').val();
  let all = 0;
  let items = new Array();
  let reason = $('#reason').val();
  if(reason == 'other') {
    if($('#other-text').val() != '')
      reason = $('#other-text').val();
  }

  if($('#all-checkbox').prop('checked')) {
    all = 1;
  }
  else {
    $('input[name=item_checkbox]:checked').each(function() {
      items.push($(this).val());
    });
  }

  /* AJAX request to return items from order */
  $.ajax({
    type: 'get',
    url: '/order-return',
    data: {
      id: order_id,
      all: all,
      items: items,
      reason: reason
    },
    success: function(response) {
      location.reload();
    },
    error: function() {
      alert("An error occured while return operation");
    }                
  }); 
});

function removePopup() {
  $('.popup-div').css('transform', 'scale(0)');
  $('.popup').css('width', '0');
  $('.popup').css('height', '0');
  $('body').css('height', 'auto');
  $('body').css('overflow', 'auto');
}

let digitValidate = function(ele){
  ele.value = ele.value.replace(/[^0-9]/g,'');
}

let tabChange = function(val){
  let ele = document.querySelectorAll('.otp');
  if(ele[val-1].value != ''){
    ele[val].focus()
  }else if(ele[val-1].value == ''){
    ele[val-2].focus()
  }   
}