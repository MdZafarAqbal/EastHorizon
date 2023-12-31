<header class="header web-header" id="header">
  <!-- Topbar -->
  <?php
    $settings = DB::table('settings')->first();
    $categories = Helper::getAllCategories();
  ?> 
  <div class="topbar" id="mob-header">
    <div class="header-content">
      <button id="menu-btn" class="btn header-icon" onclick="showMenu()"><i class="fa-solid fa-bars icon" id="bars-icon"></i></button>                                       

      <div class="header-logo-title">
        <a href="<?php echo e(route('home')); ?>" class="header-logo website-logo">
          <img src="<?php echo e($settings->logo); ?>" alt="logo">
        </a>

        <h1 class="header-title website-title">East Horizon</h1>
      </div>

      <button id="mob-cart-btn" class="btn header-icon items-menu-btn">
        <a href="<?php echo e(route('cart')); ?>">
          <i class="fa-solid fa-cart-shopping" id="cart-icon"></i>
          <div class="items-count"><span class="cart-count"><?php echo e(count(Helper::getAllProductFromCart())); ?></span></div>
        </a>
      </button>
    </div>

    <div class="search-bar" id= "search">
      <form method="post" action="<?php echo e(route('product.search')); ?>" id="search-form" class="search-form">
        <?php echo csrf_field(); ?>
        <input type="search" name="product_search" class="form-controller search-term" placeholder="Search Products..." autocomplete="off">                                                                
        <button type="submit" class="btn search-btn" value="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <button id="mob-fav-btn" class="btn fav-btn header-icon">
        <a href="<?php echo e(route('wishlist')); ?>">
        <i class="fa-solid fa-heart" id="fav-icon"></i>
        <div class="items-count"><span class="fav-qty"><?php echo e(Helper::favCount()); ?></span></div></a>
      </button>
    </div>      
  </div>
  
  <nav class="nav" id="mob-nav">
    <button type="button" class="btn close" id="close-btn" onclick="closeMenu()"><i class="fa-solid fa-xmark"></i></button>                  
    <div class="navbar-content">
      <ul class="menu">
        <li><a href="<?php echo e(route('home')); ?>" class="nav-link mob-nav">Home</a></li>
        <li><a href="<?php echo e(route('about-us')); ?>" class="nav-link mob-nav">About</a></li>
        <li id="shop">
          <a onclick="menu()" class="nav-link mob-nav dropdown-toggle">Shop</a>
          <i id="shop-dropdown-icon" class="bx bxs-down-arrow"></i>
          <ul class="collapse cat-menu" id="mob-cat-menu">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $subcat = $cat->subcat()->get();
              ?>

              <?php if($subcat->count() > 0): ?>
                <li class="submenu-dropdown">
                  <a href="<?php echo e(route('product-cat', $cat->slug)); ?>" class="dropdown-item"> <?php echo e($cat->name); ?></a>

                  <ul class="cat-submenu">
                    <?php $__currentLoopData = $subcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <a href="<?php echo e(route('product-subcat', [$cat->slug, $sub_menu->slug])); ?>" class="dropdown-item"> <?php echo e($sub_menu->name); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </li>
              <?php else: ?>
                <li>
                  <a href="<?php echo e(route('product-cat', $cat->slug)); ?>" class="dropdown-item"> <?php echo e($cat->name); ?> </a>
                </li>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </li>
        <li><a href="<?php echo e(route('contact')); ?>" class="nav-link mob-nav">Contact</a></li>
      </ul>
      <hr>
    
      <ul class="list-main">
        <li><i class="fa-solid fa-clipboard"></i></i><a class="user-nav" href="<?php echo e(route('orders')); ?>">Order Details</a></li>
        <?php if(auth()->guard()->check()): ?> 
          <?php if(Auth::user()->role=='admin'): ?>
            <li><i class="fa-solid fa-user-tie"></i><a class="user-nav" href="<?php echo e(route('admin')); ?>"  target="_blank"><?php if(Auth::user()->fname): ?><?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?><?php else: ?><?php echo e(Auth::user()->company_name); ?><?php endif; ?></a></li>
          <?php else: ?> 
            <li><i class="fa-solid fa-user"></i><a class="user-nav" href="javascript:void(0);"><?php if(Auth::user()->fname): ?> <?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?><?php else: ?><?php echo e(Auth::user()->company_name); ?><?php endif; ?></a></li>
          <?php endif; ?>
            <li><i class="fa-solid fa-right-from-bracket"></i><a class="user-nav" href="<?php echo e(route('user.logout')); ?>">Logout</a></li>
        <?php else: ?>
          <li><i class="fa-solid fa-right-to-bracket"></i><a class="user-nav" href="<?php echo e(route('login.form')); ?>">Login</a></li>
          <li><i class="fa-solid fa-user-plus"></i><a class="user-nav" href="<?php echo e(route('register.form')); ?>">Register</a></li>
        <?php endif; ?>
      </ul>    
    </div>
  </nav>
  
  <div class="topbar" id="desktop-header">
    <div class="header-content">
      <div id="header-logo" class="header-logo">                   
        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e($settings->logo); ?>" alt="logo" width="50" height="50"></a>
      </div>

      <div class="header-title-div">
        <h2 class="header-title">East Horizon</h2>
      </div>
      
      <div class="user-menu">
        <i class="fa-solid fa-user"></i>
      </div>

      <div class="list-main-container collapse">
        <ul id="desktop-user-menu" class="list-main">
          <li><i class="fa-solid fa-clipboard"></i></i><a class="user-nav" href="<?php echo e(route('orders')); ?>">Order Details</a></li>
          <?php if(auth()->guard()->check()): ?>
            <?php if(Auth::user()->role=='admin'): ?>
              <li><i class="fa-solid fa-user-tie d-user-icon"></i><a class="user-nav" href="<?php echo e(route('admin')); ?>"  target="_blank"><?php if(Auth::user()->fname): ?><?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?><?php else: ?><?php echo e(Auth::user()->company_name); ?><?php endif; ?></a></li>
            <?php else: ?> 
              <li><i class="fa-solid fa-user d-user-icon"></i><a class="user-nav" href="javascript:void(0);"><?php if(Auth::user()->fname): ?> <?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?><?php else: ?><?php echo e(Auth::user()->company_name); ?><?php endif; ?></a></li>
            <?php endif; ?>
              <li><i class="fa-solid fa-right-from-bracket d-user-icon"></i><a class="user-nav" href="<?php echo e(route('user.logout')); ?>">Logout</a></li>
          <?php else: ?>
            <li><i class="fa-solid fa-right-to-bracket d-user-icon"></i><a class="user-nav" href="<?php echo e(route('login.form')); ?>">Login</a></li>
            <li><i class="fa-solid fa-user-plus d-user-icon"></i><a class="user-nav" href="<?php echo e(route('register.form')); ?>">Register</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    
    <nav class="menu-bar" id="desktop-menu">
      <ul class="menu">
        <li><a href="<?php echo e(route('home')); ?>" class="nav-link desktop-nav">Home</a></li>
        <li><a href="<?php echo e(route('about-us')); ?>" class="nav-link desktop-nav">About</a></li>
        <li id = "shop">
          <a href="<?php echo e(route('products')); ?>" class="nav-link desktop-nav dropdown-toggle">Shop</a>
          <div class="collapse shop-menu">
            <ul class="cat-menu" id="desktop-cat-menu">
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php
                $subcat = $cat->subcat()->get();
              ?>

              <?php if($subcat->count() > 0): ?>
                <li class="submenu-dropdown">
                  <a href="<?php echo e(route('product-cat', $cat->slug)); ?>" class="dropdown-item"> <?php echo e($cat->name); ?> </a>
              
                  <div class="collapse submenu">
                    <ul class="cat-submenu">
                      <?php $__currentLoopData = $subcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                          <a href="<?php echo e(route('product-subcat', [$cat->slug, $sub_menu->slug])); ?>" class="dropdown-item"> <?php echo e($sub_menu->name); ?></a>
                        </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                </li>
              <?php else: ?>
                <li>
                  <a href="<?php echo e(route('product-cat', $cat->slug)); ?>" class="dropdown-item"> <?php echo e($cat->name); ?> </a>
                </li>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </li>
        <li><a href="<?php echo e(route('contact')); ?>" class="nav-link desktop-nav">Contact</a></li>
      </ul>

      <div class="search-bar">                                        
        <form method="post" action="<?php echo e(route('product.search')); ?>" class="search-form">
          <?php echo csrf_field(); ?>
          <input type="search" name="search" class="form-controller search-term" placeholder="Search Products..." autocomplete="off">                                                                
          <button type="submit" class="btn search-btn" value="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>

      <button class="btn header-icon items-menu-btn">
        <a href="<?php echo e(route('wishlist')); ?>" class="header-icon">
        <i class="fa-solid fa-heart" id="fav-icon"></i>
        <div class="items-count"><span class="fav-qty" style="position: relative;top: 0.14em;"><?php echo e(Helper::favCount()); ?></span></div></a>
      </button> 

      <button id="desktop-cart-btn" class="btn header-icon items-menu-btn">
        <a href="<?php echo e(route('cart')); ?>" class="header-icon">
        <i class="fa-solid fa-cart-shopping" id="cart-icon"></i>
        <div class="items-count"><span class="cart-count" style="position: relative;top: 0.14em;"><?php echo e(count(Helper::getAllProductFromCart())); ?></span></div></a>
            <div class="collapse shopping-item">
              <div class="dropdown-cart-header">
                <span class="cart-count-header"><?php echo e(count(Helper::getAllProductFromCart())); ?> Items</span>
                <a href="<?php echo e(route('cart')); ?>">View Cart</a>
              </div>

              <ul class="shopping-list">
                <?php $__currentLoopData = Helper::getAllProductFromCart(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <div class="product-det">
                      <h4><a class="prod-name" href="<?php echo e(route('product-detail',$data->product['slug'])); ?>" target="_blank"><?php echo e($data->product['name']); ?></a></h4>
                      <p class="font"><?php if($data->form): ?> <?php echo e($data->form); ?> - <?php endif; ?> <?php echo e(($data->size)); ?></p>
                      <p class="font"><?php echo e($data->quantity); ?> x <?php echo e(number_format($data->price,2)); ?> AED</p>
                      <a href="<?php echo e(route('cart-delete', $data->id)); ?>" class="remove font" title="Remove"><i class="fa-regular fa-trash-can"></i> Remove Item</a>
                    </div>
                    <a class="cart-img" href="#"><img src="<?php echo e($data->product['photo']); ?>" alt="product photo"></a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>

              <div class="bottom">
                <div class="total">
                    <span>Total = </span>
                    <span class="total-amount">AED <?php echo e(number_format(Helper::totalCartAmount(),2)); ?></span>
                </div>
                <div class="btn anim-checkout-btn">
                <a href="<?php echo e(route('checkout')); ?>">Checkout</a>
                <div class="hover"></div>
                </div>
              </div>              
            </div>
      </button> 
    </nav>
  </div> 
</header>
<?php /**PATH D:\XAMPP\htdocs\East Horizon\resources\views/frontend/layouts/header.blade.php ENDPATH**/ ?>