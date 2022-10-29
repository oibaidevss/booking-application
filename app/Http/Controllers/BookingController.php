<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function hotel(){
        return view('customer.hotel.booking');
    }
}
