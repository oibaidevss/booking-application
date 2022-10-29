<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BusinessRestaurantController;
use App\Http\Controllers\BusinessHotelController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('customer')->group(function () {
    
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/restaurants', [CustomerController::class, 'restaurant'])->name('customer.restaurants');
    Route::get('/hotels', [CustomerController::class, 'hotel'])->name('customer.hotels');
    Route::get('/hotels/{hotel}', [CustomerController::class, 'showHotel'])->name('customer.hotel.show');
    Route::get('/booking', [BookingController::class, 'hotel'])->name('customer.hotel.booking');
    Route::get('/restaurants/{restaurant}', [CustomerController::class, 'showRestaurant'])->name('customer.restaurant.show');

});


Route::prefix('business')->middleware(['auth', 'role:business owner'])->group(function () {
    
    Route::resource('info', BusinessController::class);
    Route::resource('room', BusinessHotelController::class);
    Route::resource('table', BusinessRestaurantController::class);
  
});


Route::prefix('admin')->middleware(['role:admin'])->group(function () {
    
    Route::get('/',  function () {
        return view('dashboard');
    })->name('admin.index');

    Route::resource('hotels', HotelController::class);
    Route::get('hotels/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::resource('restaurants', RestaurantController::class);
});







require __DIR__.'/auth.php';
