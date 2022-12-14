<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use carbon\Carbon;

class HotelBooking extends Model
{
    use HasFactory;

    protected $guarded= [];

    protected $dates = [
        'start_date', 
        'end_date'
    ];

    public function getStartDateAttribute($value){
        return Carbon::parse($value)->toDayDateTimeString();
    }

    public function getEndDateAttribute($value){
        return Carbon::parse($value)->toDayDateTimeString();
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
