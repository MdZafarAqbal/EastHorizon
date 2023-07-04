

<?php $__env->startSection('main-content'); ?>

<div class="card">
    <h5 class="card-header">Edit Category</h5>
    <div class="card-body">
      <form method="post" action="<?php echo e(route('category.update',$category->id)); ?>">
        <?php echo csrf_field(); ?> 
        <?php echo method_field('PATCH'); ?>
        <div class="form-group">
          <label for="inputName" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputName" type="text" name="name" placeholder="Enter Name"  value="<?php echo e($category->name); ?>" class="form-control">
          <?php $__errorArgs = ['name'];
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
        <?php
            $coupons = DB::table('coupons')->where('effect','category')->orderBy('id','DESC')->get();
        ?>
        <div class="form-group" id='coupon_id'>
          <label for="coupon_id">Coupon</label>
          <select name="coupon_id" class="form-control">
            <?php if($category->coupon): ?>
              <option value=""><?php echo e($category->coupon->code); ?></option>
            <?php endif; ?>
              <option value="">--Select Coupon --</option>
           
            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>             
              <option value='<?php echo e($coupon->id); ?>'><?php echo e($coupon->code); ?></option>              
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>  
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active" <?php echo e((($category->status=='active')? 'selected' : '')); ?>>Active</option>
              <option value="inactive" <?php echo e((($category->status=='inactive')? 'selected' : '')); ?>>Inactive</option>
          </select>
          <?php $__errorArgs = ['status'];
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
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="<?php echo e(asset('admin_panel/summernote/summernote.min.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\admin_panel\category\edit.blade.php ENDPATH**/ ?>