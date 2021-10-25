<?php

namespace App\Scraper;

use App\Models\Actor;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;

class actors
{
    public function scrape()
    {
        $url = 'https://www.themoviedb.org/movie';

        $client = new Client();

        $crawler = $client->request('GET', $url);

        $links = [];

        $crawler->filter('#media_results .page_wrapper .card.style_1 .content')->each(
            function (Crawler $node) use (&$links) {
                array_push($links, $node->filter('h2>a')->attr('href'));
            }
        );

        foreach ($links as $link) {
            $crawler = $client->request('GET', $link . '/cast');

            echo $link . PHP_EOL;

            $crawler->filter('#media_v4 .content_wrapper section.panel ol.people > li')->each(
                function (Crawler $node) use (&$cast) {
                    try {
                        Actor::create(
                            [
                                "fullname" =>  $node->filter('.info p a')->text(),
                                "slug" =>  Str::slug($node->filter('.info p a')->text()),
                                "avatar" => $node->filter('.profile')->attr("src")
                                    ? 'https://www.themoviedb.org/' . str_replace('w66_and_h66_face', 'original', $node->filter('.profile')->attr("src"))
                                    : null,
                            ]
                        );
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            );

            // $imageSrc = 'https://www.themoviedb.org/' . str_replace('w300_and_h450_bestv2_filter(blur)', 'original', $imageSrc);

        }
    }
}
