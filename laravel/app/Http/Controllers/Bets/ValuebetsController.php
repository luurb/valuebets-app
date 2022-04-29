<?php

namespace App\Http\Controllers\Bets;

use App\Helpers\BetAddHelper;
use App\Helpers\ValuebetsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValuebetsController extends Controller
{
    public function index()
    {
        return view('bets.valuebets.index');
    }

    public function fetch()
    {
        $bets = ValuebetsHelper::getBetsArr();
        return response()->json($bets);

    }

    public function store(Request $request)
    {
        if (!auth()->user()) {
            return response()->json([
                'response' => 4,
                'counter' => 0
            ]);
        }

        $data = $request->json()->all();
        $games = $data['games'];
        $counter = 0;

        foreach ($games as $game) {
            $bookieId = BetAddHelper::getBookieId($game['bookie']);
            $sportId = BetAddHelper::getSportId($game['sport']);
            auth()->user()->bets()->create([
                'bookie_id' => $bookieId,
                'sport_id' => $sportId,
                'date_time' => $game['date'],
                'teams' => $game['teams'],
                'league' => $game['league'],
                'bet' => $game['bet'],
                'odd' => $game['odd'],
                'value' => rtrim($game['value'], '%'),
                'stake' => 0,
                'result' => 'Pending',
                'return' => 0
            ]);

            $counter++;
        }

        if ($counter === 0 && $data['counter'] === 0) {
            return response()->json([
                'response' => 5,
                'counter' => $counter
            ]);
        }

        return response()->json([
            'response' => 1,
            'counter' => [
                'saved' => $counter,
                'deleted' => $data['counter'] - $counter
            ]
        ]);
    }

    public function filter(Request $request)
    {
        $filters = $request->only('sport', 'bookies', 'type');

        if (! array_key_exists('sport', $filters) || ! array_key_exists('bookies', $filters)) {
            return redirect()->route('valuebets')->withErrors([
                'filtersErrorMessage' => 'Please choose at least one sport and bookie'
            ]);
        }

        ValuebetsHelper::saveFilters(
            $filters,
            $request->get('event-during')
        );

        return redirect()->route('valuebets');
    }
}
