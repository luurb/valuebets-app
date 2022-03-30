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
        $bets = auth()->user()->bets()->with('sport', 'bookie')->paginate(10);
        $betsCount= auth()->user()->bets()->count();

        return view('history.index', [
            'bets' => $bets,
            'betsCount' => $betsCount
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