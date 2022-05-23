<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        Redirect::setIntendedUrl(url()->previous());
    }

    public function index()
    {
        return view('auth.register.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:users,name|required|max:255|min:3',
            'email' => 'unique:users,email|required|email|max:255',
            'password' => 'required|min:6|max:255|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        if (auth()->attempt($request->only('name', 'password'))) {
            event(new Registered($user));
        }

        return redirect()->route('verification.notice');
    }
}
