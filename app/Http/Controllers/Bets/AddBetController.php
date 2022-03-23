<?php

namespace App\Http\Controllers\Bets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddBetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('add.index');
    } 

    public function store(Request $request)
    {
        $this->validate($request, [
            'teams' => 'required|max:255',
            'bet' => 'required|max:255',
            'odd' => 'required|numeric',
            'value' => 'required|numeric',
            'stake' => 'required|integer|numeric',
        ]);
    }
}
