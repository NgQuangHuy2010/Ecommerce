<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Interface\SecureController;
use App\Http\Controllers\Interface\User_ProductsController;
use App\Models\Categorie;
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
Route::match(['get','post'],"/check-out", [CheckoutController::class, 'checkout'])->name("gd.checkout"); 
Route::post("/payment", [CheckoutController::class, 'save_information'])->name("gd.save_information"); 
// Route::get("/check-out", [ApiVietNam::class, 'getApi'])->name("gd.getApi");
//payment
Route::match(['get','post'],'/pay', [PaymentController::class, 'pay'])->name('gd.pay');
Route::post("/momo_payment", [PaymentController::class, 'momo_payment'])->name("gd.momo_payment");
Route::get('/payment/confirm', [PaymentController::class, 'confirmPayment'])->name("gd.savepayment");
//product
Route::get("/product/{key}", [User_ProductsController::class, 'product'])->name("gd.product");
Route::get('/products/sort/{type}', [User_ProductsController::class, 'sort'])->name('product.sort');
//login
Route::match(['get','post'],"/login", [SecureController::class, 'login'])->name("gd.login");
Route::get("/logout", [SecureController::class, 'logout'])->name("gd.logout");
Route::match(['get','post'],"/register", [SecureController::class, 'register'])->name("gd.register");
// Route::get("/test", [SecureController::class, 'test'])->name("gd.test");
//reset password
Route::get("/forget-password", [SecureController::class, 'forgetPassword'])->name("gd.forget");
Route::post("/forget-password", [SecureController::class, 'forgetPasswordPost'])->name("gd.forgetPost");
Route::get("/reset-password/{token}", [SecureController::class, 'resetPassword'])->name("gd.resetPassword");
Route::post("/reset-password", [SecureController::class, 'resetPasswordPost'])->name("gd.resetPasswordPost");
//cart
Route::match(['get','post'],"/cart", [CartController::class, 'cart'])->name("gd.cart");
Route::post("/cart",[CartController::class,'addcart'])->name("gd.addcart");
Route::get("/del-cart/{key}",[CartController::class,'delcart'])->name("gd.delcart");


//dung route group
Route::middleware('phanquyen')->prefix("system")->group(function () {
    Route::get("/admin", [AdminController::class, 'index'])->name("ht.admin");
    Route::get("/login", [SecurityController::class, 'login'])->name("ht.login");
    //routes category
    Route::get("/categorie", [CategorieController::class, 'categorie'])->name("ht.categorie");
    Route::match(['get', 'post'], '/categorie/add', [CategorieController::class, 'add'])->name('ht.categorieadd');
    Route::match(['get', 'post'], '/categorie/update/{key}', [CategorieController::class, 'update'])->name('ht.categorieupdate');
    Route::get('/categorie/delete/{key}', [CategorieController::class, 'delete'])->name('ht.categoriedelete');
    ///routes products
    Route::get("/products", [ProductsController::class, 'products'])->name('ht.products');
    Route::match(['get', 'post'], '/products/add', [ProductsController::class, 'add'])->name('ht.productsadd');
    Route::match(['get', 'post'], '/products/update/{key}', [ProductsController::class, 'update'])->name('ht.productsupdate');
    Route::get('/products/delete/{key}', [ProductsController::class, 'delete'])->name('ht.productsdelete');
//logo
    Route::get("/logo", [LogoController::class, 'index'])->name('ht.logo');
    Route::match(['get', 'post'], '/logo/add', [LogoController::class, 'add'])->name('ht.logo_add');
    Route::match(['get', 'post'], '/logo/update/{key}', [LogoController::class, 'update'])->name('ht.logo_update');
    Route::get('/logo/delete/{key}', [LogoController::class, 'delete'])->name('ht.logo_delete');
  
    //banner
    Route::get("/banner", [BannerController::class, 'index'])->name('ht.banner');
    Route::match(['get', 'post'], '/banner/add', [BannerController::class, 'add'])->name('ht.banner_add');
    Route::match(['get', 'post'], '/banner/update/{key}', [BannerController::class, 'update'])->name('ht.banner_update');
    Route::get('/banner/delete/{key}', [BannerController::class, 'delete'])->name('ht.banner_delete');
  

})->middleware(Phanquyen::class);;

