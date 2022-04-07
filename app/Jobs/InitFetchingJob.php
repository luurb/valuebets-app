<?php

namespace App\Jobs;

use App\Feed\FetchValuebets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class InitFetchingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $adresses, private string $bookie)
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FetchValuebets $fetchValuebets)
    { 
        $message = 'Dispatching for ' . $this->bookie;
        Log::channel('feed')->info($message);
        $fetchValuebets->createJSONFiles($this->adresses, $this->bookie);
    }
}
