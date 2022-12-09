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
use App\Models\HotelFeedback;
use App\Models\RestaurantFeedback;
use App\Models\SpotFeedback;



class CustomerController extends Controller
{
    public function index(){
        return view('customer.index', [

            'hotels' => Hotel::with('rooms')->get(),
            'restaurants' => Restaurant::with('tables')->get(),

        ]);
    }

    public function hotel() {

        if(isset($_GET['sort']) ) {
            if( $_GET['sort'] == 'min' ){
                $hotels = Hotel::with('rooms')->where('status', 1)->orderBy('min_price', 'asc')->paginate(8)->withQueryString();
            }  elseif ( $_GET['sort'] == 'max' ){
                $hotels = Hotel::with('rooms')->where('status', 1)->orderBy('max_price', 'desc')->paginate(8)->withQueryString();
            } else{
                $hotels = Hotel::with('rooms')->where('status', 1)->paginate(8)->withQueryString();
            }
        } else{
            $hotels = Hotel::with('rooms')->where('status', 1)->paginate(8)->withQueryString();
        }

        return view('customer.hotel', [
            'hotels' => $hotels,
        ]);


    }

    public function showHotel(Hotel $hotel){

        $feedbacks = HotelFeedback::where('hotel_id', $hotel->id)->with('user')->paginate(10);

        return view('customer.hotel.show', [
            'hotel' => $hotel,
            'feedbacks' => $feedbacks
        ]);

    }

    public function spot() {
        return view('customer.spot', [
            'spots' => TouristSpot::where('status', 1)->paginate(8)->withQueryString(),
        ]);
    }

    public function showSpot($id){

        $feedbacks = SpotFeedback::where('tourist_spot_id', $id)->with('user')->paginate(10);
        
        return view('customer.tourist-spot.show', [
            'spot' => TouristSpot::find($id),
            'feedbacks' => $feedbacks
        ]);
    }

    public function restaurant() {
        return view('customer.restaurant', [
            'restaurants' => Restaurant::with('tables')->where('status', 1)->paginate(8)->withQueryString()
        ]);
    }

    public function showRestaurant(Restaurant $restaurant){
        $feedbacks = RestaurantFeedback::where('restaurant_id', $restaurant->id)->with('user')->paginate(10);

        return view('customer.restaurant.show', [
            'restaurant' => $restaurant,
            'feedbacks' => $feedbacks
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
