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
        'booking_date',
        'dine_in_time',
        'dine_out_time',
    ];

    public function getBookingDateAttribute($value){
        return Carbon::parse($value)->toFormattedDateString();
    }
    public function getDineInTimeAttribute($value){
        return Carbon::parse($value)->toTimeString();
    }
    public function getDineOutTimeAttribute($value){
        return Carbon::parse($value)->toTimeString();
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
