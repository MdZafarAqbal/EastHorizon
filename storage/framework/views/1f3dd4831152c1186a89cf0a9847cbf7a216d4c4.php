
<?php $__env->startSection('title','HERB || PRODUCT PAGE'); ?>

<?php $__env->startPush('styles'); ?>
  <link href="<?php echo e(asset('frontend/css/products.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('frontend/css/modal.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
  <div class="sorts product-sorts" id="product-sorts">
    <span>Sort by: </span>
    <span id="selected-sort" class="selected-sort dropdown-toggle">A to Z</span>
    <ul id="sorting-list" class="sorting-list collapse">
      <li class="sort-list-item" data="rand" onclick="sort(this, '<?php echo e($slug); ?>', '<?php echo e($subslug); ?>', '<?php echo e($search); ?>', '<?php echo e($que); ?>')">Random</li>
      <li class="selected sort-list-item" data="a-z" onclick="sort(this, '<?php echo e($slug); ?>', '<?php echo e($subslug); ?>', '<?php echo e($search); ?>', '<?php echo e($que); ?>')">A to Z</li>
      <li class="sort-list-item" data="z-a" onclick="sort(this, '<?php echo e($slug); ?>', '<?php echo e($subslug); ?>', '<?php echo e($search); ?>', '<?php echo e($que); ?>')">Z to A</li>
      <li class="sort-list-item" data="low-prc" onclick="sort(this, '<?php echo e($slug); ?>', '<?php echo e($subslug); ?>', '<?php echo e($search); ?>', '<?php echo e($que); ?>')">Low Price</li>
      <li class="sort-list-item" data="hgh-prc" onclick="sort(this, '<?php echo e($slug); ?>', '<?php echo e($subslug); ?>', '<?php echo e($search); ?>', '<?php echo e($que); ?>')">High Price</li>
      <li class="sort-list-item" data="new" onclick="sort(this, '<?php echo e($slug); ?>', '<?php echo e($subslug); ?>', '<?php echo e($search); ?>', '<?php echo e($que); ?>')">New</li>
      <li class="sort-list-item" data="popular" onclick="sort(this, '<?php echo e($slug); ?>', '<?php echo e($subslug); ?>', '<?php echo e($search); ?>', '<?php echo e($que); ?>')">Popular</li>
      <li class="sort-list-item" data="trending" onclick="sort(this, '<?php echo e($slug); ?>', '<?php echo e($subslug); ?>', '<?php echo e($search); ?>', '<?php echo e($que); ?>')">Trending</li>
    </ul>
  </div>

  <section class="products-catalog">
    <!-- Side Menu -->
    <?php if($cats): ?>
      <div class="products-sidebar">
        <div class="categories-menu">
          <h3 class="title">Categories</h3>
          <ul class="cat-list">
            <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $subcats = $cat->subcat()->get();
              ?>
              
              <?php if(count($subcats) != 0): ?>
                <?php if(!$subslug and $slug == $cat->slug): ?>
                  <li class="dropdown-toggle active">
                    <a href="<?php echo e(route('product-cat', $cat->slug)); ?>"><?php echo e($cat->name); ?></a>
                    <button class="btn btn-dropdown"><i class="fa-solid fa-caret-down"></i></button>
                  </li>
                <?php else: ?>
                  <li class="dropdown-toggle">
                    <a href="<?php echo e(route('product-cat', $cat->slug)); ?>"><?php echo e($cat->name); ?></a>
                    <button class="btn btn-dropdown"><i class="fa-solid fa-caret-down"></i></button>
                  </li>
                <?php endif; ?>
                <ul class="subcat">
                  <?php $__currentLoopData = $subcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($subslug == $subcat->slug): ?>
                      <li class="active"><a href="<?php echo e(route('product-subcat', [$cat->slug, $subcat->slug])); ?>"><?php echo e($subcat->name); ?></a></li>
                    <?php else: ?>
                      <li><a href="<?php echo e(route('product-subcat', [$cat->slug, $subcat->slug])); ?>"><?php echo e($subcat->name); ?></a></li>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              <?php else: ?>
                <?php if($slug == $cat->slug): ?>
                  <li class="active"><a href="<?php echo e(route('product-cat', $cat->slug)); ?>"><?php echo e($cat->name); ?></a></li>
                <?php else: ?>
                  <li><a href="<?php echo e(route('product-cat', $cat->slug)); ?>"><?php echo e($cat->name); ?></a></li>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>
    <?php endif; ?>
    <!-- End Sidebar -->
  
    <div id="products-catalog" class="products catalog">
      <?php if($products->count() > 0): ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $minprice = $product->attrs()->min('price');
            $maxprice = $product->attrs()->max('price');

            if(Auth::check())
              $wishlist = $product->wishlists()->where('user_id', Auth::user()->id)->get();
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
      <?php else: ?>
        <p class="no-product">There is no product in this category.</p>
      <?php endif; ?>
    </div>
    <div class="modal-container" id="modal-container"></div>
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
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views\frontend\pages\product-grids.blade.php ENDPATH**/ ?>