<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('customer_order');
});

Route::middleware('auth')->group(function() {
    Route::get('/employee', \App\Livewire\Employee\Home::class)->name('employee');
    Route::get('/employee/profile', \App\Livewire\Auth\Profile::class)->name('employee_profile');
    Route::get('/employee/{order}/bill', \App\Livewire\Employee\Order\Bill::class)->name('employee_bill');

    Route::get('/employee/order/create', \App\Livewire\Order\Actions::class)->name('order_create');
});

Route::middleware('guest')->group(function() {
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
});

Route::get('/order', \App\Livewire\Customer\Order::class)->name('customer_order');
Route::get('/order/checkout', \App\Livewire\Customer\Checkout::class)->name('checkout');
Route::get('/order/checkout/payment', \App\Livewire\Customer\PaymentSuccess::class) -> name('payment');
Route::get('/generate', function() {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
});


