<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class BetStatsHelper
{
    public static function getStats(): array
    {
        $return = auth()->user()->bets()->sum('return') ?? 0;
        $stakesSum = auth()->user()->bets()->sum('stake') ?? 0;
        $avgValue = auth()->user()->bets()->avg('value') ?? 0;

        return [
            'return' => round($return, 2),
            'yield' => self::getYield($return, $stakesSum),
            'value' => round($avgValue, 2)
        ];
    }

    public static function getOverTimeStats(): array
    {
        $return = 0;
        $stakesSum = 0;
        $avgValue = 0;

        if ($firstDate = Session::get('first_date')) {
            $secondDate = Session::get('second_date');
            $return = auth()->user()->bets()
                ->whereBetween('date_time', [$firstDate, $secondDate])->sum('return') ?? 0;
            $stakesSum = auth()->user()->bets()
                ->whereBetween('date_time', [$firstDate, $secondDate])->sum('stake') ?? 0;
            $avgValue = auth()->user()->bets()
                ->whereBetween('date_time', [$firstDate, $secondDate])->avg('value') ?? 0;
        }

        return [
            'return' => round($return, 2),
            'yield' => self::getYield($return, $stakesSum),
            'value' => round($avgValue, 2)
        ];
    }

    public static function getYield(int|float $return, int|float $stakeSum): int|float
    {
        if ($stakeSum == 0) {
            return 0;
        } else {
            return round($return / $stakeSum * 100, 2);
        }
    }
}
