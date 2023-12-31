$.typeahead({
  input: '.search-term',
  minLength: 1,
  maxItem: 10,
  order: 'asc',
  hint: true,
  highlight: false,
  cache: false,
  ttl: 2628003,
  href: '/product/search?search={{display}}',
  cancelButton: false,
  asyncResult: true,
  source: {
    ajax: {
      url: '/autocomplete-search',
    }
  },
  callback: {
    onShowLayout: function (node, a, item, event) {
      $('.search-result').show();
    },
    onCancel: function (node, a, item, event) {
      $('.search-result').hide();
    },
  },
  selector: {
    container: 'search-form',
    result: 'search-result',
    list: 'search-list',
    group: "search",
    item: 'search-item',
    empty: 'empty-search',
    display: 'search-display',
    query: 'search-term-div',
    button: "search-btn",
    hint: "search-hint"
  },
  debug: true
});

/*==================== Exzoom function ====================*/
var shazoom = function () {
  $("#shazoom").exzoom({
    "autoPlay": false
  });
};

/* Plus button function */
$('.plus').on('click', function (e) {
  let qtyinput = $(this).prev('input.qty');
  let val = parseInt(qtyinput.val());
  qtyinput.val(val + 1).trigger('change');
});

/* Minus button function */
$('.minus').on('click', function (e) {
  let qtyinput = $(this).next('input.qty');
  let val = parseInt(qtyinput.val());
  if (val > 1) {
    qtyinput.val(val - 1).trigger('change');
  }
});

/* Enable minus button when value of input quantity is greater than 1 and vice versa */
$('input.qty').on('change', function() {
  if ($('input.qty').val() > 1)
    $(this).prev('minus').removeAttr('disabled');
  else
    $(this).prev('minus').attr('disabled', true);
});

$(function () {
  document.oncontextmenu = () => false;;
  document.onselectstart = () => false;
  $('#main-content').on('cut copy', function (event) {
    event.preventDefault();
  });
});

/*==================== Request product price from database ====================*/
// function price(id) {
//   $("[name='product-size']").on('change', () => {
//     let form = $("[name='product-form']:checked").val();
//     let size = $("input[name='product-size']:checked").val();
//     $('.cart-btn-div').css('width', '10em');
//     $('input.qty').val(1);
//     $('.plus').removeAttr('disabled');
//     $('input.qty').removeAttr('disabled');

//     $.ajax({
//       type: 'get',
//       url: '/get-product-price',
//       data: {
//         id: id,
//         size: size,
//         form: form
//       },
//       success: function (resp) {
//         resp = Number(resp).toFixed(2);
//         $("#price").html(`<h4>AED ${resp}</h4>`);
//        alert(resp);
//       },
//       error: function (resp) {
//         $("#price").html(`<div class="error">Something went wrong. Please try again...</div>`);
//       }
//     });
//   });
// }

/*========== Product Sizes Creation ==========*/
function createSizes(productId, formId) {
  /* AJAX request for sizes creation */
  $.ajax({
    type: 'get',
    url: '/create-sizes',
    data: {
      product_id: productId,
      form_id: formId
    },
    success: function (resp) {
      $('#price-size').html(resp);
      price(productId);
    },
    error: function () {
      $('#price-size').append(`<div class="error">Something went wrong. Please try again...</div>`);
    }
  });
};

/*========== Add items to cart ==========*/
function cartAdd(id) {
  let price = $('#price-input').val();
  let qty = $('#qty').val();
  $('.modal-close').hide();

  /* AJAX request for adding item to cart */
  $.ajax({
    type: 'get',
    url: '/cart-add',
    data: {
      product_id: id,
      price: price,
      qty: qty
    
    },
    success: function (resp) {      
      $('.cart-btn').addClass('clicked');
      $('body').css('height', '90vh');
      $('body').css('overflow', 'hidden');
      $('#checkout-popup').css('transform', 'scale(1)');
      $(".loc-btn").show();
      $(".chkt-btn").addClass('collapse');
      $('#location-popup').attr('data-toggle', '1');
      $('.cart-count').html(resp[0]);
      $('.cart-count-header').html(resp[0] + ' Items');
      $('.shopping-list').html(resp[1]);
      $('.total-amount').html('AED ' + resp[2]);
    },
    error: function () {
      $('body').css('height', '90vh');
      $('body').css('overflow', 'hidden');
      $('#checkout-popup').css('transform', 'scale(1)');
      $('#location-popup').attr('data-toggle', '1');
      $('#location-popup').html(`<div class="error modal-error">Something went wrong. Please try again...</div>`);
    }
  });

  $('body').on('click', function (event) {
    if ($(event.target).is('#checkout-popup')) {
      remInnerModal();
    }     
  });
}

function remInnerModal() {
  $('body').css('height', 'auto');
  $('body').css('overflow', 'auto');
  $('#checkout-popup').css('transform', 'scale(0)');
  $('.modal-close').show();
  $('#location-popup').attr('data-toggle', '0');
  $('.cart-btn').removeClass('clicked');
}

/*==================== Add product to favorites ====================*/
function fav(ico, id) {
  let el = $(ico).children()[0];
  if ($(el).hasClass('fa-regular')) {
    $(`.${id}-card .fa-heart`).removeClass('fa-regular');
    $(`.${id}-card .fa-heart`).addClass('fa-solid');
    /* AJAX request for adding shopping list items to wishlist */
    $.ajax({
      type: 'get',
      url: '/wishlist-add/',
      data: {id: id},
      success: function(response) {
        $('.fav-qty').html(response);
      },
      error: function() {
        alert("An error occured while adding to wishlist");
      }                
    }); 
  }
  
  else if ($(el).hasClass('fa-solid')) {
    $(`.${id}-card .fa-heart`).removeClass('fa-solid');
    $(`.${id}-card .fa-heart`).addClass('fa-regular');

    /* AJAX request for deleting wishlist item */
    $.ajax({
      type: 'get',
      url: '/wishlist-delete/',
      data: {id: id},
      success: function(response) {
        $('.fav-qty').html(response);
      },
      error: function() {
        alert("An error occured while removing from wishlist");
      }                
    }); 
  }
}

function chOptions() {
  $(".loc-btn").hide();
  $(".chkt-btn").removeClass('collapse');
}