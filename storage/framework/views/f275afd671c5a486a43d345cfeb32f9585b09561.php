
<?php $__env->startSection('main-content'); ?>
  <div class="card">
    <h5 class="card-header">Edit Coupon</h5>
    <div class="card-body">
      <form method="post" action="<?php echo e(route('coupon.update',$coupon->id)); ?>">
        <?php echo csrf_field(); ?> 
        <?php echo method_field('PATCH'); ?>
          <div class="form-group">
            <label for="inputTitle" class="col-form-label">Coupon Code <span class="text-danger">*</span></label>
            <input id="inputTitle" type="text" name="code" placeholder="Enter Coupon Code"  value="<?php echo e($coupon->code); ?>" class="form-control">
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
              <option value="fixed" <?php echo e((($coupon->type=='fixed') ? 'selected' : '')); ?>>Fixed</option>
              <option value="percent" <?php echo e((($coupon->type=='percent') ? 'selected' : '')); ?>>Percent</option>
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
            <input id="inputTitle" type="number" name="value" placeholder="Enter Coupon value"  value="<?php echo e($coupon->value); ?>" class="form-control">
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
            <label for="effect" class="col-form-label">Effect <span class="text-danger">*</span></label>
            <select name="effect" class="form-control">
              <option value="product" <?php echo e((($coupon->effect=='product') ? 'selected' : '')); ?>>Product</option>
              <option value="category" <?php echo e((($coupon->effect=='category') ? 'selected' : '')); ?>>Category</option>
              <option value="subcategory" <?php echo e((($coupon->effect=='subcategory') ? 'selected' : '')); ?>>Subcategory</option>
              <option value="user" <?php echo e((($coupon->effect=='user') ? 'selected' : '')); ?>>User</option>
              <option value="order" <?php echo e((($coupon->effect=='all') ? 'selected' : '')); ?>>All</option>
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
            <button class="btn btn-success" type="submit">Update</button>
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
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\admin_panel\coupon\edit.blade.php ENDPATH**/ ?>