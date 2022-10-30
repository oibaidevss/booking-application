<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Restaurant;



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
            'hotels' => Hotel::with('rooms')->where('status', 1)->get(),
        ]);
    }

    public function showHotel(Hotel $hotel){
        $hotel = $hotel->with('rooms')->first();
        return view('customer.hotel.show', [
            'hotel' => $hotel
        ]);
    }

    public function restaurant() {
        return view('customer.restaurant', [
            'restaurants' => Restaurant::with('tables')->where('status', 1)->get()
        ]);
    }
    

}
