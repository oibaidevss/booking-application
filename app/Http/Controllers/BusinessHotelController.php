<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;

class BusinessHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('business-owner.room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Room $room)
    {
        $user  = auth()->user();
        $hotel = Hotel::where('user_id', $user->id)->first();
        Room::create(array_merge($this->validateRoom(), ['hotel_id' => $hotel->id]));

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
        $room = Room::find($id);
        return view('business-owner.room.edit', ['room' => $room]);     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Room $room)
    {
        $user  = auth()->user();
        $attributes = $this->validateRoom($room);
        $room->update($attributes);
        return redirect()->route('info.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with('success', 'Post Deleted!');
    }

    protected function validateRoom(?Room $room = null): array
    {
        $room ??= new Room();

        return request()->validate([
            'room_number' => 'required|numeric',
            'floor' => 'required|numeric',
            'description' => 'required',
            'room_type' => 'required'
        ]);
    }
}
