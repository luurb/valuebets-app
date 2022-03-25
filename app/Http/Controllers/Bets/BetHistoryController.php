<?php

namespace App\Http\Controllers\Bets;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use Illuminate\Http\Request;

class BetHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bets = auth()->user()->bets()->get();

        return view('history.index', [
            'bets' => $bets
        ]);
    }
}
