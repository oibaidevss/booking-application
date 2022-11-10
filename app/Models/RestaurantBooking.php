<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\User;
use carbon\Carbon;

class RestaurantBooking extends Model
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

    public function table(){
        return $this->belongsTo(Table::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
