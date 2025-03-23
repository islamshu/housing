<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeController extends Controller
{
    public function scrapeLink()
    {
        // URL of the website
        $url = "https://wecima.watch/watch/%d9%85%d8%b4%d8%a7%d9%87%d8%af%d8%a9-%d9%85%d8%b3%d9%84%d8%b3%d9%84-%d8%a7%d8%b4%d8%ba%d8%a7%d9%84-%d8%b4%d9%82%d8%a9-%d8%ac%d8%af%d8%a7-%d8%ad%d9%84%d9%82%d8%a9-15-%d9%88%d8%a7%d9%84%d8%a3%d8%ae/";

        // Initialize Guzzle HTTP client
        $client = new Client();

        // Send a GET request to the website
        $response = $client->request('GET', $url);

        // Get the HTML content
        $html = $response->getBody()->getContents();

        // Initialize the DomCrawler
        $crawler = new Crawler($html);

        // Find the link inside the specified structure
        $link = $crawler->filter('div.Download--Wecima--Single ul.List--Download--Wecima--Single li a.hoverable.activable')->attr('href');
        dd($link);
        // Return or process the link
        return response()->json([
            'link' => $link,
        ]);
    }
}