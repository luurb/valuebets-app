<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Exceptions\ClassNotFoundException;
use App\Http\Controllers\Bets\AddBetController;
use App\Http\Controllers\Bets\ModifyBetController;
use App\Http\Controllers\Controller;
use App\Models\Bookie;
use App\Models\Sport;
use Illuminate\Http\Request;

class BetAddHelper
{
    protected static $controllers = [
        'add' => AddBetController::class,
        'modify' => ModifyBetController::class
    ];


    public static function betValidate(string $className, Request $request) 
    {
        foreach (self::$controllers as $key => $value) {
            if ($key === $className) {
                $class = new self::$controllers[$className]();
                break;
            };
        }

        if (! isset($class) || ! $class instanceof Controller) {
            throw new ClassNotFoundException();
        }

        $class->validate($request, [
            'bookie' => 'required|max:255',
            'sport' => 'required|max:255',
            'teams' => 'required|max:255',
            'league' => 'required|max:255',
            'bet' => 'required|max:255',
            'odd' => 'required|numeric|max:1000000',
            'value' => 'required|numeric|max:10000',
            'stake' => 'required|numeric|max:1000000000',
        ]);
    }


    public static function getBookieId(string $bookieName): int
    {
        return Bookie::where('bookie_name', $bookieName)->first()->id ??
            Bookie::create(['bookie_name' => $bookieName])->id;
    }


    public static function getSportId(string $sportName): int
    {
        return Sport::where('sport_name', $sportName)->first()->id ??
            Sport::create(['sport_name' => $sportName])->id;
    }


    public static function getReturn(
        string $result,
        float $odd,
        float $stake
    ): float
    {
        if ($result === 'Pending') {
            return 0;
        }

        $factor = ($result === 'Win') ? 1 : 0;
        return ($odd * $stake * $factor) - $stake;
    }
}