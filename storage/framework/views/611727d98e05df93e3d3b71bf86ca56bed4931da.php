
<?php $__env->startSection('title', 'HERB || Orders Detail Page'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/orders-detail.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
  <?php 
    $i = 0;
  ?>
  <?php if($orders !== 0): ?>
    <div class="orders">
      <h1>Orders</h1>
      <div class="orders-table">
        <table>
          <thead>
            <tr>
              <th>S.No</th>
              <th>Order No</th>
              <th>Name</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Sale Order</th>
              <?php if($completed == 1): ?>
                <th>Tax Invoice</th>
              <?php endif; ?>
              <th>Details</th>
            </tr>
          </thead>
          
          <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
              $i++;
            ?>
            <tr>
              <td><?php echo e($i); ?></td>
              <td><?php echo e($ord->order_no); ?></td>
              <td><?php echo e($ord->fname); ?> <?php echo e($ord->lname); ?></td>
              <td>AED <?php echo e($ord->payment->total); ?></td>
              <td><?php echo e(ucfirst($ord->status)); ?></td>
              <td>
                <a href="<?php echo e(route('sale.pdf', ['id' => $ord->id, 'download' => 1])); ?>"> 
                  <button id="<?php echo e($ord->id); ?>-sale-invoice" class="btn btn-submit sale-invoice" data-order="<?php echo e($ord->order_no); ?>">Download</button>
                </a>
              </td>
              <?php if($completed == 1): ?>
                <?php if($ord->status == 'completed'): ?>
                  <td>
                    <a href="<?php echo e(route('tax.pdf', ['id' => $ord->id, 'download' => 1])); ?>"> 
                      <button id="<?php echo e($ord->id); ?>-tax-invoice" class="btn btn-submit tax-invoice" data-order="<?php echo e($ord->order_no); ?>">Download</button>
                    </a>
                  </td>
                <?php else: ?>
                  <td></td>
                <?php endif; ?>
              <?php endif; ?>
              <td>
                <button id="<?php echo e($ord->id); ?>-order-detail" class="btn btn-submit order-data" data-order="<?php echo e($ord->order_no); ?>">Order Detail</button>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
      </div>
    </div>
  <?php endif; ?>

  <?php if($order !== 0 && $order !== -1): ?>
    <div class="order-details orders" id="order-details">
      <h1>Order Information</h1>
      <div class="success-container" id="success">
        <div class="order-detail">
          <div class="order">
            <h2>ORDER: </h2>
            <h3 id="order-no">#<?php echo e($order->order_no); ?></h3>
          </div>
          <div class="status">
            <h4>STATUS: </h4>
            <h4 id="status"><?php echo e(ucfirst($order->status)); ?></h4>
          </div>
          <div class="address">
            <div class="billing">
              <?php 
                $city = App\Models\City::with('state', 'country')->where('id', $order->city_id)->first();
              ?>
              <h3>Billing Address</h3>
              <?php if($order->cname == null): ?>
                <h5>Name: </h5><span class="value"><?php echo e($order->fname); ?> <?php echo e($order->lname); ?></span><br/>
              <?php else: ?>
                <h5>Company: </h5><span class="value"><?php echo e($order->cname); ?></span><br/>
                <h5>TRN No: </h5><span class="value"><?php echo e($order->trn_no); ?></span><br/>
              <?php endif; ?>
                <h5>Phone: </h5><span class="value">+ <?php echo e($city->country->calling_code); ?> <?php echo e($order->phone); ?></span><br/>
                <h5>Email: </h5><span class="value"><?php echo e($order->email); ?></span><br/>
                <h5>Address: </h5><span class="value"><?php echo e($order->address); ?>, <?php echo e($city->name); ?>,<br><?php echo e($city->state->name); ?>, <?php echo e($city->country->name); ?></span><br/>
            </div>
              
            <a href="<?php echo e(route('sale.pdf', ['id' => $order->id, 'download' => 1])); ?>"> 
              <button id="<?php echo e($order->id); ?>-sale-invoice" class="btn btn-submit sale-invoice" data-order="<?php echo e($order->order_no); ?>">Sale Order</button>
            </a>
            
            <?php if($completed == 1): ?>
              <a href="<?php echo e(route('tax.pdf', ['id' => $order->id, 'download' => 1])); ?>">
                <button id="<?php echo e($order->id); ?>tax-invoice" class="btn btn-submit tax-invoice" data-order="<?php echo e($order->order_no); ?>">Tax Invoice</button>
              </a>
            <?php endif; ?>
            <div class="shipping">
              <?php 
                $shipping_city = App\Models\City::with('state', 'country')->where('id', $order->shipping->city_id)->get()[0];
              ?>
              <h3>Shipping Address</h3>
              <?php if($order->cname == null): ?>
                <h5>Name: </h5><span class="value"><?php echo e($order->shipping->fname); ?> <?php echo e($order->shipping->lname); ?></span><br/>
              <?php else: ?>
                <h5>Company: </h5><span class="value"><?php echo e($order->shipping->cname); ?></span><br/>
                <h5>TRN No: </h5><span class="value"><?php echo e($order->shipping->trn_no); ?></span><br/>
              <?php endif; ?>
                <h5>Phone: </h5><span class="value">+ <?php echo e($shipping_city->country->calling_code); ?> <?php echo e($order->shipping->phone); ?></span><br/>
                <h5>Address: </h5><span class="value"><?php echo e($order->shipping->address); ?>, <?php echo e($shipping_city->name); ?>,<br/> <?php echo e($shipping_city->state->name); ?>, <?php echo e($shipping_city->country->name); ?></span><br/>
            </div>
          </div>
        </div>
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
                  <?php if($return != 0 || $cancel != 0): ?>
                    <th><input type="checkbox" name="all" id="all-checkbox" class="btn btn-submit all-checkbox" value="<?php echo e($order->id); ?>"></th>
                  <?php endif; ?>
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
                  <?php if($return != 0 || $cancel != 0): ?>
                    <td><input type="checkbox" name="item_checkbox" class="btn btn-submit item-checkbox" data-total="<?php echo e($item->total); ?>" value="<?php echo e($item->id); ?>"></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
          <?php endif; ?>
          <div class="summary-container">
            <div id="order-action" class="action">
              <input type="hidden" id="order" name="order" value="<?php echo e($order->id); ?>">
              <input type="hidden" id="tax" name="tax" value="<?php echo e($order->payment->tax); ?>">
              <input type="hidden" id="total" name="total" value="<?php echo e($order->payment->subtotal); ?>">
              <?php if($cancel == 1): ?>
                <button id="action" class="btn btn-submit item-cancel action-btn" disabled>Remove Selected Item</button>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-submit home-btn action-btn">Home Page</a>
              <?php elseif($return == 1): ?>
                <button id="action" class="btn btn-submit item-return action-btn" disabled>Return Selected Item</button>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-submit home-btn action-btn">Home Page</a>
              <?php endif; ?>
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
    </div>
  <?php elseif($order == -1): ?>
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
        <?php if($cancel == 1): ?>
          <button id="continue-cancel" class="btn btn-submit pop-btn" disabled>Continue</button>
        <?php elseif($return == 1): ?>
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

  <div class="order-details-section">
    <div class="img-container">
      <img src="<?php echo e(asset('images/order-detail.png')); ?>" class="orders-detail-main-img" id="order-details-main-img">
    </div>
    <div class="order-details-container">
      <h2>Order Details</h2>
      <p>Enter the order number in the input box below and check details of the order. Order number would be given at the invoice slip.</p>
      <div class="form-group">
        <label for="order-id-input">Order No:</label>
        <input type="text" class="order-id-input" id="order-id-input" name="order_no" placeholder="Enter your order id">
      </div>

      <div class="form-group submit-detail">
        <button id="order-data" class="btn btn-submit">Order Detail</button>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('frontend/js/orders-detail.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/frontend/pages/orders-detail.blade.php ENDPATH**/ ?>