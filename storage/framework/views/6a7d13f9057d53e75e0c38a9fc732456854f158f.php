
<?php $__env->startSection('title', 'East Horizon || Remove Items'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/order-action.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
  <?php if($order): ?>
    <div class="order-details orders" id="order-details">
      <h1>Remove Items</h1>
      <div class="success-container" id="success">
        <div class="order-items orders-table">
          <?php 
            $items = $order->order_items;
            $j = 0;
          ?>
          <?php if(count($items) !== 0): ?>
            <table>
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Form</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Discount</th>
                  <th>Amount</th>
                  <th><input type="checkbox" name="all" id="all-checkbox" class="btn btn-submit all-checkbox" value="<?php echo e($order->id); ?>"></th>
                </tr>
              </thead>

              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                  $j++;
                ?>
                <tr>
                  <td><?php echo e($j); ?></td>
                  <td><img src="<?php echo e($item->product->photo); ?>" alt="Product Image" width="80" height="80"></td>
                  <td><?php echo e($item->product->name); ?></td>
                  <td><?php echo e($item->form); ?></td>
                  <td><?php echo e($item->size); ?></td>
                  <td><?php echo e(number_format($item->price, 2)); ?></td>
                  <td><?php echo e($item->quantity); ?></td>
                  <td><?php echo e(number_format($item->discount, 2)); ?></td>
                  <td><?php echo e(number_format($item->total, 2)); ?></td>
                  <td><input type="checkbox" name="item_checkbox" class="btn btn-submit item-checkbox" data-total="<?php echo e($item->total); ?>" value="<?php echo e($item->id); ?>"></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
          <?php endif; ?>
        </div>
        <div class="summary-container">
          <div id="order-action" class="action">
            <input type="hidden" id="order" name="order" value="<?php echo e($order->id); ?>">
            <input type="hidden" id="total" name="total" value="<?php echo e($order->payment->subtotal); ?>">
            <input type="hidden" id="tax" name="tax" value="<?php echo e($order->payment->tax); ?>">
            <input type="hidden" id="discount" name="discount" value="<?php echo e($order->payment->discount); ?>">
            <button id="action" class="btn btn-submit item-cancel action-btn" disabled>Remove Selected Item</button>
            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-submit home-btn action-btn">Back</a>
          </div>
          <div class="summary">
            <h5>Subtotal: </h5><span class="value">AED <?php echo e(number_format($order->payment->subtotal, 2)); ?></span><br/>
            <h5>VAT Amount: </h5><span class="value">AED <?php echo e(number_format($order->payment->tax, 2)); ?></span><br/>
            <h5>Discount: </h5><span class="value">AED <?php echo e(number_format($order->payment->discount, 2)); ?></span><br/>
            <h5>Shipping: </h5><span class="value">AED <?php echo e(number_format($order->payment->shipping, 2)); ?></span><br/>
            <hr/>
            <h4>Grand Total: </h4><span class="value">AED <?php echo e(number_format($order->payment->total, 2)); ?></span><br/>
          </div>
        </div>
      </div>
    </div>
  <?php elseif($order): ?>
    <div class="fail-container" id="fail">
      <p id="fail-status">Sorry there is no order with this order number. Please recheck your order number.</p>
    </div>
  <?php endif; ?>

  <section id="reason-popup" class="popup">
    <div id="reason-div" class="popup-div">
      <h2>Reason</h2>
      <button type="button" class="btn close" id="close-btn" onclick="removePopup()">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <input type="hidden" name="reason" id="reason" value="">
      <ul class="reasons-list">
        <li id="mind-change" class="reason-item">Change of Mind</li>
        <li id="damaged-defective" class="reason-item">Damaged or Defective Product</li>
        <li id="no-need" class="reason-item">No Longer Needed</li>
        <li id="wrong-product" class="reason-item">Shipped Wrong Product</li>
        <li id="other" class="reason-item other-reason">Other</li>
      </ul>

      <textarea name="reason-text" id="other-text" class="collapse" cols="30" rows="10"></textarea>
      <div class="action-btns">
        <button class="btn btn-submit pop-btn" onclick="removePopup()">Back</button>
        <?php if($cancel): ?>
          <button id="continue-cancel" class="btn btn-submit pop-btn" disabled>Continue</button>
        <?php endif; ?>
          
        <?php if($return): ?>
          <button id="continue-return" class="btn btn-submit pop-btn" disabled>Continue</button>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section id="warning-popup" class="popup">
    <div id="warning-div" class="popup-div">
      <h2>Warning</h2>
      <button type="button" class="btn close" id="close-btn" onclick="removePopup()">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <p>Your order value will breach the minimum free shipping limit (i.e AED 100.00) therefore shipping charges would be added to total charges.</p>

      <div class="action-btns">
        <button class="btn btn-submit pop-btn" onclick="removePopup()">Back</button>
        <button id="continue" class="btn btn-submit pop-btn">Continue</button>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('frontend/js/order-action.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/frontend/pages/order-cancel.blade.php ENDPATH**/ ?>