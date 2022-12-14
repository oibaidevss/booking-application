<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RestaurantFeedback;
use App\Models\RestaurantBooking;
use App\Models\Table;

class Restaurant extends Model
{
    use HasFactory;
    
    protected $guarded= [];


    public function tables(){
        return $this->hasMany(Table::class);
    }

    public function bookings(){
        return $this->hasMany(RestaurantBooking::class);
    }

    public function feedbacks(){
        return $this->hasMany(RestaurantFeedback::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
