<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BusinessRestaurantController;
use App\Http\Controllers\BusinessHotelController;
use App\Http\Controllers\TouristSpotController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FrontEndController;

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

Route::get('/', [FrontEndController::class, 'index']);
Route::get('/about', function () {
    return view('front-end.about');
});

Route::get('/dashboard', function () {
    if(auth()->user()->hasRole('customer')){
        return redirect()->route('customer.index');
    }

    if(auth()->user()->hasRole('business owner')){
        return redirect()->route('info.index');
    }

    if(auth()->user()->hasRole('admin')){
        return redirect()->route('admin.index');
    }
})->middleware(['auth', 'verified'])->name('dashboard');




Route::prefix('customer')->middleware(['auth', 'verified', 'role:customer'])->group(function () {
    
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
   
    Route::get('/hotels', [CustomerController::class, 'hotel'])->name('customer.hotels');
    Route::get('/hotels/{hotel}', [CustomerController::class, 'showHotel'])->name('customer.hotel.show');
    
    Route::get('/restaurants', [CustomerController::class, 'restaurant'])->name('customer.restaurants');
    Route::get('/restaurants/{restaurant}', [CustomerController::class, 'showRestaurant'])->name('customer.restaurant.show');

    Route::get('/spots', [CustomerController::class, 'spot'])->name('customer.spots');
    Route::get('/spots/{spot}', [CustomerController::class, 'showSpot'])->name('customer.spot.show');
    
    Route::get('/hotel/booking', [BookingController::class, 'hotel'])->name('customer.hotel.booking');
    Route::post('/hotel/booking', [BookingController::class, 'bookHotel'])->name('customer.hotel.booking.store');
    Route::post('/hotel/feedback', [FeedbackController::class, 'createHotelFeedback'])->name('customer.hotel.feedback.store');
    
    Route::get('/restaurant/booking', [BookingController::class, 'restaurant'])->name('customer.restaurant.booking');
    Route::post('/restaurant/booking', [BookingController::class, 'bookRestaurant'])->name('customer.restaurant.booking.store');
    Route::post('/restaurant/feedback', [FeedbackController::class, 'createRestaurantFeedback'])->name('customer.restaurant.feedback.store');

    Route::get('/spot/booking/{touristSpot}', [BookingController::class, 'spot'])->name('customer.spot.booking');
    Route::post('/spot/booking', [BookingController::class, 'bookSpot'])->name('customer.spot.booking.store');
    Route::post('/spot/feedback', [FeedbackController::class, 'createTouristSpotFeedback'])->name('customer.spot.feedback.store');

    Route::get('/bookings', [CustomerController::class, 'myBookings'])->name('customer.bookings');
    Route::match(['put', 'patch'], '/bookings/hotel/cancel/{booking}', [CustomerController::class, 'cancelHotelBooking'])->name('customer.hotel.bookings.cancel');
    Route::match(['put', 'patch'], '/bookings/restaurant/cancel/{booking}', [CustomerController::class, 'cancelRestaurantBooking'])->name('customer.restaurant.bookings.cancel');
    Route::match(['put', 'patch'], '/bookings/spot/cancel/{booking}', [CustomerController::class, 'cancelTouristSpotBooking'])->name('customer.spot.bookings.cancel');

});

Route::prefix('business')->middleware(['auth', 'verified', 'role:business owner'])->group(function () {
    
    Route::resource('info', BusinessController::class);
    Route::resource('room', BusinessHotelController::class);
    Route::resource('table', BusinessRestaurantController::class);
    
    Route::get('bookings', function(){
        $check = 0;
        if(auth()->user()->business_type == "hotel"){
            $check = \App\Models\Hotel::where('user_id', auth()->user()->id)->first();
            if($check === null) return redirect()->route('info.create');
            $bookings = \App\Models\HotelBooking::where('hotel_id', $check->id)->get();
        }
        
        if(auth()->user()->business_type == "restaurant"){
            $check = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
            if($check === null) return redirect()->route('info.create');
            $bookings = \App\Models\RestaurantBooking::where('restaurant_id', $check->id)->get();
        }
        
        if(auth()->user()->business_type == "tourist_spot"){
            $check = \App\Models\TouristSpot::where('user_id', auth()->user()->id)->first();
            if($check === null) return redirect()->route('info.create');
            $bookings = \App\Models\TouristSpotBooking::where('tourist_spot_id', $check->id)->get();
        }

        return view('business-owner.bookings', [ 'bookings' => $bookings ]);
    })->name('business.bookings');

    Route::match(['put', 'patch'], '/bookings/approved/{booking}', function($booking){
        if(auth()->user()->business_type == "hotel"){
            $booking = App\Models\HotelBooking::find($booking);
        }

        if(auth()->user()->business_type == "restaurant"){
            $booking = App\Models\RestaurantBooking::find($booking);
        }

        $booking->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Your booking was successfully canceled');
        
    })->name('business.bookings.approved');

    Route::get('hotels/bookings/export/{created_at}',[HotelController::class, 'export_hotel_bookings'])->name('hotel.export');
    Route::get('restaurants/bookings/export/{created_at}',[RestaurantController::class, 'export_restaurant_bookings'])->name('restaurant.export');
    Route::get('spots/bookings/export/{created_at}',[TouristSpotController::class, 'export_spot_bookings'])->name('spot.export');

});


Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    
    Route::get('/',  function () {
        return view('admin.index');
    })->name('admin.index');

    Route::resource('users', UserController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('spots', TouristSpotController::class);

    Route::get('hotel-archives', [HotelController::class, 'archives'])->name('hotels.archives');
    Route::match(['put', 'patch'], 'hotel-archives/archive/{hotel}', [HotelController::class, 'archive'])->name('hotels.archives.archive');
    Route::match(['put', 'patch'], 'hotel-archives/restore/{hotel}', [HotelController::class, 'restore'])->name('hotels.archives.restore');

    Route::get('restaurant-archives', [RestaurantController::class, 'archives'])->name('restaurants.archives');
    Route::match(['put', 'patch'], 'restaurant-archives/archive/{restaurant}', [RestaurantController::class, 'archive'])->name('restaurants.archives.archive');
    Route::match(['put', 'patch'], 'restaurant-archives/restore/{restaurant}', [RestaurantController::class, 'restore'])->name('restaurants.archives.restore');
    
    Route::get('spot-archives', [TouristSpotController::class, 'archives'])->name('spots.archives');
    Route::match(['put', 'patch'], 'spot-archives/archive/{TouristSpot}', [TouristSpotController::class, 'archive'])->name('spots.archives.archive');
    Route::match(['put', 'patch'], 'spot-archives/restore/{TouristSpot}', [TouristSpotController::class, 'restore'])->name('spots.archives.restore');
    
    Route::match(['put', 'patch'], 'hotels/verify/{business}', [HotelController::class, 'verify'])->name('hotels.verify');
    Route::match(['put', 'patch'], 'restaurants/verify/{business}', [RestaurantController::class, 'verify'])->name('restaurants.verify');
    Route::match(['put', 'patch'], 'spots/verify/{business}', [TouristSpotController::class, 'verify'])->name('spots.verify');

    Route::get('hotels/rooms/create', [RoomController::class, 'create'])->name('rooms.create');

    Route::get('hotels/bookings/export/{created_at}',[HotelController::class, 'export_hotel_bookings'])->name('hotel.booking.export');
    Route::get('restaurants/bookings/export/{created_at}',[RestaurantController::class, 'export_restaurant_bookings'])->name('restaurant.booking.export');
    Route::get('spots/bookings/export/{created_at}',[TouristSpotController::class, 'export_spot_bookings'])->name('spot.booking.export');
});







require __DIR__.'/auth.php';
