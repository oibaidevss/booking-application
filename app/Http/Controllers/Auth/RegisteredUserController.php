<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\User;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'business_type' => $request->business_type, 
        ]);
        
        if($request->hasFile('avatar')){
            $avatar = $request->avatar->getClientOriginalName();
            $request->avatar->storeAs('avatars', $avatar, 'public');
            $user->update(['avatar'=>$avatar]);
        }
        
        if($request->hasFile('identification')){
            $identification = $request->identification->getClientOriginalName();
            $request->identification->storeAs('identifications', $identification, 'public');
            $user->update(['identification'=>$identification]);
        }
        event(new Registered($user));
        
        Auth::login($user);

        $user->business_type == 'none' ? $user->assignRole('customer') : $user->assignRole('business owner') ;

        if(auth()->user()->hasRole('customer')){
            return redirect()->route('customer.index');
        }

        if(auth()->user()->hasRole('business owner')){
            return redirect()->route('info.index');
        }

    }
}
