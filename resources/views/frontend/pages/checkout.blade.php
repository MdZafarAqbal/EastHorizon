@extends('frontend.layouts.master')
@section ('title', 'Checkout Order || East Horizon')

@push('styles')
  <link rel="stylesheet" href="{{asset('frontend/css/checkout.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/css/loader.css')}}">
@endpush

@section('main-content')
  <!-- Start Checkout -->
  <h1 class="title page-title">Checkout</h1>

  @php
    $countries = DB::table('countries')->where('status', 'active')->get();
    $states = DB::table('states')->where('country_id', '784')->get();
    $subtotal = Helper::CartAmount();
    $tax = Helper::totalCartTax();
    $discount = Helper::total_discount();
    $total = Helper::totalCartAmount();
    $order_success = Session::get('order_success');
    $order_no = Session::get('order_no');
  @endphp

  @if($total != 0 || $order_success)
    @guest
      <p class="checkout-para">Please register in order to checkout more quickly.</p>
    @endguest

    <section class="shop-checkout checkout-sec">
      <!-- Form -->
      <div class="form-container">
        <form id="order-form" class="form" method="post" action="{{route('order')}}" novalidate>
          @csrf
          <fieldset class="type-selection">
            <legend>Customer</legend>
            <div class="form-group">
              <input type="radio" name="cust_type" id="individual" value="individual" checked>
              <label for="individual">Individual</label>
            </div>
            
            <div class="form-group">
              <input type="radio" name="cust_type" id="company" value="company">
              <label for="company">Company</label>
            </div>

            @if ($errors->get('cust_type'))
              <div class="error">
                @error('cust_type')
                  {{$message}}
                @enderror
              </div>
            @endif
          </fieldset>

          <fieldset class="details">
            <legend>Invoice Details</legend>
            <div class="fl-bl">
              <div class="form-group" id="first-name">
                <label for="fname">First Name<span>*</span></label>
                <input type="text" id="fname" name="fname" placeholder="First Name" value="@auth{{auth()->user()->fname}}@else{{old('fname')}}@endauth">
              </div>

              <div class="form-group collapse" id="company-name">
                <label for="cname">Company Name<span>*</span></label>
                <input type="text" id="cname" name="cname" placeholder="Company Name" value="@auth{{auth()->user()->cname}}@else{{old('cname')}}@endauth">
              </div>

              <div class="form-group" id="last-name">
                <label for="lname">Last Name<span>*</span></label>
                <input type="text" id="lname" name="lname" placeholder="Last Name" value="@auth{{auth()->user()->lname}}@else{{old('lname')}}@endauth">
              </div>

              <div class="form-group collapse" id="trn">
                <label for="trn-number">TRN<span>*</span></label>
                <input type="number" id="trn-number" name="trn_no" placeholder="TRN Number" value="@auth{{auth()->user()->trn_no}}@else{{old('trn_no')}}@endauth">
              </div>
            </div>

            @if ($errors->get('fname'))
              <div class="error">
                @error('fname')
                  {!! $message !!}
                @enderror
              </div>
            @endif

            @if ($errors->get('lname'))
              <div class="error">
                @error('lname')
                  {!! $message !!}
                @enderror
              </div>
            @endif

            @if ($errors->get('cname'))
              <div class="error">
                @error('cname')
                  {{$message}}
                @enderror
              </div>
            @endif

            @if ($errors->get('trn_no'))
              <div class="error">
                @error('trn_no')
                  {{$message}}
                @enderror
              </div>
            @endif

            <div class="form-group">
              <label for="email">Email Address<span>*</span></label>
              <input type="email" name="email" id="email" placeholder="Email Address" value="@auth{{auth()->user()->email}}@else{{old('email')}}@endauth">

              @if ($errors->get('email'))
                <div class="error">
                  @error('email')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div>

            <div class="form-group">
              <label for="address">Address<span>*</span></label>
              <input type="text" name="address" id="address" placeholder="Address" value="{{old('address')}}">

              @if ($errors->get('address'))
                <div class="error">
                  @error('address')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div>


            <div class="fl-bl">
              <div class="form-group">
                <label for='landmark'>Nearby Landmark</label>
                <input type="text" name="landmark" id="landmark" placeholder="Landmark" value="{{old('landmark')}}">
              </div>

              <div id="country-form-group" class="form-group">
                <label for="country">Country<span>*</span></label>
                <input type="hidden" name="country" id="country" value="784">
                <div id="country-div" class="dropdown-selection" tabindex="0">
                  <div id="country-name">United Arab Emirates</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="countries" class="selection-list collapse" tabindex="-1">
                    @foreach($countries as $country)
                      <li id="country-{{$country->id}}" data-iso="{{$country->iso_code}}" data-call-code="{{$country->calling_code}}" onclick="country(this, {{$country->id}})">{{$country->name}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

            @if ($errors->get('landmark'))
              <div class="error">
                @error('landmark')
                  {{$message}}
                @enderror
              </div>
            @endif
            
            @if ($errors->get('country'))
              <div class="error">
                @error('country')
                  {{$message}}
                @enderror
              </div>
            @endif

            <div class="fl-bl">
              <div id="state-form-group" class="form-group">
                <label for="state">State<span>*</span></label>
                <input type="hidden" name="state" id="state">
                <div id="state-div" class="dropdown-selection" tabindex="0">
                  <div id="state-name" class="select-placeholder">State</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="states" class="selection-list collapse" tabindex="-1">
                    @foreach($states as $state)
                      <li id="state-{{$state->id}}" data-state="{{$state->id}}" data-country="784" onclick="state(this)">{{$state->name}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>

              <div id="city-form-group" class="form-group">
                <label for="city">City<span>*</span></label>
                <input type="hidden" placeholder="City" name="city" id="city">
                <div id="city-div" class="dropdown-selection" tabindex="0">
                  <div id="city-name" class="select-placeholder">City</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="cities" class="selection-list collapse" tabindex="-1"></ul>
                </div>
              </div>
            </div>

            @if ($errors->get('state'))
              <div class="error">
                @error('state')
                  {{$message}}
                @enderror
              </div>
            @endif
            
            @if ($errors->get('city'))
              <div class="error">
                @error('city')
                  {{$message}}
                @enderror
              </div>
            @endif

            <div class="fl-bl">
              <div class="form-group">
                <label for="phone">Phone Number <span>*</span></label>
                <div class="phone-div">
                  <img class="flag-img flag" src="{{asset('images/flags/AE.png')}}" alt="Country Flag Image" width="64">
                  <p class="call-code">+971</p>
                  <input type="tel" name="phone" id="phone" placeholder="50 123 4567" value="{{old('phone')}}">
                </div>
              </div>

              <div class="form-group">
                <label for="phone">Phone Number <sup class='optional'>(Optional)</sup></label>
                <div class="phone-div">
                  <img class="flag-img flag" src="{{asset('images/flags/AE.png')}}" alt="Country Flag Image" width="64">
                  <p class="call-code">+971</p>
                  <input type="tel" name="altphone" id="altphone" placeholder="50 123 4567" value="{{old('altphone')}}">
                </div>
              </div>
            </div>

            @if ($errors->get('phone'))
              <div class="error">
                @error('phone')
                  {{$message}}
                @enderror
              </div>
            
            @elseif ($errors->get('altphone'))
              <div class="error">
                @error('altphone')
                  {{$message}}
                @enderror
              </div>
            @endif

          </fieldset>

          <fieldset class="details">
            <legend>Shipping Details</legend>
            <h5>Same As Above?</h5>
            <div class="type-selection">
              <div class="form-group">
                <input type="radio" name="shipping_option" id="same" value="same" checked>
                <label for="same">Yes</label>
              </div>
              
              <div class="form-group">
                <input type="radio" name="shipping_option" id="different" value="different">
                <label for="different">No</label>
              </div>
            </div>

            <div id="shipping-details" class="collapse">
              <div class="fl-bl">
                <div class="form-group" id="shipping-first-name">
                  <label for="shipping-fname">First Name<span>*</span></label>
                  <input type="text" id="shipping-fname" name="shipping_fname" placeholder="First Name" value="{{old('shipping_fname')}}">
                </div>

                <div class="form-group" id="shipping-last-name">
                  <label for="shipping-lname">Last Name<span>*</span></label>
                  <input type="text" id="shipping-lname" name="shipping_lname" placeholder="Last Name" value="{{old('shipping_lname')}}">
                </div>
              </div>

              @if ($errors->get('shipping_fname'))
                <div class="error">
                  @error('shipping_fname')
                    {{$message}}
                  @enderror
                </div>
              @endif

              @if ($errors->get('shipping_lname'))
                <div class="error">
                  @error('shipping_lname')
                    {{$message}}
                  @enderror
                </div>
              @endif

              <div class="form-group">
                <label for="shipping-address">Address<span>*</span></label>
                <input type="text" name="shipping_address" id="shipping-address" placeholder="Shipping Address" value="{{old('shipping_address')}}">

                @if ($errors->get('shipping_address'))
                  <div class="error">
                    @error('shipping_address')
                      {{$message}}
                    @enderror
                  </div>
                @endif
              </div>

              <div class="fl-bl">
                <div class="form-group">
                  <label for="shipping-landmark">Nearby Landmark</label>
                  <input type="text" name="shipping_landmark" id="shipping-landmark" placeholder="Nearby Landmark" value="{{old('shipping_landmark')}}">
                </div>

                <div id="shipping-country-form-group" class="form-group">
                <label for="shipping-country">Country<span>*</span></label>
                <input type="hidden" name="shipping_country" id="shipping-country" value="784">
                <div id="shipping-country-div" class="dropdown-selection" tabindex="0">
                  <div id="shipping-country-name">United Arab Emirates</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="shipping-countries" class="selection-list collapse" tabindex="-1">
                    @foreach($countries as $country)
                      <li id="shipping-country-{{$country->id}}" class="shipping" data-iso="{{$country->iso_code}}" data-call-code="{{$country->calling_code}}" onclick="country(this, {{$country->id}})">{{$country->name}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>

              @if ($errors->get('shipping_landmark'))
                <div class="error">
                  @error('shipping_landmark')
                    {{$message}}
                  @enderror
                </div>
              @endif
              
              @if ($errors->get('shipping_country'))
                <div class="error">
                  @error('shipping_country')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div>

            <div class="fl-bl">
              <div id="shipping-state-form-group" class="form-group">
                <label for="shipping-state">State<span>*</span></label>
                <input type="hidden" name="shipping_state" id="shipping-state">
                <div id="shipping-state-div" class="dropdown-selection" tabindex="0">
                  <div id="shipping-state-name" class="select-placeholder">State</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="shipping-states" class="selection-list collapse" tabindex="-1">
                    @foreach($states as $state)
                      <li id="shipping-state-{{$state->id}}" class="shipping" data-state="{{$state->id}}" data-country="784" onclick="state(this)">{{$state->name}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>

              <div id="shipping-city-form-group" class="form-group">
                <label for="shipping-city">City<span>*</span></label>
                <input type="hidden" placeholder="City" name="shipping_city" id="shipping-city">
                <div id="shipping-city-div" class="dropdown-selection" tabindex="0">
                  <div id="shipping-city-name" class="select-placeholder">City</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="shipping-cities" class="selection-list collapse" tabindex="-1"></ul>
                </div>
              </div>
            </div>

            @if ($errors->get('shipping_state'))
              <div class="error">
                @error('shipping_state')
                  {{$message}}
                @enderror
              </div>
            @endif
            
            @if ($errors->get('shipping_city'))
              <div class="error">
                @error('shipping_city')
                  {{$message}}
                @enderror
              </div>
            @endif

            <div class="fl-bl">
              <div class="form-group">
                <label for="phone">Phone Number <span>*</span></label>
                <div class="phone-div">
                  <img class="shipping-flag-img flag" src="{{asset('images/flags/AE.png')}}" alt="Country Flag Image" width="64">
                  <p class="shipping-call-code">+971</p>
                  <input type="tel" name="shipping_phone" id="shipping-phone" placeholder="50 123 4567" value="{{old('shipping_phone')}}">
                </div>
              </div>

              <div class="form-group">
                <label for="phone">Phone Number <sup class='optional'>(Optional)</sup></label>
                <div class="phone-div">
                  <img class="shipping-flag-img flag" src="{{asset('images/flags/AE.png')}}" alt="Country Flag Image" width="64">
                  <p class="shipping-call-code">+971</p>
                  <input type="tel" name="shipping_altphone" id="shipping-altphone" placeholder="50 123 4567" value="{{old('shipping_altphone')}}">
                </div>
              </div>
            </div>

            @if ($errors->get('shipping_phone'))
              <div class="error">
                @error('shipping_phone')
                  {{$message}}
                @enderror
              </div>

            @elseif ($errors->get('shipping_altphone'))
              <div class="error">
                @error('shipping_altphone')
                  {{$message}}
                @enderror
              </div>
            @endif
          </fieldset>

          <fieldset class="payment-mthd type-selection">
            <legend>Payment Method</legend>
            <div class="form-group">
              <input type="radio" name="pay_mthd" id="op-input" value="op" checked>
              <label for="op-input">Online Payment</label>
            </div>
            <div class="form-group">
              <input type="radio" name="pay_mthd" id="cod-input" value="cod">
              <label for="cod-input">Cash on Delivery</label>
            </div>
          </fieldset>

          <fieldset class="op-form" id="op-form">
            <legend>Online Payment</legend>
            <div class="fl-bl">
              <div class="form-group">
                <label for="account-no">Card Number</label>
                <input type="tel" id="account-no" class="account-no"  name="account_no"  placeholder="4242 4242 4242 4242" onkeypress="cardLen(this, event)" oninput="cardNum(this, event)" autocomplete="on">
              </div>
              
              <div class="form-group">
                <label for="account-name">Full Name</label>
                <input type="text" id="account-name" class="account-name" name="account_name" placeholder="Full Name (As per Card)" autocomplete="on">
              </div>
            </div>

            @if ($errors->get('account_no'))
              <div class="error">
                @error('account_no')
                  {{$message}}
                @enderror
              </div>
            @endif
            
            @if ($errors->get('account_name'))
              <div class="error">
                @error('account_name')
                  {!! $message !!}
                @enderror
              </div>
            @endif

            <div class="fl-bl">
              <div class='form-group expiry'>
                <label for="expiry-month">Expiry Month</label>
                <input type="number" class='expiry-month' id='expiry-month' name="expiry_month" placeholder='MM'>
              </div>
              
              <div class='form-group expiry'>
                <label for="expiry-year">Expiry Year</label>
                <input type="number" class='expiry-year' id='expiry-year' name="expiry_year" min= "@php echo date('Y'); @endphp" placeholder='YYYY'>
              </div>

              <div class="form-group cvc">
                <label for="cvv-cvc">CVV/CVC</label>
                <input type="password" id="cvv-cvc" class="cvv-cvc" name="cvv_cvc" placeholder="CVV/CVC" pattern="[0-9]{3}" onkeypress="if(this.value.length == 3) return false;" autocomplete="off">
              </div>
            </div>

            @if ($errors->get('expiry_month'))
              <div class="error">
                @error('expiry_month')
                  {{$message}}
                @enderror
              </div>
            @endif

            @if ($errors->get('expiry_year'))
              <div class="error">
                @error('expiry_year')
                  {{$message}}
                @enderror
              </div>
            @endif

            @if ($errors->get('cvv_cvc'))
              <div class="error">
                @error('cvv_cvc')
                  {{$message}}
                @enderror
              </div>
            @endif

            <div class="payment-options">
              <img src="{{('admin_panel/img/payment-method.png')}}" alt="payment options">
            </div>
          </fieldset>
          <input type="submit" class="btn btn-checkout btn-plc" value="Place Order">
        </form>
      </div>

      <div class="order-summary">
        <div class="sums-summary">
          <div class="summary-title-container">
            <h2>Order Summary</h2>
          </div>
          <div class="cart-totals">
            <div class="cart-total-value">
              <h4 class="subtotal" data-price="{{Helper::CartAmount()}}"> Subtotal: </h4>
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
            <div class="cart-total-value">
              <h4 class="shopping"> Shipping: </h4>
              <p id="shipping-value">AED 0.00</p>
            </div>
          </div>
        
          <div class="cart-total-value grand-total">
            <h4 class="total"> Grand Total: </h4>
            <p id="grand-total-value" data-total={{$total}}>AED {{number_format($total, 2)}}</p>
          </div>
          <input type="submit" form="order-form" class="btn btn-checkout" value="Place Order">
        </div>
        <div class="cart" id="cart-summary">
          @php
            $cart_products = Helper::getAllProductFromCart();
          @endphp

          @if($cart_products)
          <div class="summary-title-container">
            <h2>Cart Summary</h2>
          </div>
          @foreach($cart_products as $cart)
          <div class="cart-item">
            <img src="{{$cart->product['photo']}}" alt="product photo" class="cart-product-img zoom-img">
            <div class="cart-item-meta">
              <h2 class="cart-page-item-name">{{$cart->product['name']}}</h2>
              <div class="cart-item-stats">
                <div class="cart-page-item-price">
                  <h4>Price: </h4>
                  <p>AED {{number_format($cart->price, 2)}}</p>
                </div>
                <div class="cart-page-item-form">
                  <h4>Form: </h4>
                  <p>{{$cart->form}}</p>
                </div>
                <div class="cart-page-item-size">
                  <h4>Size: </h4>
                  <p>{{$cart->size}}</p>
                </div>
                <div class="cart-page-item-quantity">
                  <h4>Quantity: </h4>
                  <p>{{$cart->quantity}}</p>
                </div>
                <div class="cart-page-item-total">
                  <h4>Total: </h4>
                  <p id="{{$cart->id}}-total">AED {{number_format($cart->total, 2)}}</p>
                </div>
              </div>
            </div>
          </div>
          @endforeach

          @else
          <p>Sorry! Your cart is empty. Choose products <a href="{{route('home')}}"> here </a>!</p>
          @endif
        </div>
      </div>
    </section>

    <section class="loader-section popup-sec collapse">
      <div class="popup-container loader-container">
        <div class="loader">
          <div class="box box0">
            <div></div>
          </div>
          <div class="box box1">
            <div></div>
          </div>
          <div class="box box2">
            <div></div>
          </div>
          <div class="box box3">
            <div></div>
          </div>
          <div class="box box4">
            <div></div>
          </div>
          <div class="box box5">
            <div></div>
          </div>
          <div class="box box6">
            <div></div>
          </div>
          <div class="box box7">
            <div></div>
          </div>
          <div class="ground">
            <div></div>
          </div>
        </div>
      </div>
    </section>

    <section class="popup-sec order-success collapse">
      <div class="popup-container">
        <h3>Your order has been placed!</h3>
        <i class='bx bxs-check-circle bx-tada'></i>
        <p>Thankyou for your purchase!</p>
        <p>Your order number is: <span id="order-no"></span></p>
        <p>You have received an order confirmation email with details of your order.</p>
        <a href="{{route('home')}}" class="btn btn-submit"> Continue Shopping </a>
      </div>
    </section>

  @else
    <h4>Please add items to cart to proceed further. <a href="{{route('home')}}">Continue Shopping</a></h4>
  @endif
@endsection

@push('scripts')
<script src="{{asset('frontend/js/checkout.js')}}"></script>

@if($order_success)
  <script>
    $(document).ready(function() {
      $('body').css('height', '90vh');
      $('body').css('overflow', 'hidden');
      $('.order-success').removeClass('collapse');
      $('#order-no').html('<?= $order_no ?>');
    });
  </script>
@endif

@endpush