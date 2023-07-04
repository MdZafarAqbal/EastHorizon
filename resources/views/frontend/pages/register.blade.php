<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <title>Sign Up || East Horizon</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&family=Vollkorn:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap">

    <!-- Boxicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css">

    <!-- East Horizon StyleSheet -->
    <link href="{{asset('frontend/css/signin-up.css')}}" rel="stylesheet">
  </head>

  <body>
    <section class="shop-signing register">
      <div class="signing-img-container"></div>

      <div class="signing-form-container">
        @include('frontend.layouts.flash-message')

        <!-- <a href="{{route('home')}}"><img src="{{asset('images/logo_green.png')}}" alt="East Horizon Website Logo" class="signing-web-logo"></a> -->
        <h1 class="signing-web-title"><a href="{{route('home')}}">East Horizon</a></h1>
        <h2>Sign Up</h2>

        <!-- Form -->
        <form class="form" method="post" action="{{route('register.submit')}}" novalidate>
          @csrf

          <fieldset class="type-selection">
            <legend>User</legend>
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
            <legend>Details</legend>
            <div class="fl-bl">
              <div class="form-group" id="first-name">
                <div class="form-input">
                  <input type="text" id="fname" name="fname" placeholder="First Name" value="{{ old('fname') }}">
                  <label for="fname">First Name</label>
                </div>
                
                @if ($errors->get('fname'))
                <div class="error">
                  @error('fname')
                  {!! $message !!}
                  @enderror
                </div>
                @endif
              </div>
              
              <div class="form-group" id="last-name">
                <div class="form-input">
                  <input type="text" id="lname" name="lname" placeholder="Last Name" value="{{ old('lname') }}">
                  <label for="lname">Last Name</label>
                </div>
                
                @if ($errors->get('lname'))
                  <div class="error">
                    @error('lname')
                      {!! $message !!}
                    @enderror
                  </div>
                @endif
              </div>
              
              <div class="form-group collapse" id="company-name">
                <div class="form-input">
                  <input type="text" id="cname" name="cname" placeholder="Company Name">
                  <label for="cname">Company Name</label>
                </div>
                
              @if ($errors->get('cname'))
                <div class="error">
                  @error('cname')
                  {{$message}}
                  @enderror
                </div>
              @endif
              </div>
              
              <div class="form-group collapse" id="trn">
                <div class="form-input">
                  <input type="number" id="trn-no" name="trn_no" placeholder="TRN Number">
                  <label for="trn-no">TRN Number</label>
                </div>
                  
                @if ($errors->get('trn_no'))
                  <div class="error">
                    @error('trn_no')
                      {{$message}}
                    @enderror
                  </div>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="form-input">
                <input type="email" name="email" id="email" placeholder="someone@domain.com" value="{{ old('email') }}" required>
                <label for="email">Email</label>
              </div>

              @if ($errors->get('email'))
                <div class="error">
                  @error('email')
                    {{$message}}
                  @enderror
                </div>
              @endif
            </div>

            <div class="fl-bl">
              <div class="form-group">
                <div class="form-input">
                  <input type="password" name="password" id="password" placeholder="Enter Password">
                  <label for="password">Password</label>
                </div>
              </div>

              <div class="form-group">
                <div class="form-input">
                  <input type="password" name="password_confirmation" id="confirm-password" placeholder="Confirm Password">
                  <label for="confirm-password">Confirm Password</label>
                </div>
              </div>
            </div>

            @if ($errors->get('password'))
              <div class="error">
                @error('password')
                  {!! $message !!}
                @enderror
              </div>
            @endif
          </fieldset>

          <button type="submit" class="btn signing-btn">Register</button>
        </form>
        <p>Already Registered? <a href="{{route('login.form')}}" class="btn">Log In</a></p>
        <p>Goto <a href="{{route('home')}}" class="btn">Homepage</a></p>
        <!--/ End Form -->
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="{{asset('frontend/js/register.js')}}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NH2TVFJYP0"></script>
    <script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-NH2TVFJYP0");</script>
  </body>
</html>
