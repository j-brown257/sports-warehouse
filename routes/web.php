<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/search', [SearchController::class, 'index'])->name('search');   
Route::get('/items/{slug}', [ItemController::class, 'show'])->name('items.show');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{itemId}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order/{id}/confirmation', [CheckoutController::class, 'confirmation'])->name('order.confirmation');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/account/password', [AuthController::class, 'showChangePassword'])->name('account.password');
    Route::put('/account/password', [AuthController::class, 'updatePassword'])->name('account.password.update');
});

Route::resource("admin/categories", AdminCategoryController::class)
    ->middleware("auth")
    ->names("admin.categories");

Route::resource("admin/items", AdminItemController::class)
    ->middleware("auth")
    ->names("admin.items");
