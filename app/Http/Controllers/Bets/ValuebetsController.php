<?php

namespace App\Http\Controllers\Bets;

use App\Helpers\BetAddHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValuebetsController extends Controller
{
    public function index()
    {
        return view('valuebets.index');
    }

    public function store(Request $request) 
    {
        if (! auth()->user()) {
            return response()->json([
                'response' => 'false',
            ]);
        }
        
        $games = $request->json()->all();
        $counter= 0;

        foreach ($games as $game) {
            $bookieId = BetAddHelper::getBookieId($game['bookie']);
            $sportId = BetAddHelper::getSportId($game['sport']);

            auth()->user()->bets()->create([
                'bookie_id' => $bookieId,
                'sport_id' => $sportId,
                'date_time' => $game['date'],
                'teams' => $game['teams'],
                'bet' => $game['bet'],
                'odd' => $game['odd'],
                'value' => rtrim($game['value'], '%'),
                'stake' => 0,
                'result' => 'Pending',
                'return' => 0
            ]);

            $counter++;
        }
        
        return response()->json([
            'response' => 'true',
            'counter' => $counter
        ]);
    }
}
