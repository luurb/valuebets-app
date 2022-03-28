<?php

namespace App\Http\Controllers\Bets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BetsHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bets = auth()->user()->bets()->with('sport', 'bookie')->get();

        return view('history.index', [
            'bets' => $bets
        ]);
    }

    public function betDelete(Request $request)
    {
        foreach ($request->input('delete') as $id) {
            $bets = auth()->user()->bets;

            if ($bets->where('id', $id)->first()) {
                $bets->where('id', $id)->first()->delete();
            }
        }

        return redirect()->route('history');
    }
}