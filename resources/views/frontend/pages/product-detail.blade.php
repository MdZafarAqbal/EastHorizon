@extends('frontend.layouts.master')
@section('title') {{$product->name}} - Product Detail || East Horizon @endsection

@push('styles')
  <link href="{{asset('frontend/css/product-detail.css')}}" rel="stylesheet">
@endpush

@section('main-content')
	<section id="product-detail" class="modal-content">	
		<div class="shazoom" id="shazoom">
			@if(count($product->images) != 0)
				<div class="img-box">
					<ul class="img-ul">
						@foreach($product->images as $image)
							<li><img src="{{('/images/products'.$image->name)}}"/></li>	
						@endforeach											
					</ul>
				</div>
				<div class="zoom-nav"></div>
				<!-- Nav Buttons -->
				<p class="zoom-btn">
					<a href="javascript:void(0);" class="zoom-prev-btn"> < </a>
					<a href="javascript:void(0);" class="zoom-next-btn"> > </a>
				</p>
			@endif
		</div>
	
		<div class="modal-details-container">
			<div class="product-modal-detail">
				<h1 class="title">{{$product->name}}</h1>
				<h1 class="title">{{$product->model_no}}</h1>
				
				@php
					$rate=ceil($product->reviews->avg('rate'));
				@endphp
			
				@for($i=1; $i<=5; $i++)
					@if($rate>=$i)
						<i class="fa-solid fa-star"></i>
								@else 
						<i class="fa-regular fa-star"></i>
					@endif
				@endfor
			
				<a href="#reviews" class="total-review">({{$product->reviews->count()}}) Review</a>
			
				<div id="modal-form">
					@php
						if(Auth::check())
						$wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();
					@endphp
					<div class="prices" id="price">					
						<h4>AED {{number_format($product->price,2)}}</h4>          
					</div>
					<input type="hidden" name="price-input" id="price-input" value="{{$product->price}}">									
					<div class="qty-manage" id="qty-manage">
						<input type="button" value="-" class="qty-minus minus qty-control" field="quantity" enabled>
						<input type="number" name="quantity" id="qty" class="qty" value="1" min="1" oninput="this.value = Math.abs(this.value)" disabled>
						<input type="button" value="+" class="qty-plus plus qty-control" field="quantity" enabled>
					</div>
					<div class="cart-btn-div" onclick="cartAdd({{$product->id}})">
						<button form="modal-cart-form" id="detail-cart-btn" class="cart-btn">
							<span class="add-to-cart">Add to Cart</span>
							<span class="added">Added</span>
							<i class="fas fa-shopping-cart"></i>
							<i class="fas fa-box"></i>
						</button>
					</div>
				</div>
			</div>
		</div>	
	</section>

  <section id="checkout-popup" class="checkout-popup">
    <div id="location-popup" class="ch-popup" data-toggle="0">
      <button type="button" class="btn close close-inner" id="inner-close-btn" onclick="remInnerModal()">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <button id="page-loc-btn" class="btn btn-submit popup-btn loc-btn" onclick="remInnerModal()">Stay on Page</button>
      @auth
        <button id="chkt-loc-btn" class="btn btn-submit popup-btn loc-btn" onclick="location.href = '/checkout'">Checkout</button>
      @else
        <button id="chkt-loc-btn" class="btn btn-submit popup-btn loc-btn" onclick="chOptions()">Checkout</button>
        <button id="guest-chkt-btn" class="btn btn-submit popup-btn chkt-btn collapse" onclick="location.href = '/checkout'">Checkout as Guest</button>
        <button id="login-chkt-btn" class="btn btn-submit popup-btn chkt-btn collapse" onclick="location.href = '/login?checkout=1'">Login to Checkout</button>
      @endauth
    </div>
  </section>
  
	<section class="details reviews"> 
		@php			
			$descriptions = explode('@', $product->description);
		@endphp
		
		<div class="details-review-div">
			<button id="details-btn" class="btn details-review-btn active-details-review" data-toggle="description" onclick="showDetail(this)">Details</button>
			<button id="reviews-btn" class="btn details-review-btn" data-toggle="reviews" onclick="showDetail(this)">Reviews</button>
		</div>
		
		<div class="tab-content" id="tab-content">
			<!-- Description Tab -->
			<div class="tab-panel" id="description">
				@if ($descriptions[0])
					<h3> Description: </h3>
          			@foreach($descriptions as $description)
					  <p class="desc-para">{{$description}}</p>
          			@endforeach
				@endif
			</div>
			<!-- End Description Tab -->

			<!-- Reviews Tab -->
			<div class="tab-panel collapse" id="reviews">
				<div class="add-review">
					<h3>Add Review</h3>
					<p>Your email address will not be published.</p>
				</div>
        
				<div class="review-inner">
					<h4>Your Rating</h4>

					@auth 
						<form class="form" method="post" action="{{route('review.store', $product->slug)}}"> 
							@csrf 
							<div class="rate">
								<input type="radio" id="star5" name="rate" value="5" />
								<label for="star5" title="text">5 stars</label>
								<input type="radio" id="star4" name="rate" value="4" />
								<label for="star4" title="text">4 stars</label>
								<input type="radio" id="star3" name="rate" value="3" />
								<label for="star3" title="text">3 stars</label>
								<input type="radio" id="star2" name="rate" value="2" />
								<label for="star2" title="text">2 stars</label>
								<input type="radio" id="star1" name="rate" value="1" />
								<label for="star1" title="text">1 star</label>
							</div>

							<div class="form-group">
								<textarea name="review" placeholder="Write a review"  rows="6" cols="50"></textarea>
							</div>

							<div class="form-review-btn">
								<button type="submit" class="btn ">Submit</button>
							</div>
						</form> 
					@else 
						<p class="review-auth-action"> 
							You need to <a href="{{route('login.form')}}" class="review-auth-link form-review-btn btn">Login</a> OR <a href="{{route('register.form')}}" class="review-auth-link form-review-btn btn">Register</a>
						</p>
					@endauth
				</div>

				<div class="user-reviews">
					<div class="prev-reviews">
						<h3>Reviews</h3>
					</div>
					@foreach($product->reviews as $data)
						<div class="single-rating">
							<div class="rating-author"> 
								
								<h4>{{$data->user['fname']}}</h4>
							</div>

							<div class="rating-des">
								<div class="ratings">
									<ul class="rating"> 
										@for($i=1; $i<=5; $i++) 
											@if($data->rating>=$i) 
												<li> <i class="fa-solid fa-star"></i> </li> 
											@else 
												<li> <i class="fa-regular fa-star"></i> </li> 
											@endif 
										@endfor 
									</ul>
									<span class="rate-count"> ( {{$data->rating}} ) </span>
								</div>
								<p>{{$data->review}}</p>
							</div>
						</div> 
					@endforeach
				</div>
			</div>
			<!--/ End Review -->
		</div>
	</section>
  

  @if(count($relproducts) != 0)
	<!-- Start Related Products -->
	<section class="products-area related-products">
		<div class="section-title">
			<h2>Related Products</h2>
		</div>

		<div class="products">
			<div class="product-slider carousel hero-slider"  data-flickity='{ "autoPlay": 3000, "contain": true, "pageDots": false, "initialIndex": 2 }'>
				@foreach($relproducts as $relproduct)
					@if($relproduct->id !== $product->id)
						@php
              
              			if(Auth::check())
                			$wishlist = $relproduct->wishlists()->where('user_id', Auth()->user()->id)->get();
						@endphp
						<div class="product-card {{$relproduct->id}}-card carousel-cell">
              				<a href="{{route('product-detail', $relproduct->slug)}}">
							  <img class="product-image" src="{{$relproduct->photo}}" alt="product image">
              				</a>

							<div class="meta-detail">
								<h3 class="product-title">{{$relproduct->name}}</h3>
               
                  				<p class="price">AED <span class="value">{{number_format($relproduct->price, 2)}}</span></p>
              						
              				</div>
							<div class="prod-detail-link">
								<a href="{{route('product-detail', $relproduct->slug)}}" class="btn btn-submit detail-link"> Product Details </a>
								@auth
                  					@if(count($wishlist) != 0)
                    					<button class="btn favbtn" onclick="fav(this, {{$relproduct->id}})"><i class="fa-solid fa-heart fav"></i></button>
                  					@else
                    					<button class="btn favbtn" onclick="fav(this, {{$relproduct->id}})"><i class="fa-regular fa-heart fav"></i></button>
                  					@endif
                				@else
									<button class="btn favbtn" onclick="window.location.href = '/login';"><i class="fa-regular fa-heart fav"></i></button>
								@endauth
							</div>
						</div>
					@endif
				@endforeach
			</div>
		</div>
	</section>
	<!-- End Related Products -->
  @endif
@endsection

@push('scripts')

	<script src="{{asset('frontend/js/product-detail.js')}}"></script>
	<script>

		price(<?= $product->id ?>);

		window.onload = function() {
		$(function() {
			shazoom();

    /* Actions when form is changed */
    $('[name="product-form"]').on('change', function() {
      let formId = $('[name="product-form"]:checked').val();

      createSizes(<?= $product->id ?>, formId);

      $('.cart-btn-div').css('width', 0);
      $('input.qty').val('1');
      $('.plus').attr('disabled', true);
      $('input.qty').attr('disabled', true)
      $('.minus').attr('disabled', true);
      price(<?= $product->id ?>);
    })

    /* Enable minus button when value of input quantity is greater than 1 and vice versa */
    $('input.qty').on('change', function() {
      if ($('input.qty').val() > 1)
        $('.minus').removeAttr('disabled');
      else
        $('.minus').attr('disabled', true);
    })
  })
}
		
	</script>
@endpush