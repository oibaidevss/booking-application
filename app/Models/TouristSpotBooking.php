<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TouristSpot;
use App\Models\User;
use carbon\Carbon;

class TouristSpotBooking extends Model
{
    use HasFactory;
    protected $guarded= [];

    protected $dates = [
        'booking_date'
    ];

    public function getBookingDateAttribute($value){
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function touristSpot(){
        return $this->belongsTo(TouristSpot::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
