<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\RestrictToAdmin;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminDashboardController;
Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware(RestrictToAdmin::class);
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');    
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');  
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/home',[HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware(['auth', 'restrictToAdmin']);Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase/{cartItem}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{cartItem}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/order/confirmation/{order}', [CartController::class, 'confirmation'])->name('order.confirmation');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/aboutus', function () { return view('aboutus'); })->name('aboutus');
Route::get('/contactus',function() {return view ('contactus');})->name('contactus');
Route::post('/contactus', [ContactController::class, 'store'])->name('contactus.store');   
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware(['auth', 'restrictToAdmin']);
Route::patch('/orders/{order}', [CartController::class, 'updateStatus'])->name('orders.update');
Route::post('/home/dashboard',[AdminDashboardController::class,'dashboard']);
