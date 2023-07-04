<?php $__env->startSection('title', 'Track Order || East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/order-track.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
<section>
  <div class="tracking-order-section">
    <div class="img-container">
      <img src="<?php echo e(asset('images/trackorder.png')); ?>" class="tracking-order-main-img" id="tracking-order-main-img">
    </div>
  </div>
  <div class="tracking-details" id="track-order-details">
    <h1>Tracking Information</h1>
    <div class="success-container" id="success">
      <div class="order-detail">
        <div class="order">
          <h2>ORDER: </h2>
          <h3 id="order-no"><?php echo e($order->order_no); ?></h3>
        </div>
        <div class="status">
          <h4>Shipping Status: </h4>
          <h4 id="status"><?php echo e(ucfirst($order->shipping->status)); ?></h4>
        </div>
        <p id="status-line"></p>
      </div>
      <div class="tracking-dates">
        <div class="date-container">
          <div class="label">
            <div class="tracking-icon"><i class="bx bxs-shopping-bags" id="order-icon"></i></div>
            <h4>ORDERED</h4>
          </div>
          <p id="order-date" class="date">-- ------- ----</p>
        </div>
        <div class="date-container">
          <div class="label">
            <div class="tracking-icon"><i class="fa-solid fa-clipboard-list" id="process-icon"></i></div>
            <h4>PROCESSED</h4>
          </div>
          <p id="process-date" class="date">-- ------- ----</p>
        </div>
        <div class="date-container">
          <div class="label">
            <div class="tracking-icon"><i class="fa-solid fa-truck-fast" id="ship-icon"></i></div>
            <h4>SHIPPED</h4>
          </div>
          <p id="ship-date" class="date">-- ------- ----</p>
        </div>
        <div class="date-container">
          <div class="label">
            <div class="tracking-icon"><i class="bx bxs-package" id="deliver-icon"></i></div>
            <h4>DELIVERED</h4>
          </div>
          <p id="deliver-date" class="date">-- ------- ----</p>
        </div>
      </div>
      <div class="status-img-container">
        <img src="<?php echo e(asset('images/ordered_track.png')); ?>" alt="tracking-status" id="status-img" width="50%">
      </div>
    </div>
    <div class="fail-container collapse" id="fail">
      <p id="fail-status">Sorry there is no order with this order number. Please recheck your order number and track again.</p>
    </div>
  </div>
  <div class="img-container">
    <img src="<?php echo e(asset('images/deliveryprocess.png')); ?>" class="tracking-order-main-img" id="tracking-order-main-img">
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('frontend/js/order-track.js')); ?>"></script>
  <script>
    $(function() {
      trackOrder(<?= $order ?>);
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/frontend/pages/order-track.blade.php ENDPATH**/ ?>