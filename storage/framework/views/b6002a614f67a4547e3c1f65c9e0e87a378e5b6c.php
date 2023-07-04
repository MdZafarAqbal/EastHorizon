<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>East Horizon || Register</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Vollkorn:wght@700;900&display=swap"
    rel="stylesheet">

  <!-- StyleSheet -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- East Horizon StyleSheet -->
  <link href="<?php echo e(asset('frontend/css/signin-up.css')); ?>" rel="stylesheet">
</head>

<body>
  <section class="shop-signing register">
    <div class="signing-img-container">
      <img src="<?php echo e(asset('images/login-east-horizon.jpg')); ?>" alt="Login Image" id="login-img" class="signing-img logging-img">
    </div>
    <div class="signing-form-container">
      <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('images/logo_green.png')); ?>" alt="Website Logo"
          class="signing-web-logo"></a>
      <h1 class="signing-web-title"><a href="<?php echo e(route('home')); ?>">East Horizon</a></h1>
      <h2>Sign Up</h2>

      <!-- Form -->
      <form class="form" method="post" action="<?php echo e(route('register.submit')); ?>" novalidate>
        <?php echo csrf_field(); ?>

        <fieldset class="type-selection">
          <legend>User</legend>
          <div class="form-group">
            <input type="radio" name="cust_type" id="individual" value="individual" checked>
            <label for="individual">Individual</label>
          </div>

          <div class="form-group">
            <input type="radio" name="cust_type" id="company" value="company">
            <label for="company">Company</label>
          </div>
          <?php if($errors->get('cust_type')): ?>
            <div class="error">
              <?php $__errorArgs = ['cust_type'];
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
        </fieldset>

        <fieldset class="details">
          <legend>Details</legend>
          <div class="fl-bl">
            <div class="form-group" id="first-name">
              <label for="fname">First Name<span>*</span></label>
              <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo e(old('fname')); ?>">
            </div>
            
            <div class="form-group" id="last-name">
              <label for="lname">Last Name<span>*</span></label>
              <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo e(old('lname')); ?>">
            </div>
            
            <div class="form-group collapse" id="company-name">
              <label for="cname">Company Name<span>*</span></label>
              <input type="text" id="cname" name="cname" placeholder="Company Name" value="<?php echo e(old('cname')); ?>">
            </div>

            <div class="form-group collapse" id="trn">
              <label for="trn-number">TRN<span>*</span></label>
              <input type="number" id="trn-number" name="trn_no" placeholder="TRN Number" value="<?php echo e(old('trn_no')); ?>">
            </div>
          </div>

          <?php if($errors->get('fname')): ?>
            <div class="error">
              <?php $__errorArgs = ['fname'];
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

          <?php elseif($errors->get('lname')): ?>
            <div class="error">
              <?php $__errorArgs = ['lname'];
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

          <?php elseif($errors->get('cname')): ?>
            <div class="error">
              <?php $__errorArgs = ['cname'];
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

          <?php elseif($errors->get('trn_no')): ?>
            <div class="error">
              <?php $__errorArgs = ['trn_no'];
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

          <div class="form-group">
            <label for="email">Email:<span>*</span></label>
            <input type="email" name="email" id="email" placeholder="Enter Email" value="<?php echo e(old('email')); ?>">
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

          <div class="fl-bl">
            <div class="form-group">
              <label for="password">Password:<span>*</span></label>
              <input type="password" name="password" id="password" placeholder="Enter Password">
            </div>

            <div class="form-group">
              <label for="password_confirmation">Confirm Password:<span>*</span></label>
              <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
            </div>
          </div>

          <?php if($errors->get('password')): ?>
            <div class="error">
              <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <?php echo $message; ?>

              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          <?php endif; ?>
        </fieldset>

        <div class="form-group submit-btn">
          <button type="submit" class="btn signing-btn">Register</button>
        </div>
        <p>Already Registered? <a href="<?php echo e(route('login.form')); ?>" class="btn">Log In</a></p>
      </form>
      <!--/ End Form -->
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
  <script src="<?php echo e(asset('frontend/js/register.js')); ?>"></script>
</body>

</html><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\frontend\pages\register.blade.php ENDPATH**/ ?>