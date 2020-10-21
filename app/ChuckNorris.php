<?php

namespace App;

use Illuminate\Support\Facades\Http;
use App\Http\Resources\Search as SearchResource;

class ChuckNorris {
    public static function callApi($endpoint,$data = "") {
        $api_url = "https://api.chucknorris.io/jokes/";
        $method2url = array(
            'random'   => 'random',
            'words'    => 'search?',
            'category' => 'random?category=',
        );

        $response = Http::get($api_url.$method2url[$endpoint].$data);
        if($response->status() != 200) return false;

        if(isset($response->json()['result'])) return SearchResource::collection($response->json()['result']);

        return new SearchResource($response->json());

    }
}
