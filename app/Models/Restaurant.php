<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Table;

class Restaurant extends Model
{
    use HasFactory;
    
    protected $guarded= [];


    public function tables(){
        return $this->hasMany(Table::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
