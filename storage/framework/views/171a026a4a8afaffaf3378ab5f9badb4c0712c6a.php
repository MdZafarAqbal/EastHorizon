<?php $__env->startSection('title','HERB || PRODUCT PAGE'); ?>

<?php $__env->startPush('styles'); ?>
  <link href="<?php echo e(asset('frontend/css/products.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('frontend/css/modal.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
  <section class="products-catalog">
    <div id="products-catalog" class="products catalog">
      <?php if($products->count() > 0): ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $minprice = $product->attrs()->min('price');
            $maxprice = $product->attrs()->max('price');
          ?>
              <div class="product-card <?php echo e($product->id); ?>-card carousel-cell">
                <img class="product-image" src="<?php echo e($product->photo); ?>" alt="product image">
                
                <div class="overlay">
                  <button id="product<?php echo e($product->id); ?>" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, <?php echo e($product->id); ?>)"> 
                    <i class="fa-regular fa-eye"></i>
                    <p>Quick View</p>
                  </button>
                </div>

                <div class="meta-detail">
                  <h3 class="product-title"><?php echo e($product->name); ?></h3>
                  <?php if($minprice==$maxprice): ?>
                    <p class="price">AED <span class="value"><?php echo e(number_format($product->minprice,2)); ?></span></p>
                  <?php else: ?>
                    <p class="price">AED <span class="value"><?php echo e(number_format($product->minprice,2)); ?></span> - AED <span class="value"><?php echo e(number_format($maxprice,2)); ?></span></p>
                  <?php endif; ?>                  
                </div>
                <div class="prod-detail-link">
                  <a href="<?php echo e(route('product-detail', $product->slug)); ?>" class="btn btn-submit detail-link"> Product Details </a>
                  <button class="remove-btn btn"><a href="<?php echo e(route('wishlist-delete', ['id' => $product->id, 'reload' => 1])); ?>"> Remove </a></button>
                </div>
              </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <p class="no-product">There is no product in the wishlist.</p>
      <?php endif; ?>
    </div>
    <div class="modal-container" id="modal-container"></div>
    <section id="checkout-popup" class="checkout-popup">
      <div id="location-popup" class="ch-popup" data-toggle="0" tabindex="-1">
        <button type="button" class="btn close close-inner" id="inner-close-btn" onclick="remInnerModal()">
          <i class="fa-solid fa-xmark"></i>
        </button>
        <button id="page-loc-btn" class="btn btn-submit popup-btn loc-btn" onclick="remInnerModal()">Stay on Page</button>
        <?php if(auth()->guard()->check()): ?>
          <button id="chkt-loc-btn" class="btn btn-submit popup-btn loc-btn" onclick="location.href = '/checkout'">Checkout</button>
        <?php else: ?>
          <button id="chkt-loc-btn" class="btn btn-submit popup-btn loc-btn" onclick="chOptions()">Checkout</button>
          <button id="guest-chkt-btn" class="btn btn-submit popup-btn chkt-btn collapse" onclick="location.href = '/checkout'">Checkout as Guest</button>
          <button id="login-chkt-btn" class="btn btn-submit popup-btn chkt-btn collapse" onclick="location.href = '/login?checkout=1'">Login to Checkout</button>
        <?php endif; ?>
      </div>
    </section>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('frontend/js/products.js')); ?>"></script>
  <script src="<?php echo e(asset('frontend/js/modal.js')); ?>"></script>
  <script>
    $(function() {
      /* Show sorting menu*/
      $('#selected-sort').click(() => {
        $('#sorting-list').toggleClass('collapse');
      })
    })
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\frontend\pages\wishlist.blade.php ENDPATH**/ ?>