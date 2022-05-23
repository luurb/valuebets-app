<?php

namespace App\Http\Controllers\Bets;

use App\Helpers\BetAddHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddBetController extends Controller
{
    public function index()
    {
        return view('bets.add.index');
    } 

    public function store(Request $request)
    {
        BetAddHelper::betValidate('add', $request);
        $request = BetAddHelper::filterCommas($request);

        $bookieId = BetAddHelper::getBookieId($request->bookie);
        $sportId = BetAddHelper::getSportId($request->sport);
        $return = BetAddHelper::getReturn(
            $request->result,
            $request->odd,
            $request->stake
        );

        auth()->user()->bets()->create([
            'bookie_id' => $bookieId,
            'sport_id' => $sportId,
            'date_time' => $request->date . ' ' . $request->time,
            'teams' => $request->teams,
            'league' => $request->league,
            'bet' => $request->bet,
            'odd' => $request->odd,
            'value' => $request->value,
            'stake' => $request->stake,
            'result' => $request->result,
            'return' => $return
        ]);

        return redirect()->route('add')->with('status', 'Your bet was added to bets history');
    }
}
