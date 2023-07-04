<!-- Meta Tag -->
<?php echo $__env->yieldContent('meta'); ?>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html">
<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<meta name="description" content="">

<!-- Title Tag  -->
<title><?php echo $__env->yieldContent('title'); ?></title>

<!-- Favicon -->
<link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Vollkorn:wght@700;900&display=swap" rel="stylesheet">

<!-- StyleSheet -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

  <!-- Flickity -->
  <link rel="stylesheet" href="https://unpkg.com/flickity@2.3.0/dist/flickity.css">

  <!-- ExZoom -->
  <link href="<?php echo e(asset('frontend/css/jquery.exzoom.css')); ?>" rel="stylesheet">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- East Horizon StyleSheet -->
  <link href="<?php echo e(asset('frontend/css/main.css')); ?>" rel="stylesheet">
  <?php echo $__env->yieldPushContent('styles'); ?>
  <link href="<?php echo e(asset('frontend/css/header.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('frontend/css/footer.css')); ?>" rel="stylesheet">
<?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\frontend\layouts\head.blade.php ENDPATH**/ ?>