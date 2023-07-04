<?php $__env->startSection('country','East Horizon || Repair Create'); ?>

<?php $__env->startSection('main-content'); ?>

<div class="bg-light p-4 rounded">
        <h1>Add Repair Products</h1>
        <div class="container mt-4">
            <form method="POST" action="<?php echo e(route('repair.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="user_name" class="form-label">User Name</label>
                    <input value="<?php echo e(old('user_name')); ?>" 
                        type="text" 
                        class="form-control" 
                        name="user_name" 
                        placeholder="Name" required>

                    <?php if($errors->has('user_name')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('user_name')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile No</label>
                    <input value="<?php echo e(old('mobile_no')); ?>"
                        type="number" 
                        class="form-control" 
                        name="mobile_no" 
                        placeholder="Mobile Number" required>
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
                        placeholder="Email Id" required>
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
                        placeholder="Serial No" required>
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
                        placeholder="IMEI No" required>
                    <?php if($errors->has('imei_no')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('imei_no')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="problem" class="form-label">Problem</label>
                    <input value="<?php echo e(old('problem')); ?>"
                        type="text" 
                        class="form-control" 
                        name="problem" 
                        placeholder="Problem" required>
                    <?php if($errors->has('problem')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('problem')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="charge" class="form-label">Charges</label>
                    <input value="<?php echo e(old('charge')); ?>"
                        type="text" 
                        class="form-control" 
                        name="charge" 
                        placeholder="Charges" required>
                    <?php if($errors->has('charge')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('charge')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger"></span></label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]" multiple>
                        </span>          
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo e(route('repair.index')); ?>" class="btn btn-default">Back</a>
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
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/admin_panel/repair/create.blade.php ENDPATH**/ ?>