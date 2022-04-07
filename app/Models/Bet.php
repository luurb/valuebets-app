<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;

    protected $fillable = [
        'bookie_id',
        'sport_id',
        'date_time',
        'teams',
        'league',
        'bet',
        'odd',
        'value',
        'stake',
        'result',
        'return'
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function bookie()
    {
        return $this->belongsTo(Bookie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
