
<?php $__env->startSection('title', 'Order Details || East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/orders.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
  <?php 
    $i = 0;
  ?>
  <?php if($orders): ?>
    <h1 class="page-title">Orders</h1>
    <section class="orders-sec">
      <div class="orders-table">
        <table>
          <thead>
            <tr>
              <th>S.No</th>
              <th>Order No</th>
              <th>Name</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Details</th>
            </tr>
          </thead>
          
          <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
              $i++;
            ?>
            <tr>
              <td><?php echo e($i); ?></td>
              <td><?php echo e($order->order_no); ?></td>
              <td><?php echo e($order->fname); ?> <?php echo e($order->lname); ?></td>
              <td>AED <?php echo e($order->payment->total); ?></td>
              <td><?php echo e(ucfirst($order->status)); ?></td>
              <td>
                <a href="<?php echo e(route('order-detail', ['order_no' => $order->order_no])); ?>" class="btn btn-submit order-detail-btn">Order Detail</a>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
      </div>
    </section>
  <?php endif; ?>

  <section class="order-detail-sec">
    <div class="img-container">
      <img src="<?php echo e(asset('images/order-detail.png')); ?>" class="order-detail-img" id="order-detail-img">
    </div>
    <div class="order-detail-container">
      <h2>Order Detail</h2>
      <p>Enter the order number in the input box below and check details of the order. Order number would be given at the invoice slip.</p>
      <div class="form-group">
        <label for="order-id-input">Order No:</label>
        <input type="text" class="order-input" id="order-input" name="order_no" placeholder="Enter order number">
      </div>

      <div class="form-group submit-detail">
        <button id="order-detail-btn" class="btn btn-submit order-detail-btn">Order Detail</button>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('frontend/js/orders.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/frontend/pages/orders.blade.php ENDPATH**/ ?>