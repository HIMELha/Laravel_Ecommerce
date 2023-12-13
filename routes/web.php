<?php

use App\Http\Controllers\admin\adminLoginController;
use App\Http\Controllers\admin\brandController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\homeController;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\tempImage;
use App\Http\Controllers\cartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\admin\SlidesController;
use App\Http\Controllers\TempImageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Home routes
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/products', [ShopController::class, 'index'])->name('front.product');
Route::get('/categories', [FrontController::class, 'categories'])->name('front.categories');
Route::get('/products/{categorySlug}', [ShopController::class, 'index'])->name('front.products');
Route::get('/items/{slug}', [ShopController::class, 'productView'])->name('front.items');

// cart Routes
Route::get('/carts', [cartController::class, 'carts'])->name('front.carts');
Route::post('/add-to-cart', [cartController::class, 'addToCart'])->name('front.addToCart');
Route::post('/update-cart', [cartController::class, 'updateCart'])->name('front.updateCart');
Route::post('/delete-cart', [cartController::class, 'deleteCart'])->name('front.deleteCart');
Route::get('/checkout', [cartController::class, 'checkout'])->name('front.checkout');

Route::post('/process-checkout', [cartController::class, 'processCheckout'])->name('front.processCheckout');
Route::get('/thanks/{orderId}', [cartController::class, 'thankYou'])->name('front.thankYou');
Route::post('/get-order-summery', [cartController::class, 'getOrderSummery'])->name('front.getOrderSummery');
Route::post('/apply-discount', [cartController::class, 'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount', [cartController::class, 'removeDiscount'])->name('front.removeDiscount');

Route::post('/add-to-wishlists', [FrontController::class, 'addToWishlist'])->name('front.addToWishlist');
Route::post('/save-review', [ShopController::class, 'storeReview'])->name('front.storeReview');

Route::get('/pages/{name}', [FrontController::class, 'pages'])->name('pages.details');

        

Route::group(['prefix' => 'user'], function () {

    Route::group(['middleware' => 'guest'], function () {
        //Login Reg Routes
        Route::get('/login', [LoginController::class, 'index'])->name('front.login');
        Route::post('/verifyLogin', [LoginController::class, 'login'])->name('front.verifyLogin');
        Route::get('/register', [RegisterController::class, 'index'])->name('front.register');
        Route::post('/create-user', [RegisterController::class, 'create'])->name('front.registerCreate');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/account', [AccountController::class, 'index'])->name('user.account');

        Route::get('/payments', [PaymentController::class, 'index'])->name('user.payments');
        Route::get('/address', [AccountController::class, 'address'])->name('user.address');
        Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('user.updateProfile');
        Route::get('/orders', [AccountController::class, 'orders'])->name('user.orders');
        Route::get('/order-deatails/{orderId}', [AccountController::class, 'orderDetails'])->name('user.orderDetails');

        Route::get('/wishlist', [FrontController::class, 'wishlist'])->name('user.wishlist');
        Route::post('/deleteWishlist', [FrontController::class, 'deleteWishlist'])->name('user.deleteWishlist');
        



        // Payment Routes for bKash
        Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'index']);
        Route::get('/bkash/create-payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
        Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');

        //search payment
        Route::get('/bkash/search/{trxID}', [App\Http\Controllers\BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');

        Route::get('/logout', [loginController::class, 'logout'])->name('user.logout');
    });

});



// Admin Dashboard
Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [adminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [adminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        
        // authentication routes
        Route::get('/dashboard', [homeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [homeController::class, 'logout'])->name('admin.logout');
    

        //category routes
        Route::get('/categories', [categoryController::class, 'index'])->name('admin.categories');
        Route::get('/categories/create', [categoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/store', [categoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [categoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [categoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [categoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/getSlug', function(Request $request){
            if(!empty($request->title)){
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug,
            ]);
        })->name('getSlug');


        
        // brands route
        Route::get('/brands', [brandController::class, 'index'])->name('admin.brands');
        Route::get('/brands/create', [brandController::class, 'create'])->name('brands.create');
        Route::post('/brands/store', [brandController::class, 'store'])->name('brands.store');
        Route::get('/brands/{brands}/edit', [brandController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brands}', [brandController::class, 'update'])->name('brands.update');
        Route::delete('/brands/{brands}', [brandController::class, 'destroy'])->name('brands.destroy');


        // products route
        Route::get('/products', [productController::class, 'index'])->name('admin.products');
        Route::get('/products/create', [productController::class, 'create'])->name('products.create');
        Route::post('/products/store', [productController::class, 'store'])->name('products.store');
        Route::get('/products/{products}/edit', [productController::class, 'edit'])->name('products.edit');
        Route::put('/products/{brands}', [productController::class, 'update'])->name('products.update');
        Route::get('/products/{products}', [productController::class, 'destroy'])->name('products.destroy');


        // upload temp images
        Route::post('/upload-temp-image', [TempImageController::class, 'create'])->name('temp-image.create');
        Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
        Route::delete('/product-images/', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

        
        // Shippings routes 
        Route::get('/shipping', [ShippingController::class, 'index'])->name('admin.shipping');
        Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
        Route::post('/shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/shipping/edit/{shipping}', [ShippingController::class, 'edit'])->name('shipping.edit');
        Route::post('/shipping/update/{shipping}', [ShippingController::class, 'update'])->name('shipping.update');
        Route::delete('/shipping/destroy/{shipping}', [ShippingController::class, 'destroy'])->name('shipping.destroy');
        
        // Coupons routes
        Route::get('/coupons', [DiscountController::class, 'index'])->name('admin.coupons');
        Route::get('/coupons/create', [DiscountController::class, 'create'])->name('coupons.create');
        Route::post('/coupons/store', [DiscountController::class, 'store'])->name('coupons.store');
        Route::get('/coupons/edit/{coupons}', [DiscountController::class, 'edit'])->name('coupons.edit');
        Route::post('/coupons/update/{coupons}', [DiscountController::class, 'update'])->name('coupons.update');
        Route::delete('/coupons/destroy/{coupons}', [DiscountController::class, 'destroy'])->name('coupons.destroy');
        
        //orders routes
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
        Route::get('/orders/{id}', [OrderController::class, 'orderPage'])->name('orders.orderPage');
        Route::post('/orders/update', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // users routes
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        
        //Slide routes
        Route::get('/slides', [SlidesController::class, 'index'])->name('admin.slides');

        //Pages routes
        Route::get('/pages', [PageController::class, 'index'])->name('admin.pages');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
        Route::post('/pages/update/{id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/pages/delete/{id}', [PageController::class, 'destroy'])->name('pages.destroy');


        //refund payment routes
        Route::get('/bkash/refund/{paymentID}/{trxID}/{amount}', [App\Http\Controllers\BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
        Route::get('/bkash/refund/status', [App\Http\Controllers\BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');
        
        
        Route::get('/profile', [homeController::class, 'profile'])->name('admin.profile');
        Route::post('/update-profile', [homeController::class, 'update'])->name('admin.updateProfile');
        
        Route::get('/settings', [homeController::class, 'settings'])->name('admin.settings');
        
    });

});