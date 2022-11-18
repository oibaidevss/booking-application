<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\ResetaurantBooking;
use App\Models\TouristSpotBooking;
use Laravel\Sanctum\HasApiTokens;
use App\Models\HotelBooking;
use App\Models\TouristSpot;
use App\Models\Restaurant;
use App\Models\Hotel;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function hotel() {
        return $this->hasOne(Hotel::class);
    }

    public function restaurant() {
        return $this->hasOne(Restaurant::class);
    }

    public function touristspot() {
        return $this->hasOne(TouristSpot::class);
    }

    public function hotelBookings() {
        return $this->hasMany(HotelBooking::class);
    }

    public function restaurantBookings() {
        return $this->hasMany(RestaurantBooking::class);
    }

    public function touristSpotBookings() {
        return $this->hasMany(TouristSpotBooking::class);
    }
}
