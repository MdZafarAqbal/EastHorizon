<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>East Horizon || Login</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Vollkorn:wght@700;900&display=swap" rel="stylesheet">

  <!-- StyleSheet -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- East Horizon StyleSheet -->
    <link href="<?php echo e(asset('frontend/css/signin-up.css')); ?>" rel="stylesheet">
</head>
<body>
  <section class="shop-signing">
    <div class="signing-img-container">
      <img src="<?php echo e(asset('images/login-east-horizon.jpg')); ?>" alt="Login Image" id="login-img" class="signing-img logging-img">
    </div>
    <div class="signing-form-container">
      <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('images/logo_green.png')); ?>" alt="Website Logo" class="signing-web-logo"></a>
      <h1 class="signing-web-title"><a href="<?php echo e(route('home')); ?>">East Horizon</a></h1>
      <h2>Sign In</h2>
      
      <!-- Form -->
      <form class="form" method="post" action="<?php echo e(route('login.submit')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="email">Email:<span>*</span></label>
            <input type="email" name="email" id="email" placeholder="Enter Email" value="<?php echo e(old('email')); ?>" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-value"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
            
      
        <div class="form-group">
          <label for="password">Password:<span>*</span></label>
          <input type="password" name="password" id="password" placeholder="Enter Password" value="<?php echo e(old('password')); ?>" required>
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-value"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

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
      </form>    
    </div>
  </section>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\frontend\pages\login.blade.php ENDPATH**/ ?>