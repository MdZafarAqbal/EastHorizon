<?php $__env->startSection('title', 'Checkout Order || East Horizon'); ?>

<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/checkout.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('frontend/css/loader.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
  <!-- Start Checkout -->
  <h1 class="title page-title">Checkout</h1>

  <?php
    $countries = DB::table('countries')->where('status', 'active')->get();
    $states = DB::table('states')->where('country_id', '784')->get();
    $subtotal = Helper::CartAmount();
    $tax = Helper::totalCartTax();
    $discount = Helper::total_discount();
    $total = Helper::totalCartAmount();
    $order_success = Session::get('order_success');
    $order_no = Session::get('order_no');
  ?>

  <?php if($total != 0 || $order_success): ?>
    <?php if(auth()->guard()->guest()): ?>
      <p class="checkout-para">Please register in order to checkout more quickly.</p>
    <?php endif; ?>

    <section class="shop-checkout checkout-sec">
      <!-- Form -->
      <div class="form-container">
        <form id="order-form" class="form" method="post" action="<?php echo e(route('order')); ?>" novalidate>
          <?php echo csrf_field(); ?>
          <fieldset class="type-selection">
            <legend>Customer</legend>
            <div class="form-group">
              <input type="radio" name="cust_type" id="individual" value="individual" checked>
              <label for="individual">Individual</label>
            </div>
            
            <div class="form-group">
              <input type="radio" name="cust_type" id="company" value="company">
              <label for="company">Company</label>
            </div>

            <?php if($errors->get('cust_type')): ?>
              <div class="error">
                <?php $__errorArgs = ['cust_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>
          </fieldset>

          <fieldset class="details">
            <legend>Invoice Details</legend>
            <div class="fl-bl">
              <div class="form-group" id="first-name">
                <label for="fname">First Name<span>*</span></label>
                <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php if(auth()->guard()->check()): ?><?php echo e(auth()->user()->fname); ?><?php else: ?><?php echo e(old('fname')); ?><?php endif; ?>">
              </div>

              <div class="form-group collapse" id="company-name">
                <label for="cname">Company Name<span>*</span></label>
                <input type="text" id="cname" name="cname" placeholder="Company Name" value="<?php if(auth()->guard()->check()): ?><?php echo e(auth()->user()->cname); ?><?php else: ?><?php echo e(old('cname')); ?><?php endif; ?>">
              </div>

              <div class="form-group" id="last-name">
                <label for="lname">Last Name<span>*</span></label>
                <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php if(auth()->guard()->check()): ?><?php echo e(auth()->user()->lname); ?><?php else: ?><?php echo e(old('lname')); ?><?php endif; ?>">
              </div>

              <div class="form-group collapse" id="trn">
                <label for="trn-number">TRN<span>*</span></label>
                <input type="number" id="trn-number" name="trn_no" placeholder="TRN Number" value="<?php if(auth()->guard()->check()): ?><?php echo e(auth()->user()->trn_no); ?><?php else: ?><?php echo e(old('trn_no')); ?><?php endif; ?>">
              </div>
            </div>

            <?php if($errors->get('fname')): ?>
              <div class="error">
                <?php $__errorArgs = ['fname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo $message; ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <?php if($errors->get('lname')): ?>
              <div class="error">
                <?php $__errorArgs = ['lname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo $message; ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <?php if($errors->get('cname')): ?>
              <div class="error">
                <?php $__errorArgs = ['cname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <?php if($errors->get('trn_no')): ?>
              <div class="error">
                <?php $__errorArgs = ['trn_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <div class="form-group">
              <label for="email">Email Address<span>*</span></label>
              <input type="email" name="email" id="email" placeholder="Email Address" value="<?php if(auth()->guard()->check()): ?><?php echo e(auth()->user()->email); ?><?php else: ?><?php echo e(old('email')); ?><?php endif; ?>">

              <?php if($errors->get('email')): ?>
                <div class="error">
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="address">Address<span>*</span></label>
              <input type="text" name="address" id="address" placeholder="Address" value="<?php echo e(old('address')); ?>">

              <?php if($errors->get('address')): ?>
                <div class="error">
                  <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
            </div>


            <div class="fl-bl">
              <div class="form-group">
                <label for='landmark'>Nearby Landmark</label>
                <input type="text" name="landmark" id="landmark" placeholder="Landmark" value="<?php echo e(old('landmark')); ?>">
              </div>

              <div id="country-form-group" class="form-group">
                <label for="country">Country<span>*</span></label>
                <input type="hidden" name="country" id="country" value="784">
                <div id="country-div" class="dropdown-selection" tabindex="0">
                  <div id="country-name">United Arab Emirates</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="countries" class="selection-list collapse" tabindex="-1">
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li id="country-<?php echo e($country->id); ?>" data-iso="<?php echo e($country->iso_code); ?>" data-call-code="<?php echo e($country->calling_code); ?>" onclick="country(this, <?php echo e($country->id); ?>)"><?php echo e($country->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </div>
            </div>

            <?php if($errors->get('landmark')): ?>
              <div class="error">
                <?php $__errorArgs = ['landmark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>
            
            <?php if($errors->get('country')): ?>
              <div class="error">
                <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <div class="fl-bl">
              <div id="state-form-group" class="form-group">
                <label for="state">State<span>*</span></label>
                <input type="hidden" name="state" id="state">
                <div id="state-div" class="dropdown-selection" tabindex="0">
                  <div id="state-name" class="select-placeholder">State</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="states" class="selection-list collapse" tabindex="-1">
                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li id="state-<?php echo e($state->id); ?>" data-state="<?php echo e($state->id); ?>" data-country="784" onclick="state(this)"><?php echo e($state->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </div>

              <div id="city-form-group" class="form-group">
                <label for="city">City<span>*</span></label>
                <input type="hidden" placeholder="City" name="city" id="city">
                <div id="city-div" class="dropdown-selection" tabindex="0">
                  <div id="city-name" class="select-placeholder">City</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="cities" class="selection-list collapse" tabindex="-1"></ul>
                </div>
              </div>
            </div>

            <?php if($errors->get('state')): ?>
              <div class="error">
                <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>
            
            <?php if($errors->get('city')): ?>
              <div class="error">
                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <div class="fl-bl">
              <div class="form-group">
                <label for="phone">Phone Number <span>*</span></label>
                <div class="phone-div">
                  <img class="flag-img flag" src="<?php echo e(asset('images/flags/AE.png')); ?>" alt="Country Flag Image" width="64">
                  <p class="call-code">+971</p>
                  <input type="tel" name="phone" id="phone" placeholder="50 123 4567" value="<?php echo e(old('phone')); ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="phone">Phone Number <sup class='optional'>(Optional)</sup></label>
                <div class="phone-div">
                  <img class="flag-img flag" src="<?php echo e(asset('images/flags/AE.png')); ?>" alt="Country Flag Image" width="64">
                  <p class="call-code">+971</p>
                  <input type="tel" name="altphone" id="altphone" placeholder="50 123 4567" value="<?php echo e(old('altphone')); ?>">
                </div>
              </div>
            </div>

            <?php if($errors->get('phone')): ?>
              <div class="error">
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            
            <?php elseif($errors->get('altphone')): ?>
              <div class="error">
                <?php $__errorArgs = ['altphone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

          </fieldset>

          <fieldset class="details">
            <legend>Shipping Details</legend>
            <h5>Same As Above?</h5>
            <div class="type-selection">
              <div class="form-group">
                <input type="radio" name="shipping_option" id="same" value="same" checked>
                <label for="same">Yes</label>
              </div>
              
              <div class="form-group">
                <input type="radio" name="shipping_option" id="different" value="different">
                <label for="different">No</label>
              </div>
            </div>

            <div id="shipping-details" class="collapse">
              <div class="fl-bl">
                <div class="form-group" id="shipping-first-name">
                  <label for="shipping-fname">First Name<span>*</span></label>
                  <input type="text" id="shipping-fname" name="shipping_fname" placeholder="First Name" value="<?php echo e(old('shipping_fname')); ?>">
                </div>

                <div class="form-group" id="shipping-last-name">
                  <label for="shipping-lname">Last Name<span>*</span></label>
                  <input type="text" id="shipping-lname" name="shipping_lname" placeholder="Last Name" value="<?php echo e(old('shipping_lname')); ?>">
                </div>
              </div>

              <?php if($errors->get('shipping_fname')): ?>
                <div class="error">
                  <?php $__errorArgs = ['shipping_fname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>

              <?php if($errors->get('shipping_lname')): ?>
                <div class="error">
                  <?php $__errorArgs = ['shipping_lname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="shipping-address">Address<span>*</span></label>
                <input type="text" name="shipping_address" id="shipping-address" placeholder="Shipping Address" value="<?php echo e(old('shipping_address')); ?>">

                <?php if($errors->get('shipping_address')): ?>
                  <div class="error">
                    <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <?php echo e($message); ?>

                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                <?php endif; ?>
              </div>

              <div class="fl-bl">
                <div class="form-group">
                  <label for="shipping-landmark">Nearby Landmark</label>
                  <input type="text" name="shipping_landmark" id="shipping-landmark" placeholder="Nearby Landmark" value="<?php echo e(old('shipping_landmark')); ?>">
                </div>

                <div id="shipping-country-form-group" class="form-group">
                <label for="shipping-country">Country<span>*</span></label>
                <input type="hidden" name="shipping_country" id="shipping-country" value="784">
                <div id="shipping-country-div" class="dropdown-selection" tabindex="0">
                  <div id="shipping-country-name">United Arab Emirates</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="shipping-countries" class="selection-list collapse" tabindex="-1">
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li id="shipping-country-<?php echo e($country->id); ?>" class="shipping" data-iso="<?php echo e($country->iso_code); ?>" data-call-code="<?php echo e($country->calling_code); ?>" onclick="country(this, <?php echo e($country->id); ?>)"><?php echo e($country->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </div>

              <?php if($errors->get('shipping_landmark')): ?>
                <div class="error">
                  <?php $__errorArgs = ['shipping_landmark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
              
              <?php if($errors->get('shipping_country')): ?>
                <div class="error">
                  <?php $__errorArgs = ['shipping_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e($message); ?>

                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="fl-bl">
              <div id="shipping-state-form-group" class="form-group">
                <label for="shipping-state">State<span>*</span></label>
                <input type="hidden" name="shipping_state" id="shipping-state">
                <div id="shipping-state-div" class="dropdown-selection" tabindex="0">
                  <div id="shipping-state-name" class="select-placeholder">State</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="shipping-states" class="selection-list collapse" tabindex="-1">
                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li id="shipping-state-<?php echo e($state->id); ?>" class="shipping" data-state="<?php echo e($state->id); ?>" data-country="784" onclick="state(this)"><?php echo e($state->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </div>

              <div id="shipping-city-form-group" class="form-group">
                <label for="shipping-city">City<span>*</span></label>
                <input type="hidden" placeholder="City" name="shipping_city" id="shipping-city">
                <div id="shipping-city-div" class="dropdown-selection" tabindex="0">
                  <div id="shipping-city-name" class="select-placeholder">City</div> 
                  <div class="dropdown-icon"><i class="fa-solid fa-angle-down"></i></div>
                  <ul id="shipping-cities" class="selection-list collapse" tabindex="-1"></ul>
                </div>
              </div>
            </div>

            <?php if($errors->get('shipping_state')): ?>
              <div class="error">
                <?php $__errorArgs = ['shipping_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>
            
            <?php if($errors->get('shipping_city')): ?>
              <div class="error">
                <?php $__errorArgs = ['shipping_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <div class="fl-bl">
              <div class="form-group">
                <label for="phone">Phone Number <span>*</span></label>
                <div class="phone-div">
                  <img class="shipping-flag-img flag" src="<?php echo e(asset('images/flags/AE.png')); ?>" alt="Country Flag Image" width="64">
                  <p class="shipping-call-code">+971</p>
                  <input type="tel" name="shipping_phone" id="shipping-phone" placeholder="50 123 4567" value="<?php echo e(old('shipping_phone')); ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="phone">Phone Number <sup class='optional'>(Optional)</sup></label>
                <div class="phone-div">
                  <img class="shipping-flag-img flag" src="<?php echo e(asset('images/flags/AE.png')); ?>" alt="Country Flag Image" width="64">
                  <p class="shipping-call-code">+971</p>
                  <input type="tel" name="shipping_altphone" id="shipping-altphone" placeholder="50 123 4567" value="<?php echo e(old('shipping_altphone')); ?>">
                </div>
              </div>
            </div>

            <?php if($errors->get('shipping_phone')): ?>
              <div class="error">
                <?php $__errorArgs = ['shipping_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

            <?php elseif($errors->get('shipping_altphone')): ?>
              <div class="error">
                <?php $__errorArgs = ['shipping_altphone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>
          </fieldset>

          <fieldset class="payment-mthd type-selection">
            <legend>Payment Method</legend>
            <div class="form-group">
              <input type="radio" name="pay_mthd" id="op-input" value="op" checked>
              <label for="op-input">Online Payment</label>
            </div>
            <div class="form-group">
              <input type="radio" name="pay_mthd" id="cod-input" value="cod">
              <label for="cod-input">Cash on Delivery</label>
            </div>
          </fieldset>

          <fieldset class="op-form" id="op-form">
            <legend>Online Payment</legend>
            <div class="fl-bl">
              <div class="form-group">
                <label for="account-no">Card Number</label>
                <input type="tel" id="account-no" class="account-no"  name="account_no"  placeholder="4242 4242 4242 4242" onkeypress="cardLen(this, event)" oninput="cardNum(this, event)" autocomplete="on">
              </div>
              
              <div class="form-group">
                <label for="account-name">Full Name</label>
                <input type="text" id="account-name" class="account-name" name="account_name" placeholder="Full Name (As per Card)" autocomplete="on">
              </div>
            </div>

            <?php if($errors->get('account_no')): ?>
              <div class="error">
                <?php $__errorArgs = ['account_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>
            
            <?php if($errors->get('account_name')): ?>
              <div class="error">
                <?php $__errorArgs = ['account_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo $message; ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <div class="fl-bl">
              <div class='form-group expiry'>
                <label for="expiry-month">Expiry Month</label>
                <input type="number" class='expiry-month' id='expiry-month' name="expiry_month" placeholder='MM'>
              </div>
              
              <div class='form-group expiry'>
                <label for="expiry-year">Expiry Year</label>
                <input type="number" class='expiry-year' id='expiry-year' name="expiry_year" min= "<?php echo date('Y'); ?>" placeholder='YYYY'>
              </div>

              <div class="form-group cvc">
                <label for="cvv-cvc">CVV/CVC</label>
                <input type="password" id="cvv-cvc" class="cvv-cvc" name="cvv_cvc" placeholder="CVV/CVC" pattern="[0-9]{3}" onkeypress="if(this.value.length == 3) return false;" autocomplete="off">
              </div>
            </div>

            <?php if($errors->get('expiry_month')): ?>
              <div class="error">
                <?php $__errorArgs = ['expiry_month'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <?php if($errors->get('expiry_year')): ?>
              <div class="error">
                <?php $__errorArgs = ['expiry_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <?php if($errors->get('cvv_cvc')): ?>
              <div class="error">
                <?php $__errorArgs = ['cvv_cvc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            <?php endif; ?>

            <div class="payment-options">
              <img src="<?php echo e(('admin_panel/img/payment-method.png')); ?>" alt="payment options">
            </div>
          </fieldset>
          <input type="submit" class="btn btn-checkout btn-plc" value="Place Order">
        </form>
      </div>

      <div class="order-summary">
        <div class="sums-summary">
          <div class="summary-title-container">
            <h2>Order Summary</h2>
          </div>
          <div class="cart-totals">
            <div class="cart-total-value">
              <h4 class="subtotal" data-price="<?php echo e(Helper::CartAmount()); ?>"> Subtotal: </h4>
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
            <div class="cart-total-value">
              <h4 class="shopping"> Shipping: </h4>
              <p id="shipping-value">AED 0.00</p>
            </div>
          </div>
        
          <div class="cart-total-value grand-total">
            <h4 class="total"> Grand Total: </h4>
            <p id="grand-total-value" data-total=<?php echo e($total); ?>>AED <?php echo e(number_format($total, 2)); ?></p>
          </div>
          <input type="submit" form="order-form" class="btn btn-checkout" value="Place Order">
        </div>
        <div class="cart" id="cart-summary">
          <?php
            $cart_products = Helper::getAllProductFromCart();
          ?>

          <?php if($cart_products): ?>
          <div class="summary-title-container">
            <h2>Cart Summary</h2>
          </div>
          <?php $__currentLoopData = $cart_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="cart-item">
            <img src="<?php echo e($cart->product['photo']); ?>" alt="product photo" class="cart-product-img zoom-img">
            <div class="cart-item-meta">
              <h2 class="cart-page-item-name"><?php echo e($cart->product['name']); ?></h2>
              <div class="cart-item-stats">
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
                  <p><?php echo e($cart->quantity); ?></p>
                </div>
                <div class="cart-page-item-total">
                  <h4>Total: </h4>
                  <p id="<?php echo e($cart->id); ?>-total">AED <?php echo e(number_format($cart->total, 2)); ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <?php else: ?>
          <p>Sorry! Your cart is empty. Choose products <a href="<?php echo e(route('home')); ?>"> here </a>!</p>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section class="loader-section popup-sec collapse">
      <div class="popup-container loader-container">
        <div class="loader">
          <div class="box box0">
            <div></div>
          </div>
          <div class="box box1">
            <div></div>
          </div>
          <div class="box box2">
            <div></div>
          </div>
          <div class="box box3">
            <div></div>
          </div>
          <div class="box box4">
            <div></div>
          </div>
          <div class="box box5">
            <div></div>
          </div>
          <div class="box box6">
            <div></div>
          </div>
          <div class="box box7">
            <div></div>
          </div>
          <div class="ground">
            <div></div>
          </div>
        </div>
      </div>
    </section>

    <section class="popup-sec order-success collapse">
      <div class="popup-container">
        <h3>Your order has been placed!</h3>
        <i class='bx bxs-check-circle bx-tada'></i>
        <p>Thankyou for your purchase!</p>
        <p>Your order number is: <span id="order-no"></span></p>
        <p>You have received an order confirmation email with details of your order.</p>
        <a href="<?php echo e(route('home')); ?>" class="btn btn-submit"> Continue Shopping </a>
      </div>
    </section>

  <?php else: ?>
    <h4>Please add items to cart to proceed further. <a href="<?php echo e(route('home')); ?>">Continue Shopping</a></h4>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('frontend/js/checkout.js')); ?>"></script>

<?php if($order_success): ?>
  <script>
    $(document).ready(function() {
      $('body').css('height', '90vh');
      $('body').css('overflow', 'hidden');
      $('.order-success').removeClass('collapse');
      $('#order-no').html('<?= $order_no ?>');
    });
  </script>
<?php endif; ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\East-Horizon\resources\views/frontend/pages/checkout.blade.php ENDPATH**/ ?>