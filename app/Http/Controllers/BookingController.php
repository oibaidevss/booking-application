<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\HotelBooking;

class BookingController extends Controller
{
    public function hotel(){
        if (isset($_GET['hotel']) && isset($_GET['room']))
            return view('customer.hotel.booking');
            else
            return redirect()->route('customer.index');
    }

    public function createHotelBooking(Request $request){
        HotelBooking::create(array_merge($this->validateBooking()));
        return back()->with('success', 'Successfully Booked!');
    }

    protected function validateBooking(?HotelBooking $hotelBooking = null): array
    {
        $hotelBooking ??= new HotelBooking();

        return request()->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'hotel_id' => 'required',
            'room_id' => 'required',
            'user_id' => 'required',
        ]);
    }
}
