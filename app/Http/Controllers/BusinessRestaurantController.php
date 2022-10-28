<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Table;


class BusinessRestaurantController extends Controller
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
        return view('business-owner.table.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user  = auth()->user();
        $restaurant = Restaurant::where('user_id', $user->id)->first();
        Table::create(array_merge($this->validateRoom(), ['restaurant_id' => $restaurant->id]));

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
        $table = Table::find($id);
        return view('business-owner.table.edit', ['table' => $table]);     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Table $table)
    {
        $user  = auth()->user();
        
        $attributes = $this->validateRoom($table);
        $table->update($attributes);

        return redirect()->route('info.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return back()->with('success', 'Table Deleted!');
    }

    protected function validateRoom(?Table $table = null): array
    {
        $table ??= new Table();

        return request()->validate([
            'table_number' => 'required|numeric',
            'description' => 'required'
        ]);
    }
}
