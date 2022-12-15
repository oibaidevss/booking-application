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

        $hotels = Hotel::with('rooms')->where('status', 1)->get();
        $collection = new Collection($hotels);
        $hotel = $collection->sortBy('min_price')->first();

        $restaurants = Restaurant::with('tables')->where('status', 1)->get();
        $collection = new Collection($restaurants);
        $restaurant = $collection->sortBy('min_price')->first();

        $touristSpots = TouristSpot::where('status', 1)->get();
        $collection = new Collection($touristSpots);
        $touristSpot = $collection->sortBy('price')->first();

        return view('front-end.welcome', 
            [
                'hotel' => $hotel,
                'restaurant' => $restaurant,
                'touristSpot' => $touristSpot,
            ]
        );
    }
}
