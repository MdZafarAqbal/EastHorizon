<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

    <title>Sign Up || East Horizon</title>

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
    <section class="shop-signing register">
      <div class="signing-img-container"></div>

      <div class="signing-form-container">
        <?php echo $__env->make('frontend.layouts.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('images/logo_green.png')); ?>" alt="East Horizon Website Logo" class="signing-web-logo"></a>
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
                <div class="form-input">
                  <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo e(old('fname')); ?>">
                  <label for="fname">First Name</label>
                </div>
                
                <?php if($errors->get('fname')): ?>
                <div class="error">
                  <?php $__errorArgs = ['fname'];
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
              </div>
              
              <div class="form-group" id="last-name">
                <div class="form-input">
                  <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo e(old('lname')); ?>">
                  <label for="lname">Last Name</label>
                </div>
                
                <?php if($errors->get('lname')): ?>
                  <div class="error">
                    <?php $__errorArgs = ['lname'];
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
              </div>
              
              <div class="form-group collapse" id="company-name">
                <div class="form-input">
                  <input type="text" id="cname" name="cname" placeholder="Company Name">
                  <label for="cname">Company Name</label>
                </div>
                
              <?php if($errors->get('cname')): ?>
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
              <?php endif; ?>
              </div>
              
              <div class="form-group collapse" id="trn">
                <div class="form-input">
                  <input type="number" id="trn-no" name="trn_no" placeholder="TRN Number">
                  <label for="trn-no">TRN Number</label>
                </div>
                  
                <?php if($errors->get('trn_no')): ?>
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
              </div>
            </div>

            <div class="form-group">
              <div class="form-input">
                <input type="email" name="email" id="email" placeholder="someone@domain.com" value="<?php echo e(old('email')); ?>" required>
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

            <div class="fl-bl">
              <div class="form-group">
                <div class="form-input">
                  <input type="password" name="password" id="password" placeholder="Enter Password">
                  <label for="password">Password</label>
                </div>
              </div>

              <div class="form-group">
                <div class="form-input">
                  <input type="password" name="password_confirmation" id="confirm-password" placeholder="Confirm Password">
                  <label for="confirm-password">Confirm Password</label>
                </div>
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

          <button type="submit" class="btn signing-btn">Register</button>
        </form>
        <p>Already Registered? <a href="<?php echo e(route('login.form')); ?>" class="btn">Log In</a></p>
        <p>Goto <a href="<?php echo e(route('home')); ?>" class="btn">Homepage</a></p>
        <!--/ End Form -->
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="<?php echo e(asset('frontend/js/register.js')); ?>"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NH2TVFJYP0"></script>
    <script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-NH2TVFJYP0");</script>
  </body>
</html>
<?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/frontend/pages/register.blade.php ENDPATH**/ ?>