<footer class="footer shop-footer" >
    @php 
        $setting = DB::table('settings')->first(); 
    @endphp
	<!-- Footer Top -->
	<div class="footer-top main-footer">				
		<div class="footer-about">
			<div class="logo">
				<a href="{{route('home')}}"><img src="{{$setting->logo}}" alt="#"></a>
			</div>
			<hr>

			<div class="footer-desc">
				<p class="desc-text">{{$setting->short_des}}</p>
			</div>
		</div>

		<div class="footer-menu">
			<div class="footer-info">
				<h3>Information</h3>
				<hr>
				<ul>
					<li><a href="{{route('about-us')}}">About Us</a></li>
					<li><a href="{{route('terms-and-conditions')}}">Terms & Conditions</a></li>
					<li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
					<li><a href="{{route('faq')}}">FAQ</a></li>
				</ul>
			</div>
      
			<div class="footer-loc">
        <div>
          <h3>Address</h3></div>
          <hr>
          <div>
          <ul>
            <li>{{$setting->address}}</li>
            <li><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
            <li><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></li>
          </ul>
        </div>
			</div>
		</div>
	</div>
	<!-- End Footer Top -->

	<div class="copyright">
		<p>Copyright &#169 {{date('Y')}} <a href="#" target="_blank">East Horizon</a>  -  All Rights Reserved.</p>
	</div>

	
</footer>
