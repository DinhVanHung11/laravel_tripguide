<?php

use App\Http\Controllers\Admin\Attribute\AttributeController;
use App\Http\Controllers\Admin\Attribute\ExtraServiceController;
use App\Http\Controllers\Admin\Attribute\TagController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\Category\HotelController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\Store\ConfigurationController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController as ControllersUserController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('services')->group(function(){
    Route::prefix('upload')->controller(UploadController::class)->group(function(){
        Route::post('store','store');
        Route::post('delete','delete');
    });

    Route::prefix('search')->group(function(){
        Route::prefix('location')->controller(CountryController::class)->group(function(){
            Route::get('get','searchAjax')->name('search.location.get');
        });
    });
});

Route::middleware(['auth:web', 'verified'])->prefix('account')->group(function(){
    Route::prefix('')->controller(ControllersUserController::class)->group(function(){
        Route::get('me', 'index')->name('user.account.me');
        Route::post('update/{user}', 'update')->name('user.account.update');
    });

    Route::prefix('booking')->controller(BookingController::class)->group(function(){
        Route::get('index', 'index')->name('user.booking.index');
    });
});

//Soical Login
Route::get('social/auth/redirect', [SocialAuthController::class, 'redirect'])->name('social.auth.redirect');

Route::get('social/auth/callback', [SocialAuthController::class, 'callback'])->name('social.auth.callback');

require __DIR__.'/hotel_route.php';
require __DIR__.'/auth.php';

Route::middleware(['auth:admin', 'verified'])->prefix('admin')->group(function(){
    Route::get('/', function(){
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', [AdminMainController::class,'index'])->name('admin.dashboard');

    Route::prefix('users')->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::get('manage', 'index')->name('admin.users');
            Route::get('now/online', 'online')->name('admin.users.online');
        });
    });

    Route::prefix('categories')->controller(CategoryController::class)->group(function(){
        Route::get('manage/index', 'index')->name('admin.category.index');
        Route::get('add', 'create')->name('admin.category.create');
        Route::post('add', 'store')->name('admin.category.store');
        Route::get('edit/{category}', 'edit')->name('admin.category.edit');
        Route::post('update/{category}', 'update')->name('admin.category.update');
        Route::delete('delete', 'destroy')->name('admin.category.delete');
    });

    Route::prefix('countries')->controller(CountryController::class)->group(function(){
        Route::get('/', 'index')->name('admin.countries');
        Route::post('add', 'store')->name('admin.countries.add');
        Route::get('cities', 'cities')->name('admin.countries.cities');
        Route::get('services/searchAjax/get', 'searchAjax');
    });

    Route::prefix('hotel')->group(function(){
        Route::controller(HotelController::class)->group(function(){
            Route::get('index', 'index')->name('admin.hotel.index');
            Route::get('add', 'create')->name('admin.hotel.create');
            Route::post('add', 'store')->name('admin.hotel.store');
            Route::get('edit/{hotel}', 'edit')->name('admin.hotel.edit');
            Route::post('update/{hotel}', 'update')->name('admin.hotel.update');
            Route::post('advance/price', 'advancePrice')->name('admin.hotel.advance.prices');
        });

        Route::prefix('tours')->controller(TourController::class)->group(function(){
            Route::get('index', 'index')->name('admin.hotel.tours.index');
            Route::get('add', 'create')->name('admin.hotel.tours.create');
            Route::post('add', 'store')->name('admin.hotel.tours.store');
            Route::get('edit/{tour}', 'edit')->name('admin.hotel.tours.edit');
            Route::post('update/{tour}', 'update')->name('admin.hotel.tours.update');
            Route::delete('delete', 'destroy')->name('admin.hotel.tours.delete');
        });

        Route::prefix('tags')->controller(TagController::class)->group(function(){
            Route::get('index', 'index')->name('admin.hotel.tags.index');
            Route::get('add', 'create')->name('admin.hotel.tags.add');
            Route::post('add', 'store')->name('admin.hotel.tags.store');
            Route::get('edit/{tag}', 'edit')->name('admin.hotel.tags.edit');
            Route::post('update/{tag}', 'update')->name('admin.hotel.tags.update');
            Route::delete('delete', 'destroy')->name('admin.hotel.tags.delete');
        });

        Route::prefix('extra-features')->controller(ExtraServiceController::class)->group(function(){
            Route::get('index', 'index')->name('admin.hotel.extrafeatures.index');
            Route::get('add', 'create')->name('admin.hotel.extrafeatures.add');
            Route::post('add', 'store')->name('admin.hotel.extrafeatures.store');
            Route::get('edit/{extraService}', 'edit')->name('admin.hotel.extrafeatures.edit');
            Route::post('update/{extraService}', 'update')->name('admin.hotel.extrafeatures.update');
            Route::delete('delete', 'destroy')->name('admin.hotel.extrafeatures.delete');
        });

        Route::prefix('bookings')->controller(AdminBookingController::class)->group(function(){
            Route::get('index','index')->name('admin.hotel.bookings');
        });
    });


    Route::prefix('upload/services')->controller(UploadController::class)->group(function(){
        Route::post('store','store');
        Route::post('delete','delete');
    });

    Route::prefix('store')->group(function(){
        Route::controller(ConfigurationController::class)->group(function(){
            Route::get('configuration', 'index')->name('admin.store.configuration');
            Route::post('configuration', 'store')->name('admin.store.configuration.store');
        });

        Route::prefix('attributes')->controller(AttributeController::class)->group(function(){
            Route::get('', 'index')->name('admin.store.attribute');
            Route::get('add', 'create')->name('admin.store.attribute.create');
            Route::post('add', 'store')->name('admin.store.attribute.store');
            Route::get('edit/{attribute}', 'edit')->name('admin.store.attribute.edit');
            Route::post('update/{attribute}', 'update')->name('admin.store.attribute.update');
            Route::delete('delete', 'destroy')->name('admin.store.attribute.delete');
        });
    });
});

require __DIR__.'/adminauth.php';

// UPDATE hotels SET image = "https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?q=80&w=1949&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" WHERE id BETWEEN 91 and 100;
