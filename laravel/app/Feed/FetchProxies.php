<?php

namespace App\Feed;

use Goutte\Client;
use Illuminate\Support\Facades\Storage;

class FetchProxies 
{
    public function __construct()
    {
        $this->fetch();
    }

    public function fetch()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://free-proxy-list.net/');
        $proxies = $crawler->filter('.form-control')->text();
        $proxies = explode(' ', $proxies);
        
        array_splice($proxies, 0, 9);
        $proxiesJson = [];

        foreach ($proxies as $key => $proxie) {
            $proxie = explode(':', $proxie);
            $proxie = [
                'ip' => $proxie[0],
                'port' => $proxie[1]
            ];

            $proxiesJson[] = $proxie;
        }
        
        $proxies = json_encode($proxiesJson);
        Storage::disk('feed')->put('proxies.json', $proxies);
    }
}