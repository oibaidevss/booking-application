<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\TouristSpot;
use App\Models\TouristSpotBooking;
use Illuminate\Http\Request;
use App\Models\User;

class TouristSpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spots = TouristSpot::paginate(10);
        return view('admin.tourist-spots.index', ['spots'=> $spots]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners = User::with('touristspot')->where('business_type', 'tourist_spot')->get();
        return view('admin.tourist-spots.create', ['owners' => $owners]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TouristSpot::create(array_merge($this->validateSpot()));
        return redirect()->route('spots.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TouristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function show(TouristSpot $touristSpot)
    {
        $bookings = TouristSpotBooking::where('tourist_spot_id', $touristSpot->id)->paginate(10);
        return view('admin.tourist-spots.show', [
            'touristSpot' => $touristSpot,
            'bookings' => $bookings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TouristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function edit(TouristSpot $touristSpot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TouristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function update(TouristSpot $spot)
    {
        $attributes = $this->validateSpot($spot);
        $spot->update($attributes);
        return back()->with('success', 'Tourist Spot Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TouristSpot  $touristSpot
     * @return \Illuminate\Http\Response
     */
    public function destroy(TouristSpot $spot)
    {
        $spot->delete();
        return back()->with('success', 'Tourist Spot Deleted.');
    }

    public function verify($id)
    {
        $spot = TouristSpot::find($id);
        $spot->status = 1; 
        $spot->update();
        return back()->with('success', $spot->name . ' is now verified.');
    }

    protected function validateSpot(?TouristSpot $spot = null): array
    {
        $spot ??= new TouristSpot();

        return request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('hotels', 'email')->ignore($spot)],
            'number' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'picture' => '',
            'capacity' => '',
        ]);
    }
}
