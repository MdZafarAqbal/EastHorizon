<!-- Start Footer Area -->
<footer class="footer shop-footer" >
	<!-- Footer Top -->
	<div class="footer-top main-footer">				
		<div class="footer-about">
			<div class="logo">
        <?php $settings=DB::table('settings')->get(); ?>
				<a href="<?php echo e(route('home')); ?>"><img src="<?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->logo); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>" alt="#"></a>
			</div>
			<hr>

			<div class="footer-desc">
				<p class="desc-text"><?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->short_des); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></p>
			</div>
		</div>

		<div class="footer-menu">
			<div class="footer-info">
				<h3>Information</h3>
				<hr>
				<ul>
					<li><a href="<?php echo e(route('about-us')); ?>">About Us</a></li>
					<li><a href="<?php echo e(route('terms-and-conditions')); ?>">Terms & Conditions</a></li>
					<li><a href="<?php echo e(route('privacy-policy')); ?>">Privacy Policy</a></li>
					<li><a href="<?php echo e(route('faq')); ?>">FAQ</a></li>
				</ul>
			</div>

			<!-- <div class="footer-cust-serv">
				<h3>Customer Service</h3>
				<hr>
				<ul>
					<li><a href="#">Payment Methods</a></li>
					<li><a href="#">Money-back</a></li>
					<li><a href="#">Returns</a></li>
					<li><a href="#">Shipping</a></li>
					<li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
				</ul>
			</div> -->

			<div class="footer-loc">
        <div>
          <h3>Address</h3></div>
          <hr>
          <div>
          <ul>
            <li><?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->address); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
            <li><?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->email); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
            <li><?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($data->phone); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></li>
          </ul>
        </div>
			</div>
		</div>
	</div>
	<!-- End Footer Top -->

	<div class="copyright">
		<p>Copyright &#169 <?php echo e(date('Y')); ?> <a href="#" target="_blank">east horizon</a>  -  All Rights Reserved.</p>
	</div>

	<!-- Fixed Footer -->
	<div id="footer-fixed" class="footer-fixed fixed-bottom collapse"> 
		<!-- Features -->
    <div class="features" >
			<div class="feature1" >
				<h4><i class="fa-solid fa-rocket"></i> Free Shipping<br>Over AED 100.00</h4>
			</div>
												
			<div class="feature2">
				<h4><i class="fa-solid fa-clock-rotate-left"></i> Free Return<br>Within 15 days</h4>
			</div>
										
			<div class="feature3">
				<h4><i class="fa-solid fa-lock"></i>100% Secure <br> Payment</h4>
			</div>
		</div>
		<!-- End Features -->
	</div>
	<!-- End Fixed Footer -->
</footer>
<?php /**PATH C:\xampp\htdocs\Herb_room1\resources\views/frontend/layouts/footer.blade.php ENDPATH**/ ?>