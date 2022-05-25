<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\Sport;
use Illuminate\Support\Facades\Session;

class BetStatsHelper extends BetsStatsHelper
{
    public static function getStats(?string $sport): array
    {
        $returnArr = [];

        if ($sport) {
            $sportId = Sport::where('sport_name', ucfirst($sport))->first()->id;
        }

        foreach (self::$stats as $stat) {
            $function = $stat['function'];
            $value = $stat['value'];
            $name = $stat['name'];

            if ($sport) {
                if ($value) {
                    $returnArr[$name] = auth()->user()->bets()->where('sport_id', $sportId)->$function($value) ?? 0;
                } else {
                    $returnArr[$name] = auth()->user()->bets()->where('sport_id', $sportId)->$function() ?? 0;
                }

            } else {
                if ($value) {
                    $returnArr[$name] = auth()->user()->bets()->$function($value) ?? 0;
                } else {
                    $returnArr[$name] = auth()->user()->bets()->$function() ?? 0;
                }
            }
        }

        return self::returnStats($returnArr);
    }

    public static function getOverTimeStats(): array
    {
        if ($firstDate = Session::get('first_date')) {
            $secondDate = Session::get('second_date');
            $returnArr = [];

            foreach (self::$stats as $stat) {
                $function = $stat['function'];
                $value = $stat['value'];
                $name = $stat['name'];

                if ($value) {
                    $returnArr[$name] = auth()->user()->bets()
                        ->whereBetween('date_time', [$firstDate, $secondDate])
                        ->$function($value) ?? 0;
                } else {
                    $returnArr[$name] = auth()->user()->bets()
                        ->whereBetween('date_time', [$firstDate, $secondDate])
                        ->$function() ?? 0;
                }
            }

            return self::returnStats($returnArr);
        }

        return self::returnStats(null);
    }

    public static function getYield(int|float $stakeSum, int|float $return): int|float
    {
        if ($stakeSum == 0) {
            return 0;
        } else {
            return round($return / $stakeSum * 100, 2);
        }
    }

    private static function returnStats(?array $stats): array
    {
        if ($stats) {
            self::$returnArr['return'] = round($stats['return'], 2);
            self::$returnArr['yield'] = self::getYield($stats['stake_sum'], $stats['return']);
            self::$returnArr['value'] = round($stats['avg_value'], 2);
            self::$returnArr['counter'] = $stats['counter'];
        } else {
            self::$returnArr = array_map(fn ($value) => $value = 0, self::$returnArr);
        }

        return self::$returnArr;
    }
}
