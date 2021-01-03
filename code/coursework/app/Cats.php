<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Cats {

    private $apiKey;

    public function __construct(){
        $this->apiKey = "da97b736-2bc8-4523-aa9a-0ea8bdf4ce03";
    }

    public function getCat(){
        $response = Http::get('https://api.thecatapi.com/v1/images/search');
        $catUrl =  $response->json()[0]["url"];
        return $catUrl;
    }

}