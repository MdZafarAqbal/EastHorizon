<?php $__env->startSection('main-content'); ?>

<div class="card">
    <h5 class="card-header">Edit City</h5>
    <div class="card-body">
      <form method="post" action="<?php echo e(route('city.update',$city->id)); ?>">
        <?php echo csrf_field(); ?> 
        <?php echo method_field('PATCH'); ?>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">City Name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter type"  value="<?php echo e($city->name); ?>" class="form-control">
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
          $countries = DB::table('countries')->where('status', 'active')->get();
        ?>
          <div class="form-group" id='country_id'>
            <label for="country">Country</label>
            <select name="country" class="form-control">
            <option value="<?php echo e($city->country->name); ?>"><?php echo e($city->country->name); ?></option>
              <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value='<?php echo e($country->id); ?>'><?php echo e($country->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <?php
            $states = DB::table('states')->where('status', 'active')->get();
          ?>
          <div class="form-group" id='state_id'>
              <label for="state">State Name</label>
              <select name="state" class="form-control">
              <option value="<?php echo e($city->state->name); ?>"><?php echo e($city->state->name); ?></option>
                  <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value='<?php echo e($state->id); ?>'><?php echo e($state->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
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
<script>
  

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/admin_panel/city/edit.blade.php ENDPATH**/ ?>