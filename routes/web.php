<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Register User
Route::view('/register', 'frontend.pages.register')->middleware('guest')->name('register.form');
Route::redirect('/signup', '/register')->name('signup.form');
Route::post('/register-user','Auth\RegisterController@register_submit')->name('register.submit');

// Verify Email
Route::view('/verify-email', 'auth.verify-email')->middleware(['auth', 'not.verified'])->name('verification.email');
Route::redirect('/email-verify', '/verify-email')->name('verify.email');
Route::get('/email-verify/{id}/{hash}', 'Auth\VerificationController@emailVerification')->middleware(['auth', 'signed', 'not.verified'])->name('verification.verify');
Route::post('/resend-verification-email', 'Auth\VerificationController@resendEmailVerification')->middleware(['auth', 'throttle:6,1', 'not.verified'])->name('verification.resend');

// Login User
Route::get('/login', 'Auth\LoginController@login')->name('login.form');
Route::redirect('/signin', '/login')->name('signin.form');
Route::post('user-login', 'Auth\LoginController@loginSubmit')->name('login.submit');

// Logout User
Route::get('/logout', 'FrontendController@logout')->middleware('auth')->name('logout');
Route::redirect('user-logout', '/logout')->name('user.logout');

// Reset password
Route::view('password-reset', 'auth.passwords.old-reset')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password-resets', 'FrontendController@PassResetForm')->name('password.resets');

Route::get('/autocomplete-search', 'FrontendController@autocomplete_search')->name('search-suggestion');

// Frontend Main Pages
Route::get('/','FrontendController@home')->name('home')->middleware('verified');
Route::get('/home', 'FrontendController@home')->middleware('verified');
Route::view('/about-us','frontend.pages.about-us')->name('about-us')->middleware('verified');
Route::view('/contact','frontend.pages.contact')->name('contact')->middleware('verified');
Route::get('product-detail/{slug}','FrontendController@product_detail')->name('product-detail')->middleware('verified');
Route::match(['get','post'], '/product/search', 'FrontendController@product_search')->name('product.search')->middleware('verified');
Route::match(['get','post'], '/sort','FrontendController@productSort')->name('product-sort')->middleware('verified');
Route::get('/product-cat/{slug}','FrontendController@productCat')->name('product-cat')->middleware('verified');
Route::get('/product-cat/{slug}/{subslug}','FrontendController@productSubCat')->name('product-subcat')->middleware('verified');
Route::get('/products','FrontendController@products')->name('products')->middleware('verified');
Route::view('/checkout', 'frontend.pages.checkout')->name('checkout');
Route::view('/faq', 'frontend.pages.faq')->name('faq');
Route::view('/privacy-policy', 'frontend.pages.privacy-policy')->name('privacy-policy');
Route::get('/repair', 'RepairController@repair_create')->name('repair-create');
Route::post('/repair-store', 'RepairController@repair_store')->name('repair-store');
Route::view('/terms-and-conditions', 'frontend.pages.terms-and-conditions')->name('terms-and-conditions');

// Create Modal
Route::get('/create-modal','ModalController@create_modal')->name('create-modal')->middleware('verified');
//Route::get('/create-sizes','ModalController@create_sizes')->name('create-sizes')->middleware('verified');

// Cart section
Route::get('/cart-add', 'CartController@cart_add')->name('add-to-cart');
Route::get('cart-delete/{id}','CartController@cartDelete')->name('cart-delete');
Route::get('cart-update','CartController@cart_update')->name('cart.update');

Route::view('/cart', 'frontend.pages.cart')->name('cart');

Route::get('/states', 'StateController@getStates');
Route::get('/cities', 'CityController@getCities');


// Wishlist
Route::get('/wishlist', 'WishlistController@wishlist')->name('wishlist');
Route::get('wishlist-add/','WishlistController@wishlist_add')->name('add-to-wishlist')->middleware('user');
Route::get('wishlist-delete/','WishlistController@wishlist_delete')->name('wishlist-delete');
Route::post('/order','OrderController@place_order')->name('order');
Route::get('/income','OrderController@incomeChart')->name('product.order.income');

