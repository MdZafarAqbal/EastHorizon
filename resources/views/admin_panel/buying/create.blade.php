@extends('admin_panel.layouts.master')

@section('country','East Horizon || Country Create')

@section('main-content')

<div class="bg-light p-4 rounded">
        <h1>Add Buy Details</h1>
        <div class="container mt-4">
            <form method="POST" action="{{route('buying.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="buying_name" class="form-label">Name</label>
                    <input value="{{ old('buying_name') }}" 
                        type="text" 
                        class="form-control" 
                        name="buying_name" 
                        placeholder="Name" required>

                    @if ($errors->has('buying_name'))
                        <span class="text-danger text-left">{{ $errors->first('buying_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile No</label>
                    <input value="{{ old('mobile_no') }}"
                        type="number" 
                        class="form-control" 
                        name="mobile_no" 
                        placeholder="Mobile Number" >
                    @if ($errors->has('mobile_no'))
                        <span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Id</label>
                    <input value="{{ old('email') }}"
                        type="number" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email Id" >
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input value="{{ old('product_name') }}"
                        type="text" 
                        class="form-control" 
                        name="product_name" 
                        placeholder="Product Name" required>
                    @if ($errors->has('product_name'))
                        <span class="text-danger text-left">{{ $errors->first('product_name') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="serial_no" class="form-label">Serial No</label>
                    <input value="{{ old('serial_no') }}"
                        type="text" 
                        class="form-control" 
                        name="serial_no" 
                        placeholder="Serial No" >
                    @if ($errors->has('serial_no'))
                        <span class="text-danger text-left">{{ $errors->first('serial_no') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="imei_no" class="form-label">IMEI No</label>
                    <input value="{{ old('imei_no') }}"
                        type="text" 
                        class="form-control" 
                        name="imei_no" 
                        placeholder="IMEI No" >
                    @if ($errors->has('imei_no'))
                        <span class="text-danger text-left">{{ $errors->first('imei_no') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input value="{{ old('qty') }}"
                        type="text" 
                        class="form-control" 
                        name="qty" 
                        placeholder="Quantity" required>
                    @if ($errors->has('qty'))
                        <span class="text-danger text-left">{{ $errors->first('qty') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input value="{{ old('price') }}"
                        type="text" 
                        class="form-control" 
                        name="price" 
                        placeholder="Price" required>
                    @if ($errors->has('price'))
                        <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('buying.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('admin_panel/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('admin_panel/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush