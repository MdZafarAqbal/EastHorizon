@if ($message = Session::get('success'))
  <div class="flash-success flash-message">
    <p>{{ $message }}</p>
  </div>
@endif
@if ($message = Session::get('error'))
  <div class="flash-error flash-message">
    <p>{{ $message }}</p>
  </div>
@endif
@if ($message = Session::get('warning'))
  <div class="flash-warning flash-message">
    <p>{{ $message }}</p>
  </div>
@endif
@if ($message = Session::get('info'))
  <div class="flash-info flash-message">
    <p>{{ $message }}</p>
  </div>
@endif
