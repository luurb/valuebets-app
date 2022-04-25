<?php

namespace App\Http\Controllers\Bets;

use App\Helpers\BetAddHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModifyBetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function handle(Request $request)
    {
        if (! $request->input('id')) {
            return redirect()->route('history');
        }

        $id = $request->input('id');
        if ($bet = auth()->user()->bet($id)->first()) {
            return view('modify.index', [
                'bet' => $bet,
            ]);
        }

        return redirect()->route('history');
    }

    public function update(Request $request)
    {
        BetAddHelper::betValidate('modify', $request);

        $bookieId = BetAddHelper::getBookieId($request->bookie);
        $sportId = BetAddHelper::getSportId($request->sport);
        $return = BetAddHelper::getReturn(
            $request->result,
            $request->odd,
            $request->stake
        );

        $bet = auth()->user()->bets->where('id', $request->id)->first();
        $bet->update([
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

        return redirect()->route('history');
    }
}