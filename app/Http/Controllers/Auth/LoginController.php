<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login.index');
    }    //

    public function store(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'password' => 'required|min:8|max:255'
        ]);

        if(! auth()->attempt($request->only('name', 'password'))) {
            return back()->with('status', 'Invalid login credentials');
        }

        return redirect('dashboard');
    }
}
