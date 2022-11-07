<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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
           $hotel =  Hotel::create(array_merge($this->validateHotel(), ['user_id' => $user->id]));
           if($request->hasFile('picture')){
                $picture = $request->picture->getClientOriginalName();
                $request->picture->storeAs('pictures', $picture, 'public');
                $hotel->update(['picture'=>$picture]);
           }
        }
            
        if( $user->business_type == 'restaurant' ){
            $restaurant =  Restaurant::create(array_merge($this->validateRestaurant(), ['user_id' => $user->id]));
            if($request->hasFile('picture')){
                $picture = $request->picture->getClientOriginalName();
                $request->picture->storeAs('pictures', $picture, 'public');
                $restaurant->update(['picture'=>$picture]);
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


        if( $user->business_type == 'hotel' ){  
            
            $hotel = Hotel::find($id);

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'number' => 'required',    
                'description' => 'required',
                'location' => 'required',
            ]);

            
            if($request->hasFile('picture')){
                $picture = $request->picture->getClientOriginalName();
                $ext = $request->business_permit->getClientOriginalExtension();
                $filename = $id . "_picture." . $ext;
                $request->picture->storeAs("pictures/hotel/$id", $filename, 'public');
                $hotel->picture = $filename;
            }
    
            if($request->hasFile('business_permit')){
                $permit = $request->business_permit->getClientOriginalName();
                $ext = $request->business_permit->getClientOriginalExtension();
                $business_permit = $id . "_business_permit." . $ext;
                $request->business_permit->storeAs("permits/hotel/$id", $business_permit, 'public');
                $hotel->business_permit =  $business_permit;
            }
            
            
            $hotel->name = $request->name;
            $hotel->email = $request->email;
            $hotel->number = $request->number;
            $hotel->description = $request->description;
            $hotel->location = $request->location;
            
            $hotel->update();
        }



        if( $user->business_type == 'restaurant' ){  
           

            $restaurant = restaurant::find($id);

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'number' => 'required',    
                'description' => 'required',
                'location' => 'required',
                'business_permit' => '',
                'picture' => '',
            ]);
            
            if($request->hasFile('picture')){
                $picture = $request->picture->getClientOriginalName();
                $request->picture->storeAs("pictures/restaurant/$id", $picture, 'public');
            }
    
            if($request->hasFile('business_permit')){
                $permit = $request->business_permit->getClientOriginalName();
                $request->business_permit->storeAs("permits/restaurant/$id", $permit, 'public');
            }
            
            $restaurant->picture = $request->hasFile('picture') ? $picture : $restaurant->picture;
            $restaurant->business_permit = $request->hasFile('business_permit') ? $permit : $restaurant->picture;
            
            $restaurant->name = $request->name;
            $restaurant->email = $request->email;
            $restaurant->business_permit = $request->business_permit;
            $restaurant->number = $request->number;
            $restaurant->description = $request->description;
            $restaurant->location = $request->location;
            
            $restaurant->update();
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
