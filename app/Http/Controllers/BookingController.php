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

        $allBookings = HotelBooking::where([
            'hotel_id' => $request->hotel_id, 
            'room_id' => $request->room_id
        ])->get();
        
        
        
        foreach($allBookings as $booking){
            if($booking->start_date === Carbon::parse($request->start_date)->toFormattedDateString()){
                return back()->with("error", "Somebody has already book this room on $request->start_date. Please choose another date.");
            }
        }


        $bookings = HotelBooking::where('user_id', auth()->user()->id)->get();

        foreach($bookings as $booking){
            
            if($booking->start_date == Carbon::parse($request->start_date)->toFormattedDateString() && $booking->status != 'canceled'){
                return back()->with("error", "You've already added a booking with the same date.");
            }
        }

        $start_date = Carbon::parse($request->start_date);
        $end_date   = Carbon::parse($request->end_date);

        if($start_date->isPast() || $end_date->isPast()){
            return back()->with("error", "Date selected is already in the past.");
        }

        HotelBooking::create(array_merge($this->validateBooking()));
        return redirect()->route('customer.bookings')->with('success', "You're booking will be cancelled in the next 24 hours if you are not able to pay within these hours ");

    }

    protected function validateBooking(?HotelBooking $hotelBooking = null): array
    {
        $hotelBooking ??= new HotelBooking();

        $validate = request()->validate([
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'hotel_id' => 'required',
            'room_id' => 'required',
            'user_id' => 'required',
        ]);

        return $validate;

    }
}
