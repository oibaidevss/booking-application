<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with( 'roles' )->where( 'id', '!=', 1 )->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'number' => ['required', 'string', 'numeric', 'min:11', 'unique:users'],
            'password' => 'required|confirmed|min:6',
        ]);
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => Hash::make($request->password),
            'business_type' => $request->business_type, 
        ]);

        if($request->hasFile('avatar')){
            $avatar = $request->avatar->getClientOriginalName();
            $request->avatar->storeAs("avatars/$user->id", $avatar, 'public');
            $user->update(['avatar'=>$avatar]);
        }
        
        if($request->hasFile('identification')){
            $identification = $request->identification->getClientOriginalName();
            $request->identification->storeAs("identifications/$user->id", $identification, 'public');
            $user->update(['identification'=>$identification]);
        }
        
        $user->business_type == 'none' ? $user->assignRole('customer') : $user->assignRole('business owner');

        event(new Registered($user));
      
        return redirect()->route('users.index');
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
        $user = User::find($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $user = User::find($id);
        $attributes = $this->validateUser($user);
        $user->update($attributes);
        return back()->with('sucess', 'You have successfully updated a user.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Restaurant Deleted!');
    }

    protected function validateUser(?User $user = null): array
    {
        $user ??= new User();

        $validate = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', Rule::unique('users', 'email')->ignore($user)],
            'number' => ['required', Rule::unique('users', 'number')->ignore($user)],
            'business_type' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        return $validate;

    }
}
