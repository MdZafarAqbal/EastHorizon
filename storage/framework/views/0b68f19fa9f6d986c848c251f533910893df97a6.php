<!DOCTYPE html>
  <html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <title>Sign In || East Horizon</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&family=Vollkorn:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap">

    <!-- Boxicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css">

    <!-- East Horizon StyleSheet -->
    <link href="<?php echo e(asset('frontend/css/signin-up.css')); ?>" rel="stylesheet">
  </head>
  <body>
    <section class="shop-signing login-section">
      <div class="signing-img-container"></div>
      <div class="signing-form-container">
        <?php echo $__env->make('frontend.layouts.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('images/logo_green.png')); ?>" alt="East Horizon Website Logo" class="signing-web-logo"></a> -->
        <h1 class="signing-web-title"><a href="<?php echo e(route('home')); ?>">East Horizon</a></h1>
        <h2>Sign In</h2>

        <!-- Form -->
        <form class="form" method="post" action="<?php echo e(route('login.submit')); ?>" novalidate>
          <?php echo csrf_field(); ?>
          <div class="form-group">
            <div class="form-input">
              <input type="email" name="email" id="email" placeholder="someone@domain.com" value="<?php echo e(old('email')); ?>">
              <label for="email">Email</label>
            </div>

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
            <div class="form-input">
              <input type="password" name="password" id="password" placeholder="Enter Password" value="<?php echo e(old('password')); ?>">
              <label for="password">Password</label>
            </div>

            <?php if($errors->get('password')): ?>
              <div class="error">
                <?php $__errorArgs = ['password'];
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

          <div class="remember-checkbox">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
          </div>

          <div class="form-group submit-btn">
            <button class="btn signing-btn" type="submit">Login</button>
          </div>
          <?php if(Route::has('password.reset')): ?>
        </form>    
        <p>Don't have an account? <a href="<?php echo e(route('register.form')); ?>" class="btn">Sign Up</a></p>
        <p><a class="forgot-pass" href="<?php echo e(route('password.reset')); ?>">
          Forgot password?
        </a></p>
        <?php endif; ?>        
        <p>Goto <a href="<?php echo e(route('home')); ?>" class="btn">Homepage</a></p>
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="<?php echo e(asset('frontend/js/login.js')); ?>"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NH2TVFJYP0"></script>
    <script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-NH2TVFJYP0");</script>
  </body>
</html>
<?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/frontend/pages/login.blade.php ENDPATH**/ ?>