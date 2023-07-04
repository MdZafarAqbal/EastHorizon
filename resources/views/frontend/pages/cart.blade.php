@extends('frontend.layouts.master')
@section('title', 'Shopping Cart || East Horizon')

@push('styles')
  <link rel="stylesheet" href="{{asset('frontend/css/cart.css')}}">
@endpush

@section('main-content')
	<!-- Shopping Cart -->
  <h1 class="title page-title" id="cart-title">Shopping Cart</h1>

  <section class="cart-section">
    <div class="cart-page-items">
      @php
        $cart_products = Helper::getAllProductFromCart();
      @endphp
      
      @if($cart_products)

        @foreach($cart_products as $key=>$cart)
          <div class="cart-page-item">
            <img src="{{$cart->product['photo']}}" alt="product photo" class="cart-product-img zoom-img">
            <div class="cart-page-item-meta">
              <h2 class="cart-page-item-name">{{$cart->product['name']}}</h2>
              <div class="cart-page-item-price">
                <h4>Price: </h4>
                <p>AED {{number_format($cart->price, 2)}}</p>
              </div>
              <div class="cart-page-item-quantity">
                <h4>Quantity: </h4>
                <input type="button" value="-" class="qty-minus minus qty-control" field="quantity">
						    <input type="number" name="item_quantity" class="qty item-quantity" value="{{$cart->quantity}}" min="1" oninput="this.value = Math.abs(this.value)" onchange="updateCartData(<?= $cart->id ?>, this.value)">
						    <input type="button" value="+" class="qty-plus plus qty-control" field="quantity">
              </div>
            </div>
            @auth
              <div class="cart-discount">
                <h4>Discount: </h4>
                <p id="{{$cart->id}}-discount" class="cart-discount">AED {{number_format($cart->discount, 2)}}</p>
              </div>
            @endauth
            <div class="cart-page-item-data">
              <h4>Total: </h4> 
              <p id="{{$cart->id}}-total">AED {{number_format($cart->total, 2)}}</p>
            </div>
              <button class="remove-btn btn"><a href="{{route('cart-delete', $cart->id)}}"> Remove </a></button>
          </div>
        @endforeach

      @else
        <p>Sorry! Your cart is empty. Choose products <a href="{{route('home')}}"> here </a>!</p>
      @endif
    </div>

    <div class="cart-summary">
      @php
        $subtotal = Helper::CartAmount();
        $tax = Helper::totalCartTax();
        $discount = Helper::total_discount();
        $total_amount = Helper::totalCartAmount();
      @endphp

      <div class="summary-title-container">
        <h2>Cart Summary</h2>
      </div>
      
      <div class="cart-totals">
        <div class="cart-total-value">
          <h4 class="subtotal"> Subtotal: </h4>
          <p id="subtotal-value">AED {{number_format($subtotal, 2)}}</p>
        </div>
        <div class="cart-total-value">
          <h4 class="tax"> VAT(5%): </h4>
          <p id="tax-value">AED {{number_format($tax, 2)}}</p>
        </div>
        @auth
          <div class="cart-total-value">
            <h4 class="discount"> Discount: </h4>
            <p id="discount-value">AED {{number_format($discount, 2)}}</p>
          </div>
        @endauth
      </div>
        <div class="cart-total-value grand-total">
          <h4 class="total"> Grand Total: </h4>
          <p id="grand-total-value">AED {{number_format($total_amount, 2)}}</p>
        </div>
      <a href="{{route('checkout')}}" class="btn btn-checkout">Checkout</a>
    </div>
  </section>
@endsection

@push('scripts') 
  <script src="{{asset('frontend/js/cart.js')}}"></script>
@endpush
