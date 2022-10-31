<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\HotelBooking;
use carbon\Carbon;

class BookingController extends Controller
{
    public function hotel(){
        if (isset($_GET['hotel']) && isset($_GET['room']))
            return view('customer.hotel.booking');
            else
            return redirect()->route('customer.index');
    }

    public function bookHotel(Request $request){

        $bookings = HotelBooking::where('user_id', auth()->user()->id)->get();

        foreach($bookings as $booking){
            if($booking->start_date == Carbon::parse($request->start_date)->toFormattedDateString()){
                return "You've already a have booking with the same date.";
            }
        }

        $start_date = Carbon::parse($request->start_date);
        $end_date   = Carbon::parse($request->end_date);

        if($start_date->isPast() || $end_date->isPast()){
            return "date selected is already in the past.";
        }





        HotelBooking::create(array_merge($this->validateBooking()));
        return redirect()->route('customer.bookings')->with('success', 'Successfully Booked!');

    }

    protected function validateBooking(?HotelBooking $hotelBooking = null): array
    {
        $hotelBooking ??= new HotelBooking();

        $validate = request()->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'hotel_id' => 'required',
            'room_id' => 'required',
            'user_id' => 'required',
        ]);

        return $validate;

    }
}
