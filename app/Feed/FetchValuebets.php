<?php

declare(strict_types=1);

namespace App\Feed;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class FetchValuebets
{
    private array $userAgents = [];

    public function __construct()
    {
        $userAgents = Storage::disk('feed')->get('user-agents.json');
        $this->userAgents = json_decode($userAgents, true);
    }

    public function createJSONFiles(array $addresses, string $bookie): void
    {
        $bets = [
            'football' => [],
            'basketball' => [],
            'tennis' => [],
            'esport' => [],
        ];

        Log::channel('feed')->info('Start fetching for ' . $bookie);

        foreach ($addresses as $address) {
            $body = $this->fetch($address);
            $scrapedbets = $this->scrapeBets($body);
            $bets = array_merge_recursive($bets, $scrapedbets);
        }

        foreach ($bets as $sport => $value) {
            $value = json_encode($value);
            $path = $bookie . '/' . $sport . '/valuebets.json';
            Storage::disk('feed')->put($path, $value);
        }
    }

    private function fetch(string $address)
    {
        $randNumber = rand(0, count($this->userAgents) - 1);
        $userAgent = $this->userAgents[$randNumber];

        $response = Http::withOptions([
            'proxy' => 'http://jqhyiwog-rotate:evk36qb06ny5@p.webshare.io:80'
        ])->withHeaders([
            'User-Agent' => $userAgent,
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language' => 'en-US,en;q=0.5',
            'Accept-Encoding' => 'gzip',
            'Upgrade-Insecure-Requests' => '1',
            'Sec-Fetch-Dest' => 'document',
            'Sec-Fetch-Mode' => 'navigate',
            'Sec-Fetch-Site' => 'cross-site',
        ])->retry(3, 100)->get($address);

        return $response->body();
    }

    //Function scrape bets from given html body and create 
    //JSON file for every sport, for specific bookie
    private function scrapeBets(string $body): array
    {
        $betsSortedBySports = [
            'football' => [],
            'basketball' => [],
            'tennis' => [],
            'esport' => [],
        ];

        $crawler = new Crawler($body);
        $trList = $crawler->filter('.app-table > tbody > tr');

        foreach ($trList as $tr) {
            $bet = $tr->childNodes;
            $betArr = $this->getBet($bet);
            $sport = strtolower($betArr['sport']);
            array_push($betsSortedBySports[$sport], $betArr);
        }
        return $betsSortedBySports;
    }

    private function getBet(\DOMNodeList $bet): array
    {
        $bookieAndSport = $bet->item(0)->childNodes;
        $bookie = trim($bookieAndSport->item(0)->textContent);
        $sport = trim($bookieAndSport->item(3)->textContent);
        if (
            $sport == "Dota" ||
            $sport == "League of Legends" ||
            $sport == "Counter-Strike" ||
            $sport == "Valorant"
        ) {
            $sport = "Esport";
        }

        $dateTime = trim($bet->item(2)->textContent);
        $dateTime = $this->getDateTime($dateTime);
        $teamsAndLeague = $bet->item(4)->childNodes;
        $teams = $teamsAndLeague->item(0)->textContent;
        $league = $teamsAndLeague->item(2)->textContent;
        if (str_contains($league, '] ')) {
            $league = explode('] ', $league)[1];
        }
        $betType = $bet->item(6)->textContent;
        $odd = floatval($bet->item(8)->textContent);
        $value = trim($bet->item(14)->textContent);
        $value = rtrim($value, "%");
        $value = ltrim($value, "+");
        $value = floatval($value);

        return [
            'bookie' => $bookie,
            'sport' => $sport,
            'date_time' => $dateTime,
            'teams' => $teams,
            'league' => $league,
            'bet' => $betType,
            'odd' => $odd,
            'value' => $value,
        ];
    }

    private function getDateTime(string $value): string
    {
        $day = substr($value, 0, 2);
        $month = substr($value, 3, 2);
        $time = substr($value, -5);
        $year = date('Y');
        $dateTime = $year . '-' . $month . '-' . $day . ' ' . $time;
        $date = Carbon::createFromFormat('Y-m-d H:i', $dateTime)
            ->addHours(2)->format('Y-m-d H:i');
        return (string)$date;
    }
}
