<?php

namespace App\Http\Controllers\Bets;

use App\Http\Controllers\Controller;
use App\Models\Bookie;
use App\Models\Sport;
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
            'bookie' => 'required|max:255',
            'sport' => 'required|max:255',
            'teams' => 'required|max:255',
            'bet' => 'required|max:255',
            'odd' => 'required|numeric',
            'value' => 'required|numeric',
            'stake' => 'required|numeric',
        ]);

        $bookieId = Bookie::where('bookie_name', $request->bookie)->first()->id ??
            Bookie::create(['bookie_name' => $request->bookie])->id;

        $sportId = Sport::where('sport_name', $request->sport)->first()->id ??
            Sport::create(['sport_name' => $request->sport])->id;

        try {
            auth()->user()->bets()->create([
                'bookie_id' => $bookieId,
                'sport_id' => $sportId,
                'date_time' => $request->date . ' ' . $request->time,
                'teams' => $request->teams,
                'bet' => $request->bet,
                'odd' => $request->odd,
                'value' => $request->value,
                'stake' => $request->stake,
                'result' => $request->result,
                'return' => $this->getReturn($request)
            ]);
        } catch (\Exception $e) {
            return redirect()->route('add')->with('status', 'Return value is to big');
        }

        return redirect()->route('add');
    }

    private function getReturn(Request $request): int 
    {
        $result = $request->result;

        if ($result === 'Pending') {
            return 0;
        }

        $factor = ($result === 'Win') ? 1 : 0;
        return ($request->odd * $request->stake * $factor) - $request->stake;
    }
}
