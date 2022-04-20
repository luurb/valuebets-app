<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bets;

use App\Helpers\BetStatsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BetsHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $counter = $this->getCounter($request->get('counter'));

        $bets = auth()->user()->bets()
            ->with('sport', 'bookie')->orderBy('created_at', 'desc')->paginate($counter);

        $betsCount= auth()->user()->bets()->count();

        $stats = BetStatsHelper::getStats();
        $overTimeStats= BetStatsHelper::getOverTimeStats();

        return view('history.index', [
            'bets' => $bets,
            'betsCount' => $betsCount,
            'counter' => $counter,
            'allTimeStats' => [
                'return' => $stats['return'],
                'yield' => $stats['yield'],
                'value' => $stats['value'] 
            ],
            'overTimeStats' => [
                'return' => $overTimeStats['return'],
                'yield' => $overTimeStats['yield'],
                'value' => $overTimeStats['value'] 
            ]
        ]);
    }

    public function deleteBets(Request $request)
    {
        if ($request->json('games')) {
            $games = $request->json('games');
        } else {
            return response()->json([
                'response' => 0,
                'counter' => 0
            ], 400);
        }

        $counter = 0;
        $bets = auth()->user()->bets;

        foreach ($games as $id) {
            if (! $bets->where('id', $id)->first()) {
                return response()->json([
                    'response' => 0,
                    'counter' => 0
                ], 400);
            }
        }

        foreach ($games as $id) {
            $bets->where('id', $id)->first()->delete();
            $counter++;
        }

        return response()->json([
            'response' => 2,
            'counter' => $counter
        ]);
    }

    //Function set time range for filters
    public function setTimeRange(Request $request)
    {
        $this->validate($request, [
            'first_date' => 'required|date|after:01-01-2000',
            'second_date' => 'required|date|after_or_equal:first_date'
        ]);

        Session::put('first_date', $request->get('first_date'));
        Session::put('second_date', $request->get('second_date'));

        return redirect()->route('history');
    }

    //Function save in session and return pagination counter 
    private function getCounter(?string $data): int 
    {
        $counters = [10, 20, 50, 100];
        $counter = 20;

        if ($data) {
            if (in_array($data, $counters)) {
                Session::put('pagination_counter', (int)$data);
                $counter = (int)$data;
            }
        } else if ($savedCounter = Session::get('pagination_counter')) {
            $counter = $savedCounter;
        }

        return $counter;
    }
}