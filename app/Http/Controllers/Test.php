<?php

namespace App\Http\Controllers;

use App\Feed\InitFetching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Test extends Controller
{
    public function index()
    {
        (new InitFetching());
        //echo Storage::disk('feed')->get('unibet/valuebets.json');
    }
}
