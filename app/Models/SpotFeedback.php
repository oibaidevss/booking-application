<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TouristSpot;
use App\Models\User;

class SpotFeedback extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function touristSpots(){
        return $this->belongsTo(TouristSpot::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
