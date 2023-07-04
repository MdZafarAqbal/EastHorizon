@extends('admin_panel.layouts.master')

@section('main-content')

<div class="bg-light p-4 rounded">
        <h1>Update repair products</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route('seller.update', $seller->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="seller_name" class="form-label">Seller Name</label>
                    <input value="{{ $seller->seller_name }}" 
                        type="text" 
                        class="form-control" 
                        name="seller_name" 
                        placeholder="Seller Name" required>

                    @if ($errors->has('seller_name'))
                        <span class="text-danger text-left">{{ $errors->first('seller_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile No</label>
                    <input value="{{ $seller->mobile_no }}"
                        type="mobile_no" 
                        class="form-control" 
                        name="mobile_no" 
                        placeholder="Mobile Number">
                    @if ($errors->has('mobile_no'))
                        <span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input value="{{ $seller->product_name }}"
                        type="text" 
                        class="form-control" 
                        name="product_name" 
                        placeholder="Product Name" >
                    @if ($errors->has('product_name'))
                        <span class="text-danger text-left">{{ $errors->first('product_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="serial_no" class="form-label">Serial No</label>
                    <input value="{{ $seller->serial_no }}"
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
                    <input value="{{ $seller->imei_no }}"
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
                    <input value="{{ $seller->qty }}"
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
                    <input value="{{ $seller->price }}"
                        type="text" 
                        class="form-control" 
                        name="price" 
                        placeholder="Charge" required>
                    @if ($errors->has('price'))
                        <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('seller.index') }}" class="btn btn-default">Cancel</button>
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