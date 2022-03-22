<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:users,name|required|max:255|min:3',
            'email' => 'unique:users,email|required|email|max:255',
            'password' => 'required|min:8|max:255|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        return redirect()->route('dashboard');
    }
}
