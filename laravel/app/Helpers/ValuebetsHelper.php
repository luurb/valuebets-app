<?php

declare(strict_types=1);

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ValuebetsHelper
{
    public static function saveFilters(array $filters, string $time)
    {
        $filtersToSave = [
            'type' => [],
            'sport' => [],
            'bookies' => [],
            'time' => 6,
        ];

        foreach ($filters as $filtersName => $filtersArr) {
            foreach ($filtersArr as $checkbox => $value) {
                $filtersToSave[$filtersName][] = $checkbox;
            }
        }

        $filtersToSave['time'] = (int)$time;
        Session::put('filters', $filtersToSave);
    }

    public static function getBetsArr(): array
    {
        $bets = [];
        if (Session::has('filters')) {
            $filters = Session::get('filters');
            foreach ($filters['bookies'] as $bookie) {
                foreach($filters['sport'] as $sport) {
                    $bets = array_merge_recursive(json_decode(Storage::disk('feed')->get("$bookie/$sport/valuebets.json")), $bets);
                }
            }
            $bets = self::filterBets($bets, $filters);
        } else {
            $bets = array_merge_recursive(json_decode(Storage::disk('feed')->get('unibet/football/valuebets.json')), $bets);
            $bets = array_merge_recursive(json_decode(Storage::disk('feed')->get('pinnacle/football/valuebets.json')), $bets);
            $bets = array_merge_recursive(json_decode(Storage::disk('feed')->get('bet365/football/valuebets.json')), $bets);
        }

        return $bets;
    }

    //Function filter bets by date and if necessary by type
    private static function filterBets(array $bets, array $filters): array 
    {
        $types = $filters['type'];
        $time = $filters['time'];
        $maxTime = 6;

        if (! empty($types) && $time == $maxTime) {
            for ($i = 0; $i < count($bets); $i++) {
                $bet = $bets[$i];
                if (self::filterBetsByType($bet, $types)) {
                    array_splice($bets, $i, 1);
                    $i--;
                }
            }
        } else if (! empty($types) && $time != $maxTime) {
            for ($i = 0; $i < count($bets); $i++) {
                $bet = $bets[$i];
                if (self::filterBetsByType($bet, $types)) {
                    array_splice($bets, $i, 1);
                    $i--;
                } else if (self::filterByDate($bet, $time)) {
                    array_splice($bets, $i, 1);
                    $i--;
                }
            }
        } else if (empty($types) && $time != $maxTime) {
            for ($i = 0; $i < count($bets); $i++) {
                $bet = $bets[$i];
                if (self::filterByDate($bet, $time)) {
                    array_splice($bets, $i, 1);
                    $i--;
                }
            }
        } 

        return $bets;
    }

    //Function delete bets whose type contains key words choosen by user
    private static function filterBetsByType(mixed $bet, array $types): bool 
    {
        if (strtolower($bet->sport) == 'football') {
            $betType = strtolower($bet->bet);
            if (str_replace($types, '', $betType) !== $betType) {
                return true;
            }
        }
        return false;
    }

    private static function filterByDate(mixed $bet, int $hours): bool
    {
        $dateToFilter = Carbon::now()->addHours($hours);
        $gameDate = Carbon::createFromFormat('Y-m-d H:i', $bet->date_time);

        if ($gameDate > $dateToFilter) {
            return true;
        }

        return false;
    }

}