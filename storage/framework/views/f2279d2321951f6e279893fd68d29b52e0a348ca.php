

<?php $__env->startSection('main-content'); ?>

<div class="card">
  <h5 class="card-header">Add Coupon</h5>
  <div class="card-body">
    <form method="post" action="<?php echo e(route('coupon.store')); ?>">
      <?php echo e(csrf_field()); ?>

      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Coupon Code <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="code" placeholder="Enter Coupon Code"  value="<?php echo e(old('code')); ?>" class="form-control">
        <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="form-group">
        <label for="type" class="col-form-label">Type <span class="text-danger">*</span></label>
        <select name="type" class="form-control">
          <option value="fixed">Fixed</option>
          <option value="percent">Percent</option>
        </select>
        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>

      <div class="form-group">
        <label for="inputTitle" class="col-form-label">Value <span class="text-danger">*</span></label>
        <input id="inputTitle" type="float" name="value" placeholder="Enter Coupon value"  value="<?php echo e(old('value')); ?>" class="form-control">
        <?php $__errorArgs = ['value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="form-group">
        <label for="effect" class="col-form-label">Effect </label>
        <select name="effect" class="form-control">
          <option value="product">Product</option>
          <option value="category">Category</option>
          <option value="subcategory">Subcategory</option>
          <option value="user">User</option>
          <option value="all">All</option>
        </select>
        <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      
      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button>
        <button class="btn btn-success" type="submit">Submit</button>
      </div>
    </form>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin_panel/summernote/summernote.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('admin_panel/summernote/summernote.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\admin_panel\coupon\create.blade.php ENDPATH**/ ?>