$(function() {
  $('[name|=cust_type]').on('change', function() {
    if(this.value == 'company') {
      $('#company-name').removeClass('collapse');
      $('#trn').removeClass('collapse');
      $('#first-name').addClass('collapse');
      $('#last-name').addClass('collapse');
    }

    else {
      $('#company-name').addClass('collapse');
      $('#trn').addClass('collapse');
      $('#first-name').toggleClass('collapse');
      $('#last-name').toggleClass('collapse');
    }
  });

  $('[name|=pay_mthd]').on('change', function() {
    if(this.value == 'op') {
      $('#op-form').toggleClass('collapse');
      $('#cart-summary').css('max-height', '+=29.5em');
    }

    else {
      if(!$('#op-form').hasClass('collapse')) {
        $('#op-form').addClass('collapse');
        $('#cart-summary').css('max-height', '-=29.5em');
      }
    }
  });

  $('[name|=shipping_option]').on('change', function() {
    let total = parseFloat($('#grand-total-value').attr('data-total'));

    if(this.value == 'different') {
      $('#shipping-details').toggleClass('collapse');
      $('#cart-summary').css('max-height', '+=25em');
      let shipping = parseFloat($('#shipping-city-name').attr('data-shipping'));

      if(total > 100) {
        shipping = 0;
      }

      total += shipping;

      if(shipping) {
        $('#shipping-value').html('AED ' + shipping.toFixed(2));
        $('#grand-total-value').html('AED ' + total.toFixed(2));
      }
    }

    else {
      if(!$('#shipping-details').hasClass('collapse')) {
        $('#shipping-details').addClass('collapse');
        $('#cart-summary').css('max-height', '-=25em');
        $('#shipping-city').val(undefined);
        let shipping = parseFloat($('#city-name').attr('data-shipping'));

        if(total > 100) {
          shipping = 0;
        }
  
        total += shipping;
        
        $('#shipping-value').html('AED ' + shipping.toFixed(2));
        $('#grand-total-value').html('AED ' + total.toFixed(2));
      }
    }
  });
  
  $('#country-div').on('keypress', function(event) {
    if(event.keyCode == 13)
      $(this).click();
  });

  $('#country-div').on('click', function() {
    $('#countries').toggleClass('collapse').focus();
  });

  $('#countries').on('focusout', function() {
    $(this).addClass('collapse');
  });

  $('#state-div').on('keypress', function(event) {
    if(event.keyCode == 13)
      $(this).click();
  });

  $('#state-div').on('click', function() {
    if($('#states').html() != '')
      $('#states').toggleClass('collapse').focus();
  });

  $('#states').on('focusout', function() {
    $(this).addClass('collapse');
  });

  $('#city-div').on('keypress', function(event) {
    if(event.keyCode == 13)
      $(this).click();
  });

  $('#city-div').on('click', function() {
    if($('#cities').html() != '')
      $('#cities').toggleClass('collapse').focus();
  });

  $('#cities').on('focusout', function() {
    $(this).addClass('collapse');
  });

  $('#shipping-country-div').on('keypress', function(event) {
    if(event.keyCode == 13)
      $(this).click();
  });

  $('#shipping-country-div').on('click', function() {
    $('#shipping-countries').toggleClass('collapse').focus();
  });

  $('#shipping-countries').on('focusout', function() {
    $(this).addClass('collapse');
  });

  $('#shipping-state-div').on('keypress', function(event) {
    if(event.keyCode == 13)
      $(this).click();
  });

  $('#shipping-state-div').on('click', function() {
    if($('#shipping-states').html() != '')
      $('#shipping-states').toggleClass('collapse').focus();
  });

  $('#shipping-states').on('focusout', function() {
    $(this).addClass('collapse');
  });

  $('#shipping-city-div').on('keypress', function(event) {
    if(event.keyCode == 13)
      $(this).click();
  });

  $('#shipping-city-div').on('click', function() {
    if($('#shipping-cities').html() != '')
      $('#shipping-cities').toggleClass('collapse').focus();
  });

  $('#shipping-cities').on('focusout', function() {
    $(this).addClass('collapse');
  });

  $('#expiry-month').on('input', function(event) {
    if(isNaN(Number(this.value)) || this.value > 12) {
      this.value = this.value.slice(0, -1);
      return false;
    }

    if(this.value.length == 2)
      $('#expiry-year').focus();
  });

  $('#expiry-month').on('keypress', function(event) {
    if(this.value.length >= 2 || isNaN(Number(this.value))) {
      event.preventDefault();
      event.stopPropagation();
      return false;
    }
  });

  $('#expiry-year').on('input', function(event) {
    let date = new Date();
    if(isNaN(Number(this.value))) {
      this.value = this.value.slice(0, -1);
      return false;
    }
    
    if(this.value.length == 4) {
      if(this.value < date.getFullYear() || this.value > date.getFullYear() + 5) {
        this.placeholder = 'Invalid Year';
        this.value = '';
      }
      else
        $('#cvv-cvc').focus();
    }
  });

  $('#expiry-year').on('keypress', function(event) {
    if(this.value.length >= 4 || isNaN(Number(this.value))) {
      event.preventDefault();
      event.stopPropagation();
      return false;
    }
  });

  $('#order-form').on('submit', function() {
    $('body').css('height', '90vh');
    $('body').css('overflow', 'hidden');
    $('.loader-section').removeClass('collapse');
    let val = $('#account-no').val();
    val = val.split(" ").join("");
    $('#account-no').val(val);
  });
  
});

function cardNum(el, event) {
  let ws = $(el).val().split(" ").join("");
  
  if(isNaN(Number(ws)) || event.data == ' ')
    el.value = el.value.slice(0, -1);

  if(el.value.length >= 19)
    return false;

  if (ws.length > 0) {
    if(ws.length % 4 == 0) {
      el.value = el.value.trim();
      el.value += ' ';
    }
  }

  if(event.data == null) {
    el.value = el.value.trim();
  }
}

