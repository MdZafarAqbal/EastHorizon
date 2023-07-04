<?php $__env->startSection('title', 'Checkout Order || East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/repair.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
  <!-- Start Checkout -->
  <h1 class="title page-title">Repair</h1>

    <section class="shop-checkout checkout-sec">
      <!-- Form -->
      <div class="form-container">
        <form id="order-form" class="form" method="post" action="<?php echo e(route('repair-store')); ?>" novalidate>
          <?php echo csrf_field(); ?>
          <fieldset class="details">
            <legend>Repair Product Details</legend>
            <div class="fl-bl">
              <div class="form-group" id="first-name">
                <label for="user_name">Name<span>*</span></label>
                <input type="text" id="user_name" name="user_name" placeholder="First Name" value="<?php if(auth()->guard()->check()): ?><?php echo e(auth()->user()->fname); ?><?php else: ?><?php echo e(old('fname')); ?><?php endif; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="mobile_no">Mobile No<span>*</span></label>
              <input type="number" name="mobile_no" id="mobile_no" placeholder="Mobile No" value="">

              <?php if($errors->get('mobile_no')): ?>
                <div class="error">
                  <?php $__errorArgs = ['mobile_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="email">Email Address<span>*</span></label>
              <input type="email" name="email" id="email" placeholder="Email Address" value="<?php if(auth()->guard()->check()): ?><?php echo e(auth()->user()->email); ?><?php else: ?><?php echo e(old('email')); ?><?php endif; ?>">

              <?php if($errors->get('email')): ?>
                <div class="error">
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
            </div> 
            <div class="form-group">
              <label for="text">Product Name<span>*</span></label>
              <input type="text" name="product_name" id="product_name" placeholder="Product Name" value="">

              <?php if($errors->get('product_name')): ?>
                <div class="error">
                  <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
            </div> 
            <div class="form-group">
              <label for="serial_no">Serial No</label>
              <input type="number" name="serial_no" id="serial_no" placeholder="Serial No" value="">

              <?php if($errors->get('serial_no')): ?>
                <div class="error">
                  <?php $__errorArgs = ['serial_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="emei">EMEI</label>
              <input type="number" name="emei" id="emei" placeholder="EMEI" value="">

              <?php if($errors->get('emei')): ?>
                <div class="error">
                  <?php $__errorArgs = ['emei'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="text">Problem</label>
              <input type="text" name="problem" id="problem" placeholder="Problem" value="">

              <?php if($errors->get('problem')): ?>
                <div class="error">
                  <?php $__errorArgs = ['problem'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
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
          </fieldset>        
        </form>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/frontend/pages/repair.blade.php ENDPATH**/ ?>