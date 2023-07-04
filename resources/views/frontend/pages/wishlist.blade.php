@extends('frontend.layouts.master')
@section('title','Wishlist Products || East Horizon')

@push('styles')
  <link href="{{asset('frontend/css/products.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/css/modal.css')}}" rel="stylesheet">
@endpush

@section('main-content')
  <section class="products-catalog">
    <div id="products-catalog" class="products catalog">
      @if($products->count() > 0)
        @foreach($products as $product)
          @php
            $minprice = $product->attrs()->min('price');
            $maxprice = $product->attrs()->max('price');
          @endphp
              <div class="product-card {{$product->id}}-card carousel-cell">
                <img class="product-image" src="{{$product->photo}}" alt="product image">
                
                <div class="overlay">
                  <button id="product{{$product->id}}" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, {{$product->id}})"> 
                    <i class="fa-regular fa-eye"></i>
                    <p>Quick View</p>
                  </button>
                </div>

                <div class="meta-detail">
                  <h3 class="product-title">{{$product->name}}</h3>
                  @if($minprice==$maxprice)
                    <p class="price">AED <span class="value">{{number_format($product->minprice,2)}}</span></p>
                  @else
                    <p class="price">AED <span class="value">{{number_format($product->minprice,2)}}</span> - AED <span class="value">{{number_format($maxprice,2)}}</span></p>
                  @endif                  
                </div>
                <div class="prod-detail-link">
                  <a href="{{route('product-detail', $product->slug)}}" class="btn btn-submit detail-link"> Product Details </a>
                  <button class="remove-btn btn"><a href="{{route('wishlist-delete', ['id' => $product->id, 'reload' => 1])}}"> Remove </a></button>
                </div>
              </div>
          @endforeach
      @else
        <p class="no-product">There is no product in the wishlist.</p>
      @endif
    </div>
    <div class="modal-container" id="modal-container"></div>
    <section id="checkout-popup" class="checkout-popup">
      <div id="location-popup" class="ch-popup" data-toggle="0" tabindex="-1">
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
  <script src="{{asset('frontend/js/products.js')}}"></script>
  <script src="{{asset('frontend/js/modal.js')}}"></script>
@endpush