<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\TouristSpot;

use Illuminate\Support\Collection;


class FrontEndController extends Controller
{
    function index(){

        $hotels = Hotel::where('status', 1)->get();
        $collection = new Collection($hotels);
        $d_hotel = $collection->min('min_price');

        $restaurants = Restaurant::with('tables')->where('status', 1)->get();
        $collection = new Collection($restaurants);
        $d_restaurant = $collection->min('min_price');

        $touristSpots = TouristSpot::where('status', 1)->get();
        $collection = new Collection($touristSpots);
        $d_touristSpot = $collection->min('price');

        
        $get_hotel = Hotel::where('min_price', $d_hotel)->first(); 
        $get_restaurant = Restaurant::where('min_price', $d_restaurant)->first(); 
        $get_tourist_spot = TouristSpot::where('price', $d_touristSpot)->first(); 

        return view('front-end.welcome', 
            [
                'get_hotel' => $get_hotel,
                'get_restaurant' => $get_restaurant,
                'get_touristSpot' => $get_tourist_spot,
            ]
        );
    }
}
