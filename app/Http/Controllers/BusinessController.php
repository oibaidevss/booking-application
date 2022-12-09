<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\HotelBooking;
use App\Models\Restaurant;
use App\Models\TouristSpot;
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
           $hotel =  Hotel::create(array_merge($this->validateHotel(), ['user_id' => $user->id]));
           if($request->hasFile('picture')){
                $picture = $request->picture->getClientOriginalName();
                $request->picture->storeAs('pictures', $picture, 'public');
                $hotel->update(['picture'=>$picture]);
           }

           if($request->hasFile('business_permit')){
                $permit = $request->business_permit->getClientOriginalName();
                $ext = $request->business_permit->getClientOriginalExtension();
                $business_permit = $hotel->id . "_business_permit." . $ext;
                $request->business_permit->storeAs("permits/$user->business_type/$hotel->id", $business_permit, 'public');
                $hotel->update(['business_permit'=>$business_permit]);
            }
        }
            
        if( $user->business_type == 'restaurant' ){
            $restaurant =  Restaurant::create(array_merge($this->validateRestaurant(), ['user_id' => $user->id]));
            if($request->hasFile('picture')){
                $picture = $request->picture->getClientOriginalName();
                $request->picture->storeAs('pictures', $picture, 'public');
                $restaurant->update(['picture'=>$picture]);
           }

           if($request->hasFile('business_permit')){
                $permit = $request->business_permit->getClientOriginalName();
                $ext = $request->business_permit->getClientOriginalExtension();
                $business_permit = $restaurant->id . "_business_permit." . $ext;
                $request->business_permit->storeAs("permits/$user->business_type/$restaurant->id", $business_permit, 'public');
                $restaurant->update(['business_permit'=>$business_permit]);
            }
        }
            
        if( $user->business_type == 'tourist_spot' ){
            $spot =  TouristSpot::create(array_merge($this->validateTouristSpot(), ['user_id' => $user->id]));
            if($request->hasFile('picture')){
                $picture = $request->picture->getClientOriginalName();
                $request->picture->storeAs('pictures', $picture, 'public');
                $spot->update(['picture'=>$picture]);
           }

           if($request->hasFile('business_permit')){
                $permit = $request->business_permit->getClientOriginalName();
                $ext = $request->business_permit->getClientOriginalExtension();
                $business_permit = $spot->id . "_business_permit." . $ext;
                $request->business_permit->storeAs("permits/$user->business_type/$spot->id", $business_permit, 'public');
                $spot->update(['business_permit'=>$business_permit]);
            }
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

        if( $user->business_type == 'tourist_spot' ){ 
            $business = TouristSpot::where('user_id', $user->id)->first();
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
    public function update(Request $request, $id)
    {   

        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',    
            'description' => 'required',
            'location' => 'required',
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'business_permit' => 'file',
        ]);


        if( $user->business_type == 'hotel' ){  
            $business = Hotel::find($id);
            $business->min_price = $request->min_price;
            $business->max_price = $request->max_price;
        }

        if( $user->business_type == 'restaurant' ){  
            $business = Restaurant::find($id);
        }
        
        if( $user->business_type == 'tourist_spot' ){  
            $business = TouristSpot::find($id);
            $business->price = $request->price;
        }

        if($request->hasFile('picture')){
            $picture = $request->picture->getClientOriginalName();
            $ext = $request->picture->getClientOriginalExtension();
            $filename = $id . "_picture." . $ext;
            $request->picture->storeAs("pictures/$user->business_type/$id", $filename, 'public');
            $business->picture = $filename;
        }

        if($request->hasFile('business_permit')){
            $permit = $request->business_permit->getClientOriginalName();
            $ext = $request->business_permit->getClientOriginalExtension();
            $business_permit = $id . "_business_permit." . $ext;
            $request->business_permit->storeAs("permits/$user->business_type/$id", $business_permit, 'public');
            $business->business_permit =  $business_permit;
        }
        
        
        $business->name = $request->name;
        $business->email = $request->email;
        $business->number = $request->number;
        $business->description = $request->description;
        $business->location = $request->location;
        $business->lat = $request->lat;
        $business->long = $request->long;
        
        $business->update();

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
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'business_permit' => 'file',
            'price_range' => '',
            'min_price' => 'required',
            'max_price' => 'required'
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
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'business_permit' => 'file'
        ]);
    }

    protected function validateTouristSpot(?TouristSpot $TouristSpot = null): array
    {
        $TouristSpot ??= new TouristSpot();

        return request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('tourist_spots', 'email')->ignore($TouristSpot)],
            'business_permit' => 'required',
            'number' => 'required',
            'description' => '',
            'location' => '',
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'long' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'business_permit' => 'file'
        ]);
    }
}
