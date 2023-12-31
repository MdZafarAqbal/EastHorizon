function updateCartData(id, qty) {
  $.ajax({
    type: 'get',
    url: '/cart-update',
    data: {
      "id": id,
      "qty": qty
    },
    dataType: 'json',
    success: function(resp) {   
      discount = resp[0].toFixed(2);
      total = resp[1].toFixed(2);
      subtotal = resp[2].toFixed(2);
      tax = resp[3].toFixed(2);
      total_discount = resp[4].toFixed(2);
      total_amount = resp[5].toFixed(2);
      $('#' + id + '-discount').html('AED ' + discount);
      $('#' + id + '-total').html('AED ' + total);
      $('#subtotal-value').html('AED ' + subtotal);
      $('#tax-value').html('AED ' + tax);
      $('#discount-value').html('AED ' + total_discount);
      $('#grand-total-value').html('AED ' + total_amount);
    },
    error: function(resp) {
      alert('error');
    }                
  }); 
}