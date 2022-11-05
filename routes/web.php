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
use App\Http\Controllers\UserController;

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
    return view('front-end.welcome');
});
Route::get('/about', function () {
    return view('front-end.about');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    if(auth()->user()->hasRole('customer')){
        return redirect()->route('customer.index');
    }

    if(auth()->user()->hasRole('business owner')){
        return redirect()->route('info.index');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('customer')->middleware(['auth', 'verified', 'role:customer'])->group(function () {
    
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/restaurants', [CustomerController::class, 'restaurant'])->name('customer.restaurants');
    Route::get('/hotels', [CustomerController::class, 'hotel'])->name('customer.hotels');
    Route::get('/hotels/{hotel}', [CustomerController::class, 'showHotel'])->name('customer.hotel.show');
    Route::get('/restaurants/{restaurant}', [CustomerController::class, 'showRestaurant'])->name('customer.restaurant.show');
    Route::get('/hotel/booking', [BookingController::class, 'hotel'])->name('customer.hotel.booking');
    Route::post('/hotel/booking', [BookingController::class, 'bookHotel'])->name('customer.hotel.booking.store');
    
    Route::get('/bookings', [CustomerController::class, 'myBookings'])->name('customer.bookings');
    Route::match(['put', 'patch'], '/bookings/cancel/{booking}', [CustomerController::class, 'cancelBooking'])->name('customer.bookings.cancel');
});

Route::prefix('business')->middleware(['auth', 'verified', 'role:business owner'])->group(function () {
    
    Route::resource('info', BusinessController::class);
    Route::resource('room', BusinessHotelController::class);
    Route::resource('table', BusinessRestaurantController::class);
    
    Route::get('bookings', function(){
        $hotel = \App\Models\Hotel::where('user_id', auth()->user()->id)->first();
        $bookings = \App\Models\HotelBooking::where('hotel_id', $hotel->id)->get();

        return view('business-owner.bookings', [ 'bookings' => $bookings ]);
    })->name('business.bookings');

    Route::match(['put', 'patch'], '/bookings/approved/{booking}', function($booking){
        
        $booking = App\Models\HotelBooking::find($booking);

        $booking->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Your booking was successfully canceled');
        
    })->name('business.bookings.approved');

});


Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    
    Route::get('/',  function () {
        return view('admin.index');
    })->name('admin.index');

    Route::resource('users', UserController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('restaurants', RestaurantController::class);
    
    Route::match(['put', 'patch'], 'hotels/{business}', [HotelController::class, 'verify'])->name('hotels.verify');
    Route::get('hotels/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
});







require __DIR__.'/auth.php';
