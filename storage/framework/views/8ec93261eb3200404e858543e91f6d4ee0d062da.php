<?php $__env->startSection('title','East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link href="<?php echo e(asset('frontend/css/index.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('frontend/css/modal.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
 
  <?php if(count($banners)>0): ?>
    <section id="slider" class="slider">         
      <ul id="carousel-wrap" class="carousel-wrap">
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                    
          <li>
            <picture>
              <source media="(min-width: 768px)" srcset="<?php echo e($banner->photo_desktop); ?>">
              <source media="(min-width: 480px)" srcset="<?php echo e($banner->photo_tablet); ?>">
              <img class="slide-img" src="<?php echo e($banner->photo_mobile); ?>" alt="Slider Image">
            </picture>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>

      <a href="#" id="slide-prev">&lt;</a>
      <a href="#" id="slide-next">&gt;</a>
    </section>
  <?php endif; ?>

  <section class="products-catalog">
    <?php
      $auth = Auth::check();
    ?>

    <?php if(count($pop_products) != 0): ?>
      <div class="products">
        <h2 class="cat-title"> Popular Items </h2>
      
        <div class="product-slider carousel hero-slider"  data-flickity='{ "contain": true, "pageDots": false, "autoPlay": 3000}'>
          <?php $__currentLoopData = $pop_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php         
              if($auth)
                $wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();
            ?>
            <div class="product-card <?php echo e($product->id); ?>-card carousel-cell">
              <img class="product-image" src="<?php echo e($product->photo); ?>" alt="product image">
              
              <div class="overlay">
                <button id="pop<?php echo e($product->id); ?>" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, <?php echo e($product->id); ?>)"> 
                  <i class="fa-regular fa-eye"></i>
                  <p>Quick View</p>
                </button>
              </div>

              <div class="meta-detail">
                <h4 class="card-product-title"><?php echo e($product->name); ?></h4>   
                  <p class="price">AED <span class="value"><?php echo e(number_format($product->price,2)); ?></span></p>
              </div>
              <div class="prod-detail-link">
                <a href="<?php echo e(route('product-detail', $product->slug)); ?>" class="btn btn-submit detail-link"> Product Details </a>
                <?php if(auth()->guard()->check()): ?>
                  <?php if(count($wishlist) != 0): ?>
                    <button class="btn favbtn" onclick="fav(this, <?php echo e($product->id); ?>)"><i class="fa-solid fa-heart fav"></i></button>
                  <?php else: ?>
                    <button class="btn favbtn" onclick="fav(this, <?php echo e($product->id); ?>)"><i class="fa-regular fa-heart fav"></i></button>
                  <?php endif; ?>
                <?php else: ?>
                  <button class="btn favbtn" onclick="window.location.href = '/login';"><i class="fa-regular fa-heart fav"></i></button>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if(count($trn_products) != null): ?>
      <div class="products">
        <h2 class="cat-title"> Trending Items </h2>
      
        <div class="product-slider carousel hero-slider"  data-flickity='{ "contain": true, "pageDots": false, "autoPlay": 3000}'>
          <?php $__currentLoopData = $trn_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              if($auth)
                $wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();
            ?>
            <div class="product-card <?php echo e($product->id); ?>-card carousel-cell">
              <img class="product-image" src="<?php echo e($product->photo); ?>" alt="product image">
              
              <div class="overlay">
                <button id="trn<?php echo e($product->id); ?>" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, <?php echo e($product->id); ?>)"> 
                  <i class="fa-regular fa-eye"></i>
                  <p>Quick View</p>
                </button>
              </div>

              <div class="meta-detail">
                <h4 class="card-product-title"><?php echo e($product->name); ?></h4>
                <p class="price">AED <span class="value"><?php echo e(number_format($product->price,2)); ?></span></p>
              </div>
              <div class="prod-detail-link">
                <a href="<?php echo e(route('product-detail', $product->slug)); ?>" class="btn btn-submit detail-link"> Product Details </a>
                
                <?php if(auth()->guard()->check()): ?>
                  <?php if(count($wishlist) != 0): ?>
                    <button class="btn favbtn" onclick="fav(this, <?php echo e($product->id); ?>)"><i class="fa-solid fa-heart fav"></i></button>
                  <?php else: ?>
                    <button class="btn favbtn" onclick="fav(this, <?php echo e($product->id); ?>)"><i class="fa-regular fa-heart fav"></i></button>
                  <?php endif; ?>
                <?php else: ?>
                  <button class="btn favbtn" onclick="window.location.href = 'user/login';"><i class="fa-regular fa-heart fav"></i></button>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endif; ?>
    <?php if(count($new_products) != 0): ?>
      <div class="products">
        <h2 class="cat-title"> New Items </h2>
      
        <div class="product-slider carousel hero-slider"  data-flickity='{ "contain": true, "pageDots": false, "autoPlay": 3000}'>
          <?php $__currentLoopData = $new_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              if($auth)
                $wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();
            ?>
            <div class="product-card <?php echo e($product->id); ?>-card carousel-cell">
              <img class="product-image" src="<?php echo e($product->photo); ?>" alt="product image">
              
              <div class="overlay">
                <button id="new<?php echo e($product->id); ?>" class="btn btn-quick-view" title="Quick View" onclick="showModal(id, <?php echo e($product->id); ?>)"> 
                  <i class="fa-regular fa-eye"></i>
                  <p>Quick View</p>
                </button>
              </div>

              <div class="meta-detail">
                <h4 class="card-product-title"><?php echo e($product->name); ?></h4>
                <p class="price">AED <span class="value"><?php echo e(number_format($minprice,2)); ?></span></p>
              </div>
              <div class="prod-detail-link">
                <a href="<?php echo e(route('product-detail', $product->slug)); ?>" class="btn btn-submit detail-link"> Product Details </a>
                <?php if(auth()->guard()->check()): ?>
                  <?php if(count($wishlist) != 0): ?>
                    <button class="btn favbtn" onclick="fav(this, <?php echo e($product->id); ?>)"><i class="fa-solid fa-heart fav"></i></button>
                  <?php else: ?>
                    <button class="btn favbtn" onclick="fav(this, <?php echo e($product->id); ?>)"><i class="fa-regular fa-heart fav"></i></button>
                  <?php endif; ?>
                <?php else: ?>
                  <button class="btn favbtn" onclick="window.location.href = 'user/login';"><i class="fa-regular fa-heart fav"></i></button>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endif; ?>

    
    <div id="modal-container" class="modal-container"></div>
    <section id="checkout-popup" class="checkout-popup">
      <div id="location-popup" class="ch-popup" data-toggle="0">
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
  <script src="<?php echo e(asset('frontend/js/index.js')); ?>"></script>
  <script src="<?php echo e(asset('frontend/js/modal.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/frontend/index.blade.php ENDPATH**/ ?>