<?php

namespace App\Http\Controllers;

use App\Feed\CreateJobs;
use Illuminate\Support\Facades\Storage;

class Test extends Controller
{
    public function index()
    {
        (new CreateJobs());
        //dump(Storage::disk('feed')->get('unibet/valuebets.json'));
    }
}
