

<?php $__env->startSection('title', 'About Us || East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link href="<?php echo e(asset('frontend/css/about-us.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
	<!-- About Us -->
	<section class="about-us section">
    <?php
      $settings=DB::table('settings')->get();
    ?>

    <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="about-img">
        <img src="<?php echo e($data->photo); ?>" alt="About Us image">
      </div>
      <div class="about-content">
        <h2>Welcome To <span>East Horizon</span></h2>
        <p><?php echo e($data->description); ?></p>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</section>
	<!-- End About Us -->

	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/frontend/pages/about-us.blade.php ENDPATH**/ ?>