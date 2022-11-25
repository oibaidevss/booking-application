<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class RestaurantFeedback extends Model
{
    use HasFactory; 
    protected $guarded= [];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
