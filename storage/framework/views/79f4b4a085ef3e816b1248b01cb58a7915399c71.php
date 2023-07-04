
<?php $__env->startSection('title', 'Shopping Cart || East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/cart.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
	<!-- Shopping Cart -->
  <h1 class="title page-title" id="cart-title">Shopping Cart</h1>

  <section class="cart-section">
    <div class="cart-page-items">
      <?php
        $cart_products = Helper::getAllProductFromCart();
      ?>
      
      <?php if($cart_products): ?>

        <?php $__currentLoopData = $cart_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="cart-page-item">
            <img src="<?php echo e($cart->product['photo']); ?>" alt="product photo" class="cart-product-img zoom-img">
            <div class="cart-page-item-meta">
              <h2 class="cart-page-item-name"><?php echo e($cart->product['name']); ?></h2>
              <div class="cart-page-item-price">
                <h4>Price: </h4>
                <p>AED <?php echo e(number_format($cart->price, 2)); ?></p>
              </div>
              <div class="cart-page-item-form">
                <h4>Form: </h4>
                <p><?php echo e($cart->form); ?></p>
              </div>
              <div class="cart-page-item-size">
                <h4>Size: </h4> 
                <p><?php echo e($cart->size); ?></p>
              </div>
              <div class="cart-page-item-quantity">
                <h4>Quantity: </h4>
                <input type="button" value="-" class="qty-minus minus qty-control" field="quantity">
						    <input type="number" name="item_quantity" class="qty item-quantity" value="<?php echo e($cart->quantity); ?>" min="1" oninput="this.value = Math.abs(this.value)" onchange="updateCartData(<?= $cart->id ?>, this.value)">
						    <input type="button" value="+" class="qty-plus plus qty-control" field="quantity">
              </div>
            </div>
            <?php if(auth()->guard()->check()): ?>
              <div class="cart-discount">
                <h4>Discount: </h4>
                <p id="<?php echo e($cart->id); ?>-discount" class="cart-discount">AED <?php echo e(number_format($cart->discount, 2)); ?></p>
              </div>
            <?php endif; ?>
            <div class="cart-page-item-data">
              <h4>Total: </h4> 
              <p id="<?php echo e($cart->id); ?>-total">AED <?php echo e(number_format($cart->total, 2)); ?></p>
            </div>
              <button class="remove-btn btn"><a href="<?php echo e(route('cart-delete', $cart->id)); ?>"> Remove </a></button>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php else: ?>
        <p>Sorry! Your cart is empty. Choose products <a href="<?php echo e(route('home')); ?>"> here </a>!</p>
      <?php endif; ?>
    </div>

    <div class="cart-summary">
      <?php
        $subtotal = Helper::CartAmount();
        $tax = Helper::totalCartTax();
        $discount = Helper::total_discount();
        $total_amount = Helper::totalCartAmount();
      ?>

      <div class="summary-title-container">
        <h2>Cart Summary</h2>
      </div>
      
      <div class="cart-totals">
        <div class="cart-total-value">
          <h4 class="subtotal"> Subtotal: </h4>
          <p id="subtotal-value">AED <?php echo e(number_format($subtotal, 2)); ?></p>
        </div>
        <div class="cart-total-value">
          <h4 class="tax"> VAT(5%): </h4>
          <p id="tax-value">AED <?php echo e(number_format($tax, 2)); ?></p>
        </div>
        <?php if(auth()->guard()->check()): ?>
          <div class="cart-total-value">
            <h4 class="discount"> Discount: </h4>
            <p id="discount-value">AED <?php echo e(number_format($discount, 2)); ?></p>
          </div>
        <?php endif; ?>
      </div>
        <div class="cart-total-value grand-total">
          <h4 class="total"> Grand Total: </h4>
          <p id="grand-total-value">AED <?php echo e(number_format($total_amount, 2)); ?></p>
        </div>
      <a href="<?php echo e(route('checkout')); ?>" class="btn btn-checkout">Checkout</a>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?> 
  <script src="<?php echo e(asset('frontend/js/cart.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/frontend/pages/cart.blade.php ENDPATH**/ ?>