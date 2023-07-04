@extends('frontend.layouts.master')
@section('title','Contact Us, Shops Locations || East Horizon')

@push('styles')
  <link href="{{asset('frontend/css/contact.css')}}" rel="stylesheet">
@endpush

@section('main-content')


<div id="rolla" class="store-location">
  <h2>Naif.</h2>
  <p>Monday - Sunday | 10:30 AM - 10:30 PM</p>
  <p>naif road, Dubai, UAE</p>
  <div style="width: 40%"><iframe src="https://goo.gl/maps/am2T2F3HPsgHnM139" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div> 
</div>
@endsection