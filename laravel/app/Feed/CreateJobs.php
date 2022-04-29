<?php

declare(strict_types=1);

namespace App\Feed;

use App\Jobs\InitFetchingJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateJobs
{
    private array $bookiesAddr = [];
    
    public function __construct()
    {
        $this->bookiesAddr = json_decode(Storage::disk('feed')->get('scrape-links.json'), true);
        $this->fetchAll();
    }

    public function fetchAll(): void
    {
        foreach ($this->bookiesAddr as $bookie => $addresses) {
            $randNumber = rand(0, 120);
            $message = 'Delay for ' . $bookie . ': ' . $randNumber;
            Log::channel('feed')->info($message);
            InitFetchingJob::dispatch($addresses, $bookie)->delay(now()->addSeconds($randNumber));
        }
    }
}
