<?php

use App\Http\Controllers\Admin\Category\HotelController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VnpayController;
use Illuminate\Support\Facades\Route;


Route::get('hotel.html', [HotelController::class, 'list'])->name('hotel.list');

Route::prefix('hotel')->group(function(){
    Route::controller(HotelController::class)->group(function(){
        Route::get('{slug}/{id}', 'show')->name('hotel.details');
    });
});

Route::prefix('booking')->group(function(){
    Route::controller(CheckoutController::class)->group(function(){
        Route::post('add', 'add')->name('hotel.booking.add');
        Route::get('checkout', 'checkout')->name('hotel.booking.checkout');
        Route::post('checkout/crash-delivery', 'crashDelivery')->name('hotel.booking.crash.delivery');
        Route::get('success', 'success')->name('hotel.booking.success');
    });

    Route::get('payment/vnpay/return', [VnpayController::class,'return'])->name('hotel.booking.vnpay.return');

    Route::controller(VnpayController::class)->group(function(){
        Route::get('checkout/vnpay', 'create')->name('hotel.booking.vnpay');
    });
});

