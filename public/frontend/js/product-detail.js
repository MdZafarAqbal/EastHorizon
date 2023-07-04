function showDetail(btn) {
  let data = btn.getAttribute('data-toggle');
  let active = btn.classList.contains('active-details-review');
  $('.details-review-btn').removeClass('active-details-review');
  if (!active)
    btn.classList.add('active-details-review');
  if (data == 'description') {
    document.getElementById('reviews').classList.add('collapse');
    document.getElementById(data).classList.toggle('collapse');
  }
  else {
    document.getElementById('description').classList.add('collapse');
    document.getElementById(data).classList.toggle('collapse');
  }
}

$('body').on('keydown', function(event) {
  if(event.key == "Escape") {
    if($('#location-popup').attr('data-toggle') == 1)
      remInnerModal();
  }
});
window.onload = function() {
  $(function() {
  
      shazoom();
  
    })
    
				/* Enable minus button when value of input quantity is greater than 1 and vice versa */
				$('input.qty').on('change', function() {
					if ($('input.qty').val() > 1)
						$('.minus').removeAttr('disabled');
					else
						$('.minus').attr('disabled', true);
				
			})
  };