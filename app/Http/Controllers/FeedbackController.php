<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelFeedback;
use App\Models\RestaurantFeedback;
use App\Models\SpotFeedback;

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

    public function createRestaurantFeedback(Request $request){
        $feedback = new RestaurantFeedback;

        $feedback->user_id = $request->user_id;
        $feedback->restaurant_id = $request->restaurant_id;
        $feedback->feedback = $request->feedback;

        $feedback->save();

        return redirect()->route('customer.restaurant.show', $request->restaurant_id)->with('success', "You've successfully added a feedback.");
    }

    public function createTouristSpotFeedback(Request $request){
        $feedback = new SpotFeedback;

        $feedback->user_id = $request->user_id;
        $feedback->tourist_spot_id = $request->tourist_spot_id;
        $feedback->feedback = $request->feedback;

        $feedback->save();

        return redirect()->route('customer.spot.show', $request->tourist_spot_id)->with('success', "You've successfully added a feedback.");
    }
}
