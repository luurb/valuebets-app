<?php

namespace App\Http\Controllers\Bets;

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

        $return = auth()->user()->bets()->sum('return');
        $stakesSum = auth()->user()->bets()->sum('stake');
        $avgValue= auth()->user()->bets()->avg('value');

        $overTimeReturn = 0;
        $overTimeStakesSum= 0;
        $overTimeValue= 0;

        if ($firstDate = Session::get('first_date')) {
            $secondDate = Session::get('second_date');
            $overTimeReturn = auth()->user()->bets()
                ->whereBetween('date_time', [$firstDate, $secondDate])->sum('return');
            $overTimeStakesSum = auth()->user()->bets()
                ->whereBetween('date_time', [$firstDate, $secondDate])->sum('stake');
            $overTimeValue= auth()->user()->bets()
                ->whereBetween('date_time', [$firstDate, $secondDate])->avg('value');
        } 

        return view('history.index', [
            'bets' => $bets,
            'betsCount' => $betsCount,
            'counter' => $counter,
            'allTimeStats' => [
                'return' => $return,
                'yield' => round($return / $stakesSum * 100, 2),
                'value' => round($avgValue, 2)
            ],
            'overTimeStats' => [
                'return' => $overTimeReturn,
                'yield' => round($overTimeReturn/ $overTimeStakesSum* 100, 2),
                'value' => round($overTimeValue, 2)
            ]
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

    private function getCounter(?string $data): int 
    {
        $counters = [10, 20, 50, 100];
        $counter = 20;

        if ($data) {
            if (in_array($data, $counters)) {
                Session::put('pagination_counter', (int)$data);
                $counter = $data;
            }
        } else if ($savedCounter = Session::get('pagination_counter')) {
            $counter = $savedCounter;
        }

        return $counter;
    }
}