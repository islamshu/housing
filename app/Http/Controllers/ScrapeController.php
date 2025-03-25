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
        $url = "https://wecima.watch/watch/%D9%85%D8%B4%D8%A7%D9%87%D8%AF%D8%A9-%D9%85%D8%B3%D9%84%D8%B3%D9%84-%D8%A7%D8%B4%D8%BA%D8%A7%D9%84-%D8%B4%D9%82%D8%A9-%D8%AC%D8%AF%D8%A7-%D8%AD%D9%84%D9%82%D8%A9-14/";

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
        return redirect($link);
        dd($link);
        // Return or process the link
        return response()->json([
            'link' => $link,
        ]);
    }
}