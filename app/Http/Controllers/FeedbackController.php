<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelFeedback;

class FeedbackController extends Controller
{
    public function createHotelFeedback(Request $request){
        $feedback = new HotelFeedback;

        $feedback->user_id = $request->user_id;
        $feedback->hotel_id = $request->hotel_id;
        $feedback->feedback = $request->feedback;
        
        $feedback->save();

        return redirect()->route('customer.hotel.show', $request->hotel_id)->with('success', "You've successfully added a feedback.");
    }
}
