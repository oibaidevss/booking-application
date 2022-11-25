<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantFeedback extends Model
{
    use HasFactory; 
    protected $guarded= [];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
