<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Hotel;
use App\Models\HotelBooking;

class Room extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function hotel(){
        return $this->belongsTo(Hotel::classs);
    }

    public function bookings(){
        return $this->hasMany(HotelBooking::class);
    }
}
