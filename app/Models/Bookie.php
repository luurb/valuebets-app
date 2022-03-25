<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookie extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bookie_name'
    ];

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }
}
