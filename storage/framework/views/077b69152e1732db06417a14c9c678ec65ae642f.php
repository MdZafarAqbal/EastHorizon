
<?php $__env->startSection('title','East Horizon || Banner Edit'); ?>
<?php $__env->startSection('main-content'); ?>

<div class="card">
    <h5 class="card-header">Edit Banner</h5>
    <div class="card-body">
      <form method="post" action="<?php echo e(route('fixed.update',$banner_fixed->id)); ?>">
        <?php echo csrf_field(); ?> 
        <?php echo method_field('PATCH'); ?>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo Desktop <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder_desktop" class="btn btn-primary lfm">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
          <input id="thumbnail" class="form-control" type="text" name="photo_desktop" value="<?php echo e($banner_fixed->photo_desktop); ?>">
        </div>
        <div id="holder_desktop" style="margin-top:15px;max-height:100px;"></div>
          <?php $__errorArgs = ['photo_desktop'];
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
          <label for="inputPhoto" class="col-form-label">Photo Tablet <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail1" data-preview="holder_tablet" class="btn btn-primary lfm">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
          <input id="thumbnail1" class="form-control" type="text" name="photo_tablet" value="<?php echo e($banner_fixed->photo_tablet); ?>">
        </div>
        <div id="holder_tablet" style="margin-top:15px;max-height:100px;"></div>
          <?php $__errorArgs = ['photo_tablet'];
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
          <label for="inputPhoto" class="col-form-label">Photo Mobile <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail2" data-preview="holder_mobile" class="btn btn-primary lfm">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
          <input id="thumbnail2" class="form-control" type="text" name="photo_mobile" value="<?php echo e($banner_fixed->photo_mobile); ?>">
        </div>
        <div id="holder_mobile" style="margin-top:15px;max-height:100px;"></div>
          <?php $__errorArgs = ['photo_mobile'];
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
<script>
    $('.lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin_panel.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\admin_panel\fixed\edit.blade.php ENDPATH**/ ?>