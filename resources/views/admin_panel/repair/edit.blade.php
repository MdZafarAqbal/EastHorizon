@extends('admin_panel.layouts.master')

@section('main-content')

<div class="bg-light p-4 rounded">
        <h1>Update repair products</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="{{ route('repair.update', $repair->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="user_name" class="form-label">Name</label>
                    <input value="{{ $repair->user_name }}" 
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
                    <input value="{{ $repair->mobile_no }}"
                        type="mobile_no" 
                        class="form-control" 
                        name="mobile_no" 
                        placeholder="Mobile Number" required>
                    @if ($errors->has('mobile_no'))
                        <span class="text-danger text-left">{{ $errors->first('mobile_no') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input value="{{ $repair->product_name }}"
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
                    <input value="{{ $repair->serial_no }}"
                        type="text" 
                        class="form-control" 
                        name="serial_no" 
                        placeholder="Serial No" required>
                    @if ($errors->has('serial_no'))
                        <span class="text-danger text-left">{{ $errors->first('serial_no') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="charge" class="form-label">Charge</label>
                    <input value="{{ $repair->charge }}"
                        type="text" 
                        class="form-control" 
                        name="charge" 
                        placeholder="Charge" required>
                    @if ($errors->has('charge'))
                        <span class="text-danger text-left">{{ $errors->first('charge') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail1" data-preview="holder_tablet" class="btn btn-primary lfm">
                            <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="thumbnail1" class="form-control" type="text" name="images" value="{{$repair->images}}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('repair.index') }}" class="btn btn-default">Cancel</button>
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