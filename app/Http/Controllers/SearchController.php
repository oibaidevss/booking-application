<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\TouristSpot;


class SearchController extends Controller
{

    public function search(Request $request){
  

        $hotels = Hotel::where([
            ['status', 1],
            ['name', '!=', null],
            [function ($query) use ($request){
                if ( ($term = $request->term) ){
                    $query->orWhere('name', 'LIKE', '%' .$term. '%')->get();
                }
            }]
        ])->orderBy('id', 'desc')
        ->paginate(4);

        $restaurants = Restaurant::where([
            ['status', 1],
            ['name', '!=', null],
            [function ($query) use ($request){
                if ( ($term = $request->term) ){
                    $query->orWhere('name', 'LIKE', '%' .$term. '%')->get();
                }
            }]
        ])->orderBy('id', 'desc')
        ->paginate(4);

        $spots = TouristSpot::where([
            ['name', '!=', null],
            ['status', 1],
            [function ($query) use ($request){
                if ( ($term = $request->term) ){
                    $query->orWhere('name', 'LIKE', '%' .$term. '%')->get();
                }
            }]
        ])->orderBy('id', 'desc')
        ->paginate(4);
        

        return view('customer.search', [
            'hotels' => $hotels,
            'restaurants' => $restaurants,
            'spots' => $spots,
        ]);
    }

    
}
