<!DOCTYPE html>
  <html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <title>East Horizon || Login</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">

    <!-- East Horizon StyleSheet -->
    <link href="<?php echo e(asset('frontend/css/signin-up.css')); ?>" rel="stylesheet">
  </head>
  <body>
    <section class="shop-signing login-section">
      <div class="signing-img-container">
      </div>
      <div class="signing-form-container">
        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('images/logo_green.png')); ?>" alt="Website Logo" class="signing-web-logo"></a>
        <h1 class="signing-web-title"><a href="<?php echo e(route('home')); ?>">East Horizon</a></h1>
        <h2>Sign In</h2>
        
        <?php echo $__env->make('frontend.layouts.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Form -->
        <form class="form" method="post" action="<?php echo e(route('login.submit')); ?>">
          <?php echo csrf_field(); ?>
          <div class="form-group">
              <label for="email">Email:<span>*</span></label>
              <input type="email" name="email" id="email" placeholder="Enter Email" value="<?php echo e(old('email')); ?>" required>
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
            <label for="password">Password:<span>*</span></label>
            <input type="password" name="password" id="password" placeholder="Enter Password" value="<?php echo e(old('password')); ?>" required>
          </div>

          <?php if($errors->get('password')): ?>
            <div class="error">
              <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                {$message}
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          <?php endif; ?>

          <div class="checkbox type-selection">
            <input type="checkbox" name="remember" id="checkbox-login">
            <label class="checkbox-login" for="checkbox-login">Remember me</label>
          </div>
      
          <div class="form-group submit-btn">
            <button class="btn signing-btn" type="submit">Login</button>
            <p>Don't have an account? <a href="<?php echo e(route('register.form')); ?>" class="btn">Register</a></p>
          </div>
          <?php if(Route::has('password.reset')): ?>
          <p><a class="forgot-pass" href="<?php echo e(route('password.reset')); ?>">
            Forgot password?
          </a></p>
          <?php endif; ?>        
          <p>Goto <a href="<?php echo e(route('home')); ?>" class="btn">Homepage</a></p>
        </form>    
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script>$(window).on("load",function(){$(".signing-img-container").css("height",$(".shop-signing").outerHeight())});</script>
  </body>
</html><?php /**PATH C:\xampp\htdocs\Herb_room1\resources\views/frontend/pages/login.blade.php ENDPATH**/ ?>