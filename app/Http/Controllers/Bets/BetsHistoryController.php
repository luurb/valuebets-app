<?php

namespace App\Http\Controllers\Bets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BetsHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $counters = [10, 20, 50, 100];
        $counter = 20;

        if ($data = $request->get('counter')) {
            if (in_array($request->get('counter'), $counters)) {
                Cookie::queue('pagination_counter', (int)$data, 60);
                $counter = $data;
            }
        } else {
            if ($data = $request->cookie('pagination_counter')) {
                $counter = $data;
            } else {
                Cookie::queue('pagination_counter', $counter, 60);
            }
        }

        $bets = auth()->user()->bets()->with('sport', 'bookie')->paginate($counter);
        $betsCount= auth()->user()->bets()->count();

        return view('history.index', [
            'bets' => $bets,
            'betsCount' => $betsCount,
            'counter' => $counter
        ]);
    }

    public function betDelete(Request $request)
    {
        $data = $request->json()->all();
        $games = $data['games'];
        $counter= 0;

        foreach ($games as $key => $id) {
            $bets = auth()->user()->bets;

            if ($bets->where('id', $id)->first()) {
                $bets->where('id', $id)->first()->delete();
            } else {
                return response()->json([
                    'response' => 0,
                    'counter' => 0
                ]);
            }

            $counter++;
        }

        return response()->json([
            'response' => 2,
            'counter' => $counter
        ]);
    }
}