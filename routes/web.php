<?php

use App\Http\Controllers\BlogsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\VouchersController;
use App\Http\Controllers\OrdersController;

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

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::resource('/dashboard', DashboardAdminController::class);
        Route::get('/get-penjualan', [App\Http\Controllers\DashboardAdminController::class, 'getPenjualan'])->name('get-penjualan');
        Route::get('/get-penjualan-bulan', [App\Http\Controllers\DashboardAdminController::class, 'getPenjualanBulan'])->name('get-penjualan-bulan');
        Route::resource('/customer', UserController::class);
        Route::prefix('produk')->group(function () {
            Route::resource('/product', ProduksController::class);
            Route::put('/update-status-product/{id}', [App\Http\Controllers\ProduksController::class, 'updateStatusProduct'])->name('updateStatusProduct');
            Route::resource('/kategori', CategoriesController::class);
        });
        Route::resource('/order', OrdersController::class);
        Route::resource('/company', CompanyController::class);
        Route::resource('/blog', BlogsController::class);
        Route::post('/dashboard-admin', [App\Http\Controllers\DashboardAdminController::class, 'destroyAdmin'])->name('dashboard.destroyAdmin');
        Route::resource('/voucher',VouchersController::class);
        Route::get('/page_confirm_payment/{id}',[App\Http\Controllers\OrdersController::class, 'page_confirm_payment'])->name('pageConfirmPayment');
        Route::get('/page_confirm_pengiriman/{id}',[App\Http\Controllers\OrdersController::class, 'page_confirm_pengiriman'])->name('pageConfirmPengiriman');
        Route::put('/confirm_payment/{id}',[App\Http\Controllers\OrdersController::class, 'confirm_payment'])->name('confirmPayment');
        Route::put('/confirm_pengiriman/{id}',[App\Http\Controllers\OrdersController::class, 'confirm_pengiriman'])->name('confirmPengiriman');
        Route::post('/confirm_order/{id}',[App\Http\Controllers\OrdersController::class, 'confirm_order'])->name('confirmOrder');
        Route::get('/order-export-excel', [App\Http\Controllers\OrdersController::class, 'export'])->name('orderExcel');
        Route::resource('/merchant', MerchantController::class);
        Route::put('/update-status-merchant/{id}', [MerchantController::class,'changeStatus'])->name('updateStatusMerchant');
        Route::resource('/farmer', FarmerController::class);
        Route::get('/farmer-show-dashboard/{id}', [FarmerController::class,'showFarmerDashboard'])->name('farmerShowDashboard');
        Route::put('/update-status-farmer/{id}', [FarmerController::class,'changeStatus'])->name('updateStatusFarmer');
        Route::get('/history-farmer', [FarmerController::class,'farmerHistory'])->name('farmerHistory');
    });
});


Route::group(['middleware' => ['company']], function () {
    Auth::routes();

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/form-login', [App\Http\Controllers\HomeController::class, 'login'])->name('form.login.user');
    Route::get('/form-register', [App\Http\Controllers\HomeController::class, 'register'])->name('form.register.user');
    Route::post('/register-user', [App\Http\Controllers\HomeController::class, 'registerUser'])->name('register.user');
    Route::get('/profile-user', [App\Http\Controllers\HomeController::class, 'profileUser'])->name('profile.user');
    Route::get('/list-order', [App\Http\Controllers\HomeController::class, 'listOrderUser'])->name('listorder.user');
    Route::put('/ubah-profile/{id}', [App\Http\Controllers\HomeController::class, 'ubahProfile'])->name('ubah.profile');
    Route::put('/ubah-password-user/{id}', [App\Http\Controllers\HomeController::class, 'ubahPasswordUser'])->name('ubah.passwordUser');

    Route::get('/detail-order/{id}',[App\Http\Controllers\HomeController::class, 'orderDetailUser'])->name('detailOrder.edit');
    Route::put('/pembayaran-order/{id}',[App\Http\Controllers\HomeController::class, 'konfirmasiOrder'])->name('detailOrder.pembayaran');

    Route::get('/semua-produk', [App\Http\Controllers\HomeController::class, 'shopUser'])->name('shop.user');
    Route::get('/detail-produk/{id}/{slug}', [App\Http\Controllers\HomeController::class, 'detailProduk'])->name('detail.produk');

    Route::get('/get-cart', [App\Http\Controllers\HomeController::class, 'getCart'])->name('get-cart');
    Route::post('/add-cart', [App\Http\Controllers\HomeController::class, 'addCart'])->name('add-cart');
    Route::post('/update-cart', [App\Http\Controllers\HomeController::class, 'updateCart'])->name('update-cart');
    Route::get('/detail-cart', [App\Http\Controllers\HomeController::class, 'detailCart'])->name('detail-cart');
    Route::get('/ongkir-cart', [App\Http\Controllers\HomeController::class, 'ongkirCart'])->name('ongkir-cart');
    Route::delete('/delete-cart', [App\Http\Controllers\HomeController::class, 'deleteCart'])->name('delete-cart');

    Route::get('/get-voucher', [App\Http\Controllers\HomeController::class, 'getVoucher'])->name('get-voucher');

    Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');

    Route::get('/address/user', [App\Http\Controllers\HomeController::class, 'addressUser'])->name('address.user');
    Route::get('/address/user/create', [App\Http\Controllers\HomeController::class, 'addressUserCreate'])->name('address.user.create');
    Route::post('/address/user/store', [App\Http\Controllers\HomeController::class, 'addressUserStore'])->name('address.user.store');
    Route::get('/address/user/edit/{id}', [App\Http\Controllers\HomeController::class, 'addressUserEdit'])->name('address.user.edit');
    Route::put('/address/user/update/{id}', [App\Http\Controllers\HomeController::class, 'addressUserUpdate'])->name('address.user.update');
    Route::delete('/address/user/destroy/{id}', [App\Http\Controllers\HomeController::class, 'addressUserDestroy'])->name('address.user.destroy');

    Route::get('/company-profile', [App\Http\Controllers\HomeController::class, 'companySetting'])->name('company-setting');
    Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blogSetting'])->name('blog');
    Route::get('/blog-detail/{id}',[App\Http\Controllers\HomeController::class, 'blogDetail'])->name('blog-detail');

    Route::get('/merchant-user', [App\Http\Controllers\HomeController::class, 'merchantUser'])->name('merchant-user');
    Route::post('/merchant-user/store', [App\Http\Controllers\HomeController::class, 'merchantStore'])->name('merchant-user.store');
    Route::put('/merchant-user/update/{id}', [App\Http\Controllers\HomeController::class, 'merchantUpdate'])->name('merchant-user.update');

    Route::get('/farmer-user', [App\Http\Controllers\HomeController::class, 'farmerUser'])->name('farmer-user');
    Route::post('/farmer-user/store', [App\Http\Controllers\HomeController::class, 'farmerStore'])->name('farmer-user.store');
    Route::put('/farmer-user/update/{id}', [App\Http\Controllers\HomeController::class, 'farmerUpdate'])->name('farmer-user.update');

    Route::get('/terimakasih', [App\Http\Controllers\HomeController::class, 'terimakasih'])->name('terimakasih');
});









