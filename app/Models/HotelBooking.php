<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class HotelBooking extends Model
{
    use HasFactory;

    protected $guarded= [];

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
