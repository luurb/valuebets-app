<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ValuebetsHelper
{
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
            if (! empty($filters['type'])) {
                $bets = self::filterBetsByType($bets, $filters['type']);
            }
        } else {
            $bets = array_merge_recursive(json_decode(Storage::disk('feed')->get('unibet/football/valuebets.json')), $bets);
            $bets = array_merge_recursive(json_decode(Storage::disk('feed')->get('pinnacle/football/valuebets.json')), $bets);
            $bets = array_merge_recursive(json_decode(Storage::disk('feed')->get('bet365/football/valuebets.json')), $bets);
        }

        return $bets;
    }

    //Function delete bets whose type contains key words choosen by user
    private static function filterBetsByType(array $bets, array $types): array
    {
        for ($i = 0; $i < count($bets); $i++) {
            $bet = $bets[$i];
            if (strtolower($bet->sport) == 'football') {
                $betType = strtolower($bet->bet);
                if (str_replace($types, '', $betType) !== $betType) {
                    array_splice($bets, $i, 1);
                }
            }
        }

        return $bets;
    }
}