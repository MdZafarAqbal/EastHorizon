
<?php $__env->startSection('title', 'Order Detail || East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/order-detail.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
  <?php if($order): ?>
    <section class="order-detail-sec" id="order-detail-sec">
      <h1 class="page-title">Order Detail</h1>
      <div class="order-detail-container">
        <div class="order">
          <h2>ORDER: </h2>
          <h3 id="order-no">#<?php echo e($order->order_no); ?></h3>
        </div>

        <div class="status-container">
          <div class="status">
            <h4>Payment Status: </h4>
            <div class="status-value"><?php echo e(ucfirst($order->payment->status)); ?></div>
          </div>
          <div class="status">
            <h4>Order Status: </h4>
            <div class="status-value"><?php echo e(ucfirst($order->status)); ?></div>
          </div>
          <div class="status">
            <h4>Shipping Status: </h4>
            <div class="status-value"><?php echo e(ucfirst($order->shipping->status)); ?></div>
          </div>
        </div>

        <h3 class="summary-title">Summary</h3>
        <div class="summary-container">
          <div class="payment-summary summary">
            <div class="summary-detail">
              <h5>Subtotal: </h5>
              <div class="payment-value">AED <?php echo e(number_format($order->payment->subtotal, 2)); ?></div>
            </div>
            <div class="summary-detail">
              <h5>VAT (5%): </h5>
              <div class="payment-value">AED <?php echo e(number_format($order->payment->tax, 2)); ?></div>
            </div>
            <div class="summary-detail">
              <h5>Discount: </h5>
              <div class="payment-value">AED <?php echo e(number_format($order->payment->discount, 2)); ?></div>
            </div>
            <div class="summary-detail">
              <h5>Shipping: </h5>
              <div class="payment-value">AED <?php echo e(number_format($order->payment->shipping, 2)); ?></div>
            </div>
            <hr>
            <div class="summary-detail">
              <h5>Total: </h5>
              <div class="payment-value">AED <?php echo e(number_format($order->payment->total, 2)); ?></div>
            </div>
          </div>
        </div>
          
        <div class="address-container">
          <div class="billing-address">
            <h3 class="address-type">Billing Address</h3>
            <div class="billing-address address">
              <?php 
                $city = App\Models\City::with('state', 'country')->where('id', $order->city_id)->first();
              ?>
              <?php if($order->cname == null): ?>
                <div class="address-detail">
                  <h5>Name: </h5><div class="address-value"><?php echo e($order->fname); ?> <?php echo e($order->lname); ?></div>
                </div>
              <?php else: ?>
                <div class="address-detail">
                  <h5>Company: </h5><div class="address-value"><?php echo e($order->cname); ?></div>
                </div>
  
                <div class="address-detail">
                  <h5>TRN No: </h5><div class="address-value"><?php echo e($order->trn_no); ?></div>
                </div>
                <?php endif; ?>
                <div class="address-detail">
                  <h5>Phone: </h5><div class="address-value">+ <?php echo e($city->country->calling_code); ?> <?php echo e($order->phone); ?></div>
                </div>
                <div class="address-detail">
                  <h5>Email: </h5><div class="address-value email-address"><?php echo e($order->email); ?></div>
                </div>
                <div class="address-detail">
                  <h5>Address: </h5><div class="address-value st-address"><?php echo e($order->address); ?>, <?php echo e($city->name); ?>, <?php echo e($city->state->name); ?>, <?php echo e($city->country->name); ?></div>
                </div>
            </div>
          </div>
            
          <div class="shipping-address">
            <h3 class="address-type">Shipping Address</h3>
            <div class="shipping-address address">
              <?php 
                $shipping_city = App\Models\City::with('state', 'country')->where('id', $order->shipping->city_id)->get()[0];
              ?>
              <?php if($order->cname == null): ?>
                <div class="address-detail">
                  <h5>Name: </h5><div class="address-value"><?php echo e($order->shipping->fname); ?> <?php echo e($order->shipping->lname); ?></div>
                </div>
              <?php else: ?>
                <div class="address-detail">
                  <h5>Company: </h5><div class="address-value"><?php echo e($order->shipping->cname); ?></div>
                </div>
                <div class="address-detail">
                  <h5>TRN No: </h5><div class="address-value"><?php echo e($order->shipping->trn_no); ?></div>
                </div>
              <?php endif; ?>
              <div class="address-detail">
                <h5>Phone: </h5><div class="address-value">+ <?php echo e($shipping_city->country->calling_code); ?> <?php echo e($order->shipping->phone); ?></div>
              </div>
              <div class="address-detail">
                <h5>Address: </h5><div class="address-value st-address"><?php echo e($order->shipping->address); ?>, <?php echo e($shipping_city->name); ?>, <?php echo e($shipping_city->state->name); ?>, <?php echo e($shipping_city->country->name); ?></div>
              </div>
            </div>
          </div>
        </div>

        <div id="order-action" class="action">
          <a href="<?php echo e(route('order-track', ['order_no' => $order->order_no])); ?>" class="btn btn-submit action-btn">Track Order</a>
          <a href="<?php echo e(route('sale.pdf', ['id' => $order->id, 'download' => 1])); ?>" class="btn btn-submit action-btn">Sale Order</a>
          
          <?php if($order->status == 'completed'): ?>
            <a href="<?php echo e(route('tax.pdf', ['id' => $order->id, 'download' => 1])); ?>" class="btn btn-submit action-btn">Tax Invoice</a>
          <?php endif; ?>

          <?php if($cancel && $order->status != 'cancelled'): ?>
            <a href="<?php echo e(route('cancel-view', ['order_no' => $order->order_no, 'cancel' => true])); ?>" class="btn btn-submit action-btn">Remove Items</a>
          <?php elseif($return && $order->status != 'returned'): ?>
            <a href="<?php echo e(route('cancel-view', ['order_no' => $order->order_no, 'return' => true])); ?>" class="btn btn-submit action-btn">Return Items</a>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php else: ?>
    <div class="fail-container" id="fail">
      <p id="fail-status">Sorry there is no order with this order number. Please recheck your order number.</p>
    </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/frontend/pages/order-detail.blade.php ENDPATH**/ ?>