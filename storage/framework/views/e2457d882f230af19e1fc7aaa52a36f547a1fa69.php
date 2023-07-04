<?php $__env->startSection('country','East Horizon || Country Create'); ?>

<?php $__env->startSection('main-content'); ?>

<div class="bg-light p-4 rounded">
        <h1>Add Seller Details</h1>
        <div class="container mt-4">
            <form method="POST" action="<?php echo e(route('seller.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="seller_name" class="form-label">Seller Name</label>
                    <input value="<?php echo e(old('seller_name')); ?>" 
                        type="text" 
                        class="form-control" 
                        name="seller_name" 
                        placeholder="Name" required>

                    <?php if($errors->has('seller_name')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('seller_name')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile No</label>
                    <input value="<?php echo e(old('mobile_no')); ?>"
                        type="number" 
                        class="form-control" 
                        name="mobile_no" 
                        placeholder="Mobile Number" >
                    <?php if($errors->has('mobile_no')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('mobile_no')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Id</label>
                    <input value="<?php echo e(old('email')); ?>"
                        type="number" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email Id" >
                    <?php if($errors->has('email')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('email')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input value="<?php echo e(old('product_name')); ?>"
                        type="text" 
                        class="form-control" 
                        name="product_name" 
                        placeholder="Product Name" required>
                    <?php if($errors->has('product_name')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('product_name')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="serial_no" class="form-label">Serial No</label>
                    <input value="<?php echo e(old('serial_no')); ?>"
                        type="text" 
                        class="form-control" 
                        name="serial_no" 
                        placeholder="Serial No" >
                    <?php if($errors->has('serial_no')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('serial_no')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="imei_no" class="form-label">IMEI No</label>
                    <input value="<?php echo e(old('imei_no')); ?>"
                        type="text" 
                        class="form-control" 
                        name="imei_no" 
                        placeholder="IMEI No" >
                    <?php if($errors->has('imei_no')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('imei_no')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input value="<?php echo e(old('qty')); ?>"
                        type="text" 
                        class="form-control" 
                        name="qty" 
                        placeholder="Quantity" required>
                    <?php if($errors->has('qty')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('qty')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input value="<?php echo e(old('price')); ?>"
                        type="text" 
                        class="form-control" 
                        name="price" 
                        placeholder="Price" required>
                    <?php if($errors->has('price')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('price')); ?></span>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo e(route('seller.index')); ?>" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin_panel/summernote/summernote.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="<?php echo e(asset('admin_panel/summernote/summernote.min.js')); ?>"></script>
<script>
    $('#lfm').filemanager('image');
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/admin_panel/seller/create.blade.php ENDPATH**/ ?>