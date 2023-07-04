@extends('frontend.layouts.master')
@section('title','East Horizon')

@push('styles')
  <link href="{{asset('frontend/css/index.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/css/modal.css')}}" rel="stylesheet">
@endpush

@section('main-content')
 
  @if(count($banners)>0)
    <section id="slider" class="slider">         
      <ul id="carousel-wrap" class="carousel-wrap">
        @foreach($banners as $banner)                                    
          <li>
            <picture>
              <source media="(min-width: 768px)" srcset="{{$banner->photo_desktop}}">
              <source media="(min-width: 480px)" srcset="{{$banner->photo_tablet}}">
              <img class="slide-img" src="{{$banner->photo_mobile}}" alt="Slider Image">
            </picture>
          </li>
        @endforeach
      </ul>

      <a href="#" id="slide-prev">&lt;</a>
      <a href="#" id="slide-next">&gt;</a>
    </section>
  @endif

  <section class="products-catalog">
    @php
      $auth = Auth::check();
    @endphp

    @if(count($pop_products) != 0)
      <div class="products">
        <h2 class="cat-title"> Popular Items </h2>
      
        <div class="product-slider carousel hero-slider"  data-flickity='{ "contain": true, "pageDots": false, "autoPlay": 3000}'>
          @foreach($pop_products as $product)
            @php         
              if($auth)
                $wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();
            @endphp
            <div class="product-card {{$product->id}}-card carousel-cell">
              <img class="product-image" src="{{$product->photo}}" alt="product image">
              
              <div class="overlay">
                <button id="pop{{$product->id}}" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, {{$product->id}})"> 
                  <i class="fa-regular fa-eye"></i>
                  <p>Quick View</p>
                </button>
              </div>

              <div class="meta-detail">
                <h4 class="card-product-title">{{$product->name}}</h4>   
                  <p class="price">AED <span class="value">{{number_format($product->price,2)}}</span></p>
              </div>
              <div class="prod-detail-link">
                <a href="{{route('product-detail', $product->slug)}}" class="btn btn-submit detail-link"> Product Details </a>
                @auth
                  @if(count($wishlist) != 0)
                    <button class="btn favbtn" onclick="fav(this, {{$product->id}})"><i class="fa-solid fa-heart fav"></i></button>
                  @else
                    <button class="btn favbtn" onclick="fav(this, {{$product->id}})"><i class="fa-regular fa-heart fav"></i></button>
                  @endif
                @else
                  <button class="btn favbtn" onclick="window.location.href = '/login';"><i class="fa-regular fa-heart fav"></i></button>
                @endauth
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    @if(count($trn_products) != null)
      <div class="products">
        <h2 class="cat-title"> Trending Items </h2>
      
        <div class="product-slider carousel hero-slider"  data-flickity='{ "contain": true, "pageDots": false, "autoPlay": 3000}'>
          @foreach($trn_products as $product)
            @php
              if($auth)
                $wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();
            @endphp
            <div class="product-card {{$product->id}}-card carousel-cell">
              <img class="product-image" src="{{$product->photo}}" alt="product image">
              
              <div class="overlay">
                <button id="trn{{$product->id}}" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, {{$product->id}})"> 
                  <i class="fa-regular fa-eye"></i>
                  <p>Quick View</p>
                </button>
              </div>

              <div class="meta-detail">
                <h4 class="card-product-title">{{$product->name}}</h4>
                <p class="price">AED <span class="value">{{number_format($product->price,2)}}</span></p>
              </div>
              <div class="prod-detail-link">
                <a href="{{route('product-detail', $product->slug)}}" class="btn btn-submit detail-link"> Product Details </a>
                
                @auth
                  @if(count($wishlist) != 0)
                    <button class="btn favbtn" onclick="fav(this, {{$product->id}})"><i class="fa-solid fa-heart fav"></i></button>
                  @else
                    <button class="btn favbtn" onclick="fav(this, {{$product->id}})"><i class="fa-regular fa-heart fav"></i></button>
                  @endif
                @else
                  <button class="btn favbtn" onclick="window.location.href = 'user/login';"><i class="fa-regular fa-heart fav"></i></button>
                @endauth
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
    @if(count($new_products) != 0)
      <div class="products">
        <h2 class="cat-title"> New Items </h2>
      
        <div class="product-slider carousel hero-slider"  data-flickity='{ "contain": true, "pageDots": false, "autoPlay": 3000}'>
          @foreach($new_products as $product)
            @php
              if($auth)
                $wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();
            @endphp
            <div class="product-card {{$product->id}}-card carousel-cell">
              <img class="product-image" src="{{$product->photo}}" alt="product image">
              
              <div class="overlay">
                <button id="new{{$product->id}}" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, {{$product->id}})"> 
                  <i class="fa-regular fa-eye"></i>
                  <p>Quick View</p>
                </button>
              </div>

              <div class="meta-detail">
                <h4 class="card-product-title">{{$product->name}}</h4>
                <p class="price">AED <span class="value">{{number_format($minprice,2)}}</span></p>
              </div>
              <div class="prod-detail-link">
                <a href="{{route('product-detail', $product->slug)}}" class="btn btn-submit detail-link"> Product Details </a>
                @auth
                  @if(count($wishlist) != 0)
                    <button class="btn favbtn" onclick="fav(this, {{$product->id}})"><i class="fa-solid fa-heart fav"></i></button>
                  @else
                    <button class="btn favbtn" onclick="fav(this, {{$product->id}})"><i class="fa-regular fa-heart fav"></i></button>
                  @endif
                @else
                  <button class="btn favbtn" onclick="window.location.href = 'user/login';"><i class="fa-regular fa-heart fav"></i></button>
                @endauth
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    
    <div id="modal-container" class="modal-container"></div>
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
	</section>
@endsection

@push('scripts')
  <script src="{{asset('frontend/js/index.js')}}"></script>
  <script src="{{asset('frontend/js/modal.js')}}"></script>
@endpush
