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
// authentication
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->middleware('guest')->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registerPost'])->middleware('guest')->name('registerPost');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/loginPost', [\App\Http\Controllers\AuthController::class, 'loginPost'])->middleware('guest')->name('loginPost');

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


// orders ADMIN
Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->middleware('auth')->name('orders');


//  admin panel routes
Route::prefix('admin')->middleware(['isAdmin', 'auth'])->name('admin.')->group(function () {

    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('/products', \App\Http\Controllers\ProductController::class);
    Route::resource('/orders', \App\Http\Controllers\AdminOrdercontroller::class);

});

Route::middleware('set_locale')->group(function () {
//language changeLocale
    Route::get('/locale/{locale}', [\App\Http\Controllers\MainController::class, 'changeLocale'])->name('locale');
    Route::get('/currency/{currencyCode}', [\App\Http\Controllers\MainController::class, 'changeCurrency'])->name('currency');


//users
    Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('index');
    Route::get('/categories', [\App\Http\Controllers\MainController::class, 'categories'])->name('categories');
    Route::post('/subscription/{product}', [\App\Http\Controllers\MainController::class, 'subscription'])->name('subscription');
    Route::post('/basket/add/{product}', [\App\Http\Controllers\BasketController::class, 'basketAdd'])->name('basket-add');


    Route::middleware('basketNotEmpty')->group(function () {
        Route::get('/basket', [\App\Http\Controllers\BasketController::class, 'basket'])->name('basket');
        Route::get('/basket/place', [\App\Http\Controllers\BasketController::class, 'basketPlace'])->name('basket-place');
        Route::post('/basket/remove/{product}', [\App\Http\Controllers\BasketController::class, 'basketRemove'])->name('basket-remove');
        Route::post('/basket/place', [\App\Http\Controllers\BasketController::class, 'basketConfirm'])->name('basket-confirm');
    });


    Route::get('/{category}', [\App\Http\Controllers\MainController::class, 'category'])->name('category');
    Route::get('/{category}/{product?}', [\App\Http\Controllers\MainController::class, 'product'])->name('product');

});