function cardLen(el, event) {
  let ws = $(el).val().split(" ").join("");

  if(el.value.length >= 19 || isNaN(Number(ws))) {
    event.preventDefault();
    event.stopPropagation();
    return false;
  }
}

function country(el, id) {
  let iso = $(el).attr('data-iso');
  let callCode = $(el).attr('data-call-code');

  if ($(el).hasClass('shipping')) {
    $('.shipping-flag-img').attr('src', '/images/flags/' + iso + '.png');
    $('.shipping-call-code').html('+' + callCode);

    $('#shipping-country-name').html($(el).html());
    $('#shipping-country').val(id);

    $('#shipping-state-name').html('State');
    $('#shipping-state-name').css('color', '#727272');
    $('#shipping-states').html('');

    $('#shipping-city-name').html('City');
    $('#shipping-city-name').css('color', '#727272');
    $('#shipping-cities').html('');
  } else {
    $('.flag-img').attr('src', '/images/flags/' + iso + '.png');
    $('.call-code').html('+' + callCode);

    $('#country-name').html($(el).html());
    $('#country').val(id);

    $('#state-name').html('State');
    $('#state-name').css('color', '#727272');
    $('#states').html('');

    $('#city-name').html('City');
    $('#city-name').css('color', '#727272');
    $('#cities').html('');
  }

  $.ajaxSetup({ cache: false });

  /* AJAX request for getting states for country */
  $.ajax({
    type: 'get',
    url: '/states',
    data: {
      id: id,
    },
    success: function (resp) {
      if(resp == '') {
        if ($(el).hasClass('shipping')) {
          $('#shipping-state-form-group').hide();
          $('#shipping-city-form-group').hide();
        } else {
          $('#state-form-group').hide();
          $('#city-form-group').hide();
        }
      }
      else {
        if ($(el).hasClass('shipping')) {
          $('#shipping-state-form-group').show();
          $('#shipping-city-form-group').show();
          var stList = $('#shipping-states')[0];
        } else {
          $('#state-form-group').show();
          $('#city-form-group').show();
          var stList = $('#states')[0];
        }

        resp.forEach((element) => {
          let item = document.createElement("li");
          if ($(el).hasClass('shipping'))
            $(item).attr('class', 'shipping');
          $(item).html(element['name']);
          $(item).attr('id', 'state' + element['id']);
          $(item).attr('data-state', element['id'])
          $(item).attr('data-country', id);
          $(item).attr('onclick', 'state(this)')
          stList.appendChild(item);
        });
      }
    },
    error: function () {
      alert("An error occured while accessing states")
    }
  });
}

function state(el) {
  let id = $(el).attr('data-state');
  let country_id = $(el).attr('data-country');

  if ($(el).hasClass('shipping')) {
    $('#shipping-city-name').html('City');
    $('#shipping-city-name').css('color', '#727272');
    $('#shipping-cities').html('');

    $('#shipping-state-name').html($(el).html());
    $('#shipping-state-name').css('color', '#000');
    $('#shipping-state').val(id);
  } else {
    $('#city-name').html('City');
    $('#city-name').css('color', '#727272');
    $('#cities').html('');
    
    $('#state-name').html($(el).html());
    $('#state-name').css('color', '#000');
    $('#state').val(id);
  }

  $.ajaxSetup({ cache: false });

  /* AJAX request for getting cities for state */
  $.ajax({
    type: 'get',
    url: '/cities',
    data: {
      id: id,
      country_id: country_id
    },
    success: function (resp) {
      if(resp == '') {
        if ($(el).hasClass('shipping')) {
          $('#shipping-state-form-group').hide();
        } else {
          $('#city-form-group').hide();
        }
      }
      else {
        if ($(el).hasClass('shipping')) {
          $('#shipping-city-form-group').show();
          var ctList = $('#shipping-cities')[0];
        } else {
          $('#city-form-group').show();
          var ctList = $('#cities')[0];
        }
        resp.forEach((element) => {
          let item = document.createElement('li');
          if ($(el).hasClass('shipping'))
            $(item).attr('class', 'shipping');

          $(item).html(element['name']);
          $(item).attr('id', 'city'+element['id']);
          $(item).attr('data-country', country_id);
          $(item).attr('data-state', id);
          $(item).attr('data-city', element['id']);
          $(item).attr('data-shipping', element['shipping']);
          $(item).attr('onclick', 'city(this)')
          ctList.appendChild(item);
        });
      }
    },
    error: function () {
      alert("An error occured while accessing states")
    }
  });
}

function city(el) {
  let id = $(el).attr('data-city');
  let shipping = parseFloat($(el).attr('data-shipping'));
  let total = parseFloat($('#grand-total-value').attr('data-total'));

  if(total > 100) {
    shipping = 0;
  }

  total += shipping;

  if ($(el).hasClass('shipping')) {
    $('#shipping-city-name').html($(el).html());
    $('#shipping-city-name').css('color', '#000');
    $('#shipping-city-name').attr('data-shipping', shipping);
    $('#shipping-city').val(id);
    $('#shipping-value').html('AED ' + shipping.toFixed(2));
    $('#grand-total-value').html('AED ' + total.toFixed(2));
  } else {
    $('#city-name').html($(el).html());
    $('#city-name').css('color', '#000');
    $('#city-name').attr('data-shipping', shipping);
    $('#city').val(id);
    if(! $('#shipping-city').val()) {
      $('#shipping-value').html('AED ' + shipping.toFixed(2));
      $('#grand-total-value').html('AED ' + total.toFixed(2));
    }
  }
}