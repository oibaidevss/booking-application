<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Hotel;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('business-owner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('business-owner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if( $user->business_type == 'hotel' ){  
            Hotel::create(array_merge($this->validateHotel(), ['user_id' => $user->id]));
        }
            
        if( $user->business_type == 'restaurant' ){
            Restaurant::create(array_merge($this->validateRestaurant(), ['user_id' => $user->id]));
        }

        return redirect()->route('info.edit', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();

        if( $user->business_type == 'hotel' ){  
            $business = Hotel::where('user_id', $user->id)->with('rooms')->first();
            if($business != null){
                return view('business-owner.edit', [ 'business' => $business ]);
            }else{
                return redirect()->route('info.create');
            }
        }
        
        if( $user->business_type == 'restaurant' ){ 
            $business = Restaurant::where('user_id', $user->id)->with('tables')->first();
            if($business != null){
                return view('business-owner.edit', [ 'business' => $business ]);
            }else{
                return redirect()->route('info.create');
            }
            return view('business-owner.edit', [ 'business' => $business ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $user = auth()->user();

        if( $user->business_type == 'hotel' ){  
            $hotel = Hotel::where('user_id', $user->id)->first();
            $attributes = $this->validateHotel($hotel);
            $hotel->update($attributes);
        }

        if( $user->business_type == 'restaurant' ){  
            $restaurant = Restaurant::where('user_id', $user->id)->first();
            $attributes = $this->validateRestaurant($restaurant);
            $restaurant->update($attributes);
        }

        return back()->with('sucess', 'You have successfully updated your business.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function validateHotel(?Hotel $hotel = null): array
    {
        $hotel ??= new Hotel();

        return request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('hotels', 'email')->ignore($hotel)],
            'business_permit' => 'required',
            'number' => 'required',
            'description' => '',
            'location' => '',
        ]);
    }


    protected function validateRestaurant(?Restaurant $restaurant = null): array
    {
        $restaurant ??= new Restaurant();

        return request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('restaurants', 'email')->ignore($restaurant)],
            'business_permit' => 'required',
            'number' => 'required',
            'description' => '',
            'location' => '',
        ]);
    }
}
