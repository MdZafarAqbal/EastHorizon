<?php $__env->startSection('main-content'); ?>

<div class="bg-light p-4 rounded">
        <h1>Update repair products</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <form method="post" action="<?php echo e(route('repair.update', $repair->id)); ?>">
                <?php echo method_field('patch'); ?>
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="user_name" class="form-label">Name</label>
                    <input value="<?php echo e($repair->user_name); ?>" 
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
                    <input value="<?php echo e($repair->mobile_no); ?>"
                        type="mobile_no" 
                        class="form-control" 
                        name="mobile_no" 
                        placeholder="Mobile Number" required>
                    <?php if($errors->has('mobile_no')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('mobile_no')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input value="<?php echo e($repair->product_name); ?>"
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
                    <input value="<?php echo e($repair->serial_no); ?>"
                        type="text" 
                        class="form-control" 
                        name="serial_no" 
                        placeholder="Serial No" required>
                    <?php if($errors->has('serial_no')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('serial_no')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="charge" class="form-label">Charge</label>
                    <input value="<?php echo e($repair->charge); ?>"
                        type="text" 
                        class="form-control" 
                        name="charge" 
                        placeholder="Charge" required>
                    <?php if($errors->has('charge')): ?>
                        <span class="text-danger text-left"><?php echo e($errors->first('charge')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail1" data-preview="holder_tablet" class="btn btn-primary lfm">
                            <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="thumbnail1" class="form-control" type="text" name="images" value="<?php echo e($repair->images); ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo e(route('repair.index')); ?>" class="btn btn-default">Cancel</button>
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
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/admin_panel/repair/edit.blade.php ENDPATH**/ ?>