/*==================== Product Modal Window ====================*/
var el = $('#modal-container');

function showModal(id, productId) {
  $('#' + id).attr('disabled', true);

  /*========== Modal Creation ==========*/

  /* AJAX request for modal creation */
  $.ajax({
    type: 'get',
    url: '/create-modal',
    data: {
      product_id: productId
    },
    success: function(response) {
      $('#modal-container').html(response);
      window.oldScrollPos = $(window).scrollTop();
      $(window).on('scroll.scrolldisabler',function ( event ) {
        $(window).scrollTop( window.oldScrollPos );
        event.preventDefault();
      });
      $(el).css('transform', 'scale(1)');

      shazoom();
      $('#' + id).removeAttr('disabled');

      /* Enable minus button when value of input quantity is greater than 1 and vice versa */
      $('input.qty').on('change', function() {
        if ($('input.qty').val() > 1)
          $('.minus').removeAttr('disabled');
        else
          $('.minus').attr('disabled', true);
      });

      /* Plus button function */
      $('.plus').on('click', function() {
        let qtyinput = $(this).prev('input.qty');
        let val = parseInt(qtyinput.val());
        qtyinput.val( val+1 ).trigger('change');
      });
      
      /* Minus button function */
      $('.minus').on('click', function() {
        let qtyinput = $(this).next('input.qty');
        var val = parseInt(qtyinput.val());
        if (val > 1) {
          qtyinput.val( val-1 ).trigger('change');
        }
      });

      $('#modal-container').on('click', function (event) {
        if ($(event.target).is('#modal-container')) {
          closeModal();
        }     
      });
    },
    error: function() {
      $('#modal-container').html("Something went wrong. Please try again...");
    }                
  });

  $('body').on('keydown', function(event) {
    if(event.key == "Escape") {
      if($('#location-popup').attr('data-toggle') == 1)
        remInnerModal();
      else
        closeModal();
    }
  });
}

/*==================== Remove modal from DOM ====================*/
function closeModal() {
  $(window).off('scroll.scrolldisabler');
  $(el).css('transform', 'scale(0)');
  setTimeout(function() {
    $('#modal').remove();
  }, 1000);
}