<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TouristSpotBooking;
use App\Models\spotFeedback;
use App\Models\User;

class TouristSpot extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function bookings(){
        return $this->hasMany(TouristSpotBooking::class);
    }

    public function feedbacks(){
        return $this->hasMany(spotFeedback::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