// Order invoices
Route::get('sale/{id}/order/{download?}', 'OrderController@sale_invoice')->name('sale.pdf');
Route::get('tax/{id}/order/{download?}', 'OrderController@tax_invoice')->name('tax.pdf');

// Order Track
Route::get('/order-track/{order_no}', 'OrderController@track_order')->name('order-track');
Route::get('/order-cancel/{order_no}', 'OrderController@action_view')->name('cancel-view');
Route::get('/order-return/{order_no}', 'OrderController@action_view')->name('return-view');

// Order Details
Route::get('/orders', 'OrderController@user_orders')->name('orders');
Route::get('/order-detail/{order_no?}', 'OrderController@order_detail')->name('order-detail');

// Return item or order
Route::get('/order-return', 'OrderController@return_order')->name('order-return');

// cancel item or order
Route::get('/action-email/{action}', 'OrderController@action_email')->name('action-email');
Route::get('/order-cancel', 'OrderController@cancel_order')->name('order-cancel');

// Product Review
Route::resource('/review','ProductReviewController');
Route::post('/product/{slug}/review','ProductReviewController@store')->name('review-store');

// Payment
Route::match(['get','post'], '/stripe', 'StripeController@payment')->name('order-payment');
Route::post('/payment-refund', 'StripeController@refund')->name('payment-refund');

//ProductAttribute
Route::match(['get','post'], '/admin/product/edit-attributes/{id}','ProductController@editAttributes')->name('editAttribute');

Route::match(['get','post'], 'admin/product/delete-attributes/{id}','ProductController@deleteAttribute')->name('delete-attribute');
//Add Product Image
Route::match(['get','post'], 'admin/product/delete-images/{id}','ProductController@deleteImage')->name('delete-image');
//Delete category
Route::match(['get','post'], 'admin/product/delete-category/{id}','ProductController@deleteCategory')->name('delete-category');
//Delete Brand
Route::match(['get','post'], 'admin/product/delete-brand/{id}','ProductController@deleteBrand')->name('delete-brand');

Route::get('/get-product-price', 'FrontendController@getProductPrice');
Route::get('/already-user', 'Auth\RegisterController@already_user');
Route::get('/user-exists', 'Auth\LoginController@user_exists');

//Get SubCategory
Route::post('/admin/category/{id}/child','CategoryController@getChildByParent');

// Backend section start
Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index')->name('admin');
    Route::get('/file-manager',function(){
        return view('admin_panel.layouts.file-manager');
    })->name('file-manager');
    // user route
    Route::resource('users','UsersController');
    // Banner
    Route::resource('banner','BannerController');
    // Brand
    Route::resource('brand','BrandController');
    // Profile
    Route::get('/profile','AdminController@profile')->name('admin-profile');
    Route::post('/profile/{id}','AdminController@profileUpdate')->name('profile-update');
    // Category
    Route::resource('/category','CategoryController');
    // Subcategory
    Route::resource('/subcategory','SubCategoryController');
    // Seller
    Route::resource('/seller','SellerController');
    //Country
    Route::resource('/country','CountryController');
    //State
    Route::resource('/state','StateController');
    // Product
    Route::resource('/product','ProductController');
    //import product
    Route::resource('/productImport','ProductImportController');
    //Repair
    Route::resource('repair','RepairController');

    //Buyer
    Route::resource('buying','BuyController');
    
    // Order
    Route::resource('/order','OrderController');
    // city
    Route::resource('/city','CityController');
    // Settings
    Route::get('settings','AdminController@settings')->name('settings');
    Route::post('setting/update','AdminController@settingsUpdate')->name('settings.update');

    // Notification
    Route::get('/notification/{id}','NotificationController@show')->name('admin.notification');
    Route::get('/notifications','NotificationController@index')->name('all.notification');
    Route::delete('/notification/{id}','NotificationController@delete')->name('notification.delete');
    // Password Change
    Route::get('change-password', 'AdminController@changePassword')->name('change.password.form');
    Route::post('change-password', 'AdminController@changPasswordStore')->name('change.password');
});

Route::get('/order-mail', 'MailController@order_mail')->name('order-mail');
