@extends('frontend.layouts.master')
@section ('title', 'Checkout Order || East Horizon')

@push('styles')
  <link rel="stylesheet" href="{{asset('frontend/css/repair.css')}}">
@endpush

@section('main-content')
  <!-- Start Checkout -->
  <h1 class="title page-title">Repair</h1>

    <section class="shop-checkout checkout-sec">
      <!-- Form -->
      <div class="form-container">
        <form id="order-form" class="form" method="post" action="{{route('repair-store')}}" novalidate>
          @csrf
          <fieldset class="details">
            <legend>Repair Product Details</legend>
            <div class="fl-bl">
              <div class="form-group" id="first-name">
                <label for="user_name">Name<span>*</span></label>
                <input type="text" id="user_name" name="user_name" placeholder="First Name" value="@auth{{auth()->user()->fname}}@else{{old('fname')}}@endauth">
              </div>
            </div>
            <div class="form-group">
              <label for="mobile_no">Mobile No<span>*</span></label>
              <input type="number" name="mobile_no" id="mobile_no" placeholder="Mobile No" value="">

              @if ($errors->get('mobile_no'))
                <div class="error">
                  @error('mobile_no')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div>

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
              <label for="text">Product Name<span>*</span></label>
              <input type="text" name="product_name" id="product_name" placeholder="Product Name" value="">

              @if ($errors->get('product_name'))
                <div class="error">
                  @error('product_name')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div> 
            <div class="form-group">
              <label for="serial_no">Serial No</label>
              <input type="number" name="serial_no" id="serial_no" placeholder="Serial No" value="">

              @if ($errors->get('serial_no'))
                <div class="error">
                  @error('serial_no')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div>
            <div class="form-group">
              <label for="emei">EMEI</label>
              <input type="number" name="emei" id="emei" placeholder="EMEI" value="">

              @if ($errors->get('emei'))
                <div class="error">
                  @error('emei')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div>
            <div class="form-group">
              <label for="text">Problem</label>
              <input type="text" name="problem" id="problem" placeholder="Problem" value="">

              @if ($errors->get('problem'))
                <div class="error">
                  @error('problem')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div> 
            <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger"></span></label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]" multiple>
                        </span>          
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
          </fieldset>        
        </form>
    </section>
@endsection

