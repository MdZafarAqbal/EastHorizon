@extends('admin_panel.layouts.master')

@section('country','East Horizon || Repair Create')

@section('main-content')

<div class="bg-light p-4 rounded">
        <h1>Add Repair Products</h1>
        <div class="container mt-4">
            <form method="POST" action="{{route('repair.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="user_name" class="form-label">User Name</label>
                    <input value="{{ old('user_name') }}" 
                        type="text" 
                        class="form-control" 
                        name="user_name" 
                        placeholder="Name" required>

                    @if ($errors->has('user_name'))
                        <span class="text-danger text-left">{{ $errors->first('user_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile No</label>
                    <input value="{{ old('mobile_no') }}"
                        type="number" 
                        class="form-control" 
                        name="mobile_no" 
                        placeholder="Mobile Number" required>
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
                        placeholder="Email Id" required>
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
                        placeholder="Serial No" required>
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
                        placeholder="IMEI No" required>
                    @if ($errors->has('imei_no'))
                        <span class="text-danger text-left">{{ $errors->first('imei_no') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="problem" class="form-label">Problem</label>
                    <input value="{{ old('problem') }}"
                        type="text" 
                        class="form-control" 
                        name="problem" 
                        placeholder="Problem" required>
                    @if ($errors->has('problem'))
                        <span class="text-danger text-left">{{ $errors->first('problem') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="charge" class="form-label">Charges</label>
                    <input value="{{ old('charge') }}"
                        type="text" 
                        class="form-control" 
                        name="charge" 
                        placeholder="Charges" required>
                    @if ($errors->has('charge'))
                        <span class="text-danger text-left">{{ $errors->first('charge') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo </label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images" >
                        </span>          
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('repair.index') }}" class="btn btn-default">Back</a>
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