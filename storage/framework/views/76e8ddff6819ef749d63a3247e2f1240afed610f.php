<?php $__env->startSection('title','Contact Us, Shops Locations || East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link href="<?php echo e(asset('frontend/css/contact.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>


<div id="rolla" class="store-location">
  <h2>Naif.</h2>
  <p>Monday - Sunday | 10:30 AM - 10:30 PM</p>
  <p>naif road, Dubai, UAE</p>
  <div style="width: 40%"><iframe src="https://goo.gl/maps/am2T2F3HPsgHnM139" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/frontend/pages/contact.blade.php ENDPATH**/ ?>