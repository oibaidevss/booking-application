<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TouristSpotBooking;
use App\Models\RestaurantBooking;
use App\Models\HotelBooking;
use App\Models\TouristSpot;
use App\Models\Restaurant;
use App\Models\Hotel;
use App\Models\User;



class CustomerController extends Controller
{
    public function index(){
        return view('customer.index', [

            'hotels' => Hotel::with('rooms')->get(),
            'restaurants' => Restaurant::with('tables')->get(),

        ]);
    }

    public function hotel() {
        return view('customer.hotel', [
            'hotels' => Hotel::with('rooms')->where('status', 1)->paginate(8)->withQueryString(),
        ]);
    }

    public function showHotel(Hotel $hotel){
        return view('customer.hotel.show', [
            'hotel' => $hotel
        ]);
    }

    public function spot() {
        return view('customer.spot', [
            'spots' => TouristSpot::where('status', 1)->paginate(8)->withQueryString(),
        ]);
    }

    public function showSpot($id){
        return view('customer.tourist-spot.show', [
            'spot' => TouristSpot::find($id)
        ]);
    }

    public function restaurant() {
        return view('customer.restaurant', [
            'restaurants' => Restaurant::with('tables')->where('status', 1)->paginate(8)->withQueryString()
        ]);
    }

    public function showRestaurant(Restaurant $restaurant){
        return view('customer.restaurant.show', [
            'restaurant' => $restaurant
        ]);
    }

    function myBookings(){

        $user = User::with(['hotelBookings', 'restaurantBookings', 'touristSpotBookings'])->where('id', auth()->user()->id)->first();

        return view('customer.bookings', ['user' => $user]);

    }

    function cancelHotelBooking($id) {
        $booking = HotelBooking::find($id);

        $booking->update([
            'status' => 'canceled'
        ]);

        return back()->with('success', 'Your booking was successfully canceled');
    }

    function cancelRestaurantBooking($id) {
        $booking = RestaurantBooking::find($id);

        $booking->update([
            'status' => 'canceled'
        ]);

        return back()->with('success', 'Your booking was successfully canceled');
    }

    function cancelTouristSpotBooking($id) {
        $booking = TouristSpotBooking::find($id);

        $booking->update([
            'status' => 'canceled'
        ]);

        return back()->with('success', 'Your booking was successfully canceled');
    }
    

}
