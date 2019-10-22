<?php

namespace App\Http\Controllers;

use App\Organisation;
use Illuminate\Http\Request;
use Goutte\Client;
use Str;

class ScrapingController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function organisations()
    {
        // create new file
        $dfile = fopen('details.html', 'w');

        $store = [];
        $organisations = [];
        $crawler = $this->client->request('GET', 'https://www.ghanayello.com/category/churches');

        $link = $crawler->selectLink("Christian Soldiers Of Faith Ministry")->link();
        $clicked = $this->client->click($link);

        // dd($crawler->filter('.company > h4')->first()->text());

        $organisations = $crawler->filter('.company > h4')->each(function($node) use ($crawler){
            $link = $crawler->selectLink($node->text())->link();
            $clickResult = $this->client->click($link);
            // filter
            $holder = $clickResult->filter('div#company_item')->first();
            $top = $holder->filter('div.cmp_details > div.cmp_details_in > div.info');
            $bottom = $holder->filter('div.cmp_more > div.info');
            return [
                'name' => $top->first()->filter('span#company_name')->first()->text(),
                'address' => $top->eq(1)->filter('div.location')->first()->text(),
                'phone' => $top->eq(2)->filter('div.text')->first()->text(),
                'website' => count($top->eq(3)->filter('div.weblinks'))?$top->eq(3)->filter('div.weblinks')->first()->text():null,
                'description' => $bottom->filter('div.desc')->first()->text(),
                'email' => 'org@churchandsermons.com',
                'lat' => count($holder->filter('div#map_canvas'))?$holder->filter('div#map_canvas')->attr('data-map-ltd'):null,
                'lon' => count($holder->filter('div#map_canvas'))?$holder->filter('div#map_canvas')->attr('data-map-lng'):null,
                'category_id' => 1,
                'user_id' => 2,
                'uuid' => Str::uuid()

            ];


        });


        // add to db
        // Organisation::insert($organisations);

        return response()->json(['organisations' => $organisations]);
    }
}
