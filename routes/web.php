<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Interface\SecureController;
use App\Http\Controllers\Interface\User_ProductsController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Interface\HomeController;
use App\Http\Controllers\Interface\CartController;
use App\Http\Controllers\Interface\CheckoutController;
use App\Http\Controllers\Interface\PaymentController;

use App\Http\Middleware\Phanquyen;

//duong dan trang chu interface
Route::get("/", [HomeController::class, 'index'])->name("gd.home");

Route::get("/details/{name}/{key}", [HomeController::class, 'details'])->name("gd.details");
Route::get("/search/{key?}", [HomeController::class, 'search'])->name("gd.search"); //{key?} ? la nhap gi cung dc
Route::get("/no-result", [HomeController::class, 'no_result'])->name("gd.no_result");
//checkout
Route::match(['get', 'post'], "/check-out", [CheckoutController::class, 'checkout'])->name("gd.checkout");
Route::post("/payment", [CheckoutController::class, 'save_information'])->name("gd.save_information");
// Route::get("/check-out", [ApiVietNam::class, 'getApi'])->name("gd.getApi");
//payment
Route::get('/payment/confirm', [PaymentController::class, 'Payment'])->name("gd.savepayment");
//product
Route::get("/product/{key}", [User_ProductsController::class, 'product'])->name("gd.product");
Route::get('/products/sort/{type}', [User_ProductsController::class, 'sort'])->name('product.sort');
//login
Route::match(['get', 'post'], "/login", [SecureController::class, 'login'])->name("gd.login");
Route::get("/logout", [SecureController::class, 'logout'])->name("gd.logout");
Route::match(['get', 'post'], "/register", [SecureController::class, 'register'])->name("gd.register");
// Route::get("/test", [SecureController::class, 'test'])->name("gd.test");
//reset password
Route::get("/forget-password", [SecureController::class, 'forgetPassword'])->name("gd.forget");
Route::post("/forget-password", [SecureController::class, 'forgetPasswordPost'])->name("gd.forgetPost");
Route::get("/reset-password/{token}", [SecureController::class, 'resetPassword'])->name("gd.resetPassword");
Route::post("/reset-password", [SecureController::class, 'resetPasswordPost'])->name("gd.resetPasswordPost");
//cart
Route::match(['get', 'post'], "/cart", [CartController::class, 'cart'])->name("gd.cart");
Route::post("/cart", [CartController::class, 'addcart'])->name("gd.addcart");
Route::get("/del-cart/{key}", [CartController::class, 'delcart'])->name("gd.delcart");
//history order
Route::get("/history-order", [SecureController::class, 'historyOrder'])->name("gd.history");
// Show search order form and handle search order
Route::match(['get', 'post'], '/search-order', [SecureController::class, 'searchOrder'])->name('gd.searchorder');
//end history order

//login admin
Route::prefix('system')->group(function () {
    Route::match(['get', 'post'], "/login", [SecurityController::class, 'login'])->name("ht.login");
    Route::get("/logout", [SecurityController::class, 'logout'])->name("ht.logout");
});


//dung route group
Route::middleware(['auth'])->prefix("system")->group(function () {
    Route::get("/admin", [AdminController::class, 'index'])->name("ht.admin")->middleware('phanquyen:manage_orders');

    // Group routes that require 'manage_products' permission
    Route::middleware('phanquyen:manage_products')->group(function () {
        Route::get("/categorie", [CategorieController::class, 'categorie'])->name("ht.categorie");
        Route::match(['get', 'post'], '/categorie/add', [CategorieController::class, 'add'])->name('ht.categorieadd');
        Route::match(['get', 'post'], '/categorie/update/{key}', [CategorieController::class, 'update'])->name('ht.categorieupdate');
        Route::get('/categorie/delete/{key}', [CategorieController::class, 'delete'])->name('ht.categoriedelete');

        Route::get("/products", [ProductsController::class, 'products'])->name('ht.products');
        Route::match(['get', 'post'], '/products/add', [ProductsController::class, 'add'])->name('ht.productsadd');
        Route::match(['get', 'post'], '/products/update/{key}', [ProductsController::class, 'update'])->name('ht.productsupdate');
        Route::get('/products/delete/{key}', [ProductsController::class, 'delete'])->name('ht.productsdelete');
    });

    // Group routes that require 'manage_logo' permission
    Route::middleware('phanquyen:manage_logo')->group(function () {
        Route::get("/logo", [LogoController::class, 'index'])->name('ht.logo');
        Route::match(['get', 'post'], '/logo/add', [LogoController::class, 'add'])->name('ht.logo_add');
        Route::match(['get', 'post'], '/logo/update/{key}', [LogoController::class, 'update'])->name('ht.logo_update');
        Route::get('/logo/delete/{key}', [LogoController::class, 'delete'])->name('ht.logo_delete');
    });

    // Group routes that require 'manage_banner' permission
    Route::middleware('phanquyen:manage_banner')->group(function () {
        Route::get("/banner", [BannerController::class, 'index'])->name('ht.banner');
        Route::match(['get', 'post'], '/banner/add', [BannerController::class, 'add'])->name('ht.banner_add');
        Route::match(['get', 'post'], '/banner/update/{key}', [BannerController::class, 'update'])->name('ht.banner_update');
        Route::get('/banner/delete/{key}', [BannerController::class, 'delete'])->name('ht.banner_delete');
    });

    // Group routes that require 'manage_orders' permission
    Route::middleware('phanquyen:manage_orders')->group(function () {
        Route::get("/order", [OrderController::class, 'index'])->name('ht.order');
        Route::get("/order/details/{id}", [OrderController::class, 'order_details'])->name('ht.order_details');
        Route::match(['get', 'post'], '/order/add', [OrderController::class, 'add_order'])->name('ht.order_add');
        Route::post("/order-processing", [OrderController::class, 'saveOrderNew'])->name("ht.saveOrderNew");
        Route::post('/search-products', [OrderController::class, 'search_product'])->name('product.search');
    });

    // Group routes that require 'manage_accounts' permission
    Route::middleware('phanquyen:manage_accounts')->group(function () {
        Route::get("/account", [AccountController::class, 'index'])->name('ht.account');
        Route::match(['get', 'post'], '/account/add', [AccountController::class, 'add_account'])->name('ht.account_add');
        Route::match(['get', 'post'], '/account/update/{key}', [AccountController::class, 'edit_account'])->name('ht.account_update');
        Route::get('/account/delete/{key}', [AccountController::class, 'delete_account'])->name('ht.account_delete');

        Route::get("/role", [RoleController::class, 'index_role'])->name('ht.role');
        Route::post('/role/add-role', [RoleController::class, 'add_role'])->name('ht.role_add');
        Route::get('/role/add', [RoleController::class, 'add_role_view'])->name('ht.role_add_view');
        Route::get("/role/{id}", [RoleController::class, 'delete_role'])->name('ht.delete_role');
        Route::get('/role/update/{id}', [RoleController::class, 'update_role_view'])->name('ht.edit_role_view');
        Route::post('/role/{id}', [RoleController::class, 'update_role'])->name('ht.role_update');
       

    });
});




