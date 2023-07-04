<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>East Horizon || Verify</title>

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
      <link href="<?php echo e(asset('frontend/css/verify-update.css')); ?>" rel="stylesheet">
  </head>

  <body>
    <header class="header web-header" id="header">
      <div class="header-content">
        <a href="<?php echo e(route('home')); ?>" class="header-logo">
          <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Website Logo" class="signing-web-logo">
        </a>
        <h2 class="header-title">East Horizon</h2>
        <a class="user-nav" href="<?php echo e(route('user.logout')); ?>"><i class="fa-solid fa-right-from-bracket icon" id="logout-icon"></i></a>
      </div>
    </header>

    <section class="email-verify-section">
      <div class="img-container">
        <img src="<?php echo e(asset('images/verify_email.png')); ?>" alt="Verify Email Mockup Image">
      </div>
      <div class="verify-card">
          <div class="card-header"><h3>Verify Your Email Address</h3></div>

          <div class="card-body">
            <p>Before proceeding further, please check your email for a verification link.</p>
            <p>If you did not receive the email, please click the link below.</p>

            <form class="resend-form" method="POST" action="<?php echo e(route('verification.resend')); ?>">
              <?php echo csrf_field(); ?>
              <button type="submit" class="btn-submit">Resend Email</button>
            </form>
          </div>
      </div>
    </section>
  </body>
</html>
<?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\auth\verify-email.blade.php ENDPATH**/ ?>