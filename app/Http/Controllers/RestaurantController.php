<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.restaurants.index', ['restaurants' => Restaurant::with('tables')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Restaurant::create(array_merge($this->validateRestaurant()));
        return redirect()->route('restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show', [
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', ['restaurant' => $restaurant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Restaurant $restaurant)
    {
        $attributes = $this->validateRestaurant($restaurant);
        $restaurant->update($attributes);
        return back()->with('success', 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return back()->with('success', 'Restaurant Deleted!');
    }

    public function verify($id)
    {
        $restaurant = Restaurant::find($id);

        $restaurant->status = 1; 
        
        $restaurant->update();

        return back()->with('success', $restaurant->name . ' is now verified!');

    }

    protected function validateRestaurant(?Restaurant $restaurants = null): array
    {
        $restaurants ??= new Restaurant();


        return request()->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('restaurants', 'email')->ignore($restaurants)],
            'number' => 'required',
            'location' => 'required',
            'description' => 'required',
            'picture' => '',
        ]);
    }
}
