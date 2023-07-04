<!DOCTYPE html>
<html lang="en-us">
  <head>
		<?php echo $__env->make('frontend.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
  </head>
  <body>
		<!-- Header -->
		<?php echo $__env->make('frontend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- End Header -->

    <?php echo $__env->make('frontend.layouts.flash-message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <section id="main-content">
		  <?php echo $__env->yieldContent('main-content'); ?>
    </section>

		<!-- Footer -->
		<?php echo $__env->make('frontend.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- End Footer -->

		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
		<script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.2/jquery.typeahead.min.js"></script>
		<script src="<?php echo e(asset('frontend/js/jquery.exzoom.js')); ?>"></script>
		<script src="<?php echo e(asset('frontend/js/header.js')); ?>"></script>
		<script src="<?php echo e(asset('frontend/js/main.js')); ?>"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NH2TVFJYP0"></script>
    <script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-NH2TVFJYP0");</script>
		<?php echo $__env->yieldPushContent('scripts'); ?>
		<!-- End Scripts -->
  </body>
</html><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/frontend/layouts/master.blade.php ENDPATH**/ ?>