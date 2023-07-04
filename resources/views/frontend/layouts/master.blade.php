<!DOCTYPE html>
<html lang="en-us">
  <head>
		@include('frontend.layouts.head')	
  </head>
  <body>
		<!-- Header -->
		@include('frontend.layouts.header')
		<!-- End Header -->

    @include('frontend.layouts.flash-message')
    
    <section id="main-content">
		  @yield('main-content')
    </section>

		<!-- Footer -->
		@include('frontend.layouts.footer')
		<!-- End Footer -->

		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
		<script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.2/jquery.typeahead.min.js"></script>
		<script src="{{asset('frontend/js/jquery.exzoom.js')}}"></script>
		<script src="{{asset('frontend/js/header.js')}}"></script>
		<script src="{{asset('frontend/js/main.js')}}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NH2TVFJYP0"></script>
    <script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-NH2TVFJYP0");</script>
		@stack('scripts')
		<!-- End Scripts -->
  </body>
</html>