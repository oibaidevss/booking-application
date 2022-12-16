<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Exports\HotelBookingExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hotels.index', ['hotels' => Hotel::with(['rooms', 'user'])->where('is_archived', 0)->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Hotel::create(array_merge($this->validateHotel()));

        return redirect()->route('hotels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        $bookings = HotelBooking::where('hotel_id', $hotel->id)->paginate(10);
        return view('admin.hotels.show', [
            'hotel' => $hotel,
            'bookings' => $bookings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', ['hotel' => $hotel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Hotel $hotel)
    {
        $attributes = $this->validateHotel($hotel);

        $hotel->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return back()->with('success', 'Post Deleted!');
    }


    public function archives(){

        
        return view('admin.hotels.archives  ', ['hotels' => Hotel::with(['rooms', 'user'])->where('is_archived', 1)->paginate(10)]);

    }

    public function archive(Hotel $hotel)
    {
        $hotel->status = 0;
        $hotel->is_archived = 1;
        $hotel->update();
        return back()->with('success', 'Archived');
    }

    public function restore(Hotel $hotel)
    {

        $hotel->is_archived = 0;
        $hotel->status = 1;
        $hotel->update();
        return back()->with('success', 'Restored');
    }


    public function verify($id)
    {
        $hotel = Hotel::find($id);

        $hotel->status = 1; 
        
        $hotel->update();

        return back()->with('success', $hotel->name . ' is now verified!');

    }

    protected function validateHotel(?Hotel $hotel = null): array
    {
        $hotel ??= new Hotel();

        return request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('hotels', 'email')->ignore($hotel)],
            'number' => 'required',
            'location' => 'required',
            'description' => 'required',
            'picture' => '',
        ]);
    }

    public function export_hotel_bookings(HotelBooking $hotelBooking, $created_at){
        return Excel::download(new HotelBookingExport($created_at), 'exported-hotel-bookings-' . Carbon::today()->toDateString() . '.xlsx');
    }
    
}
