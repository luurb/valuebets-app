<?php

declare(strict_types=1);

namespace App\Helpers;

abstract class BetsStatsHelper 
{
    protected static array $stats = [
        [
            'name' => 'return',
            'function' => 'sum',
            'value' => 'return'
        ],
        [
            'name' => 'stake_sum',
            'function' => 'sum',
            'value' => 'stake'
        ],
        [
            'name' => 'avg_value',
            'function' => 'avg',
            'value' => 'value'
        ],
        [
            'name' => 'counter',
            'function' => 'count',
            'value' => '',
        ],
    ];

    protected static array $returnArr = [
        'return' => 0,
        'yield' => 0,
        'value' => 0,
        'counter' => 0,
    ];
}