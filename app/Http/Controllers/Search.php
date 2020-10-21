<?php

namespace App\Http\Controllers;

use App\ChuckNorris;

class Search extends Controller
{
    public function random() {
        return $response = ChuckNorris::callApi('random');
    }

    public function words($word) {
        return $response = ChuckNorris::callApi('search',$word);
    }

    public function categories($category) {
        return $response = ChuckNorris::callApi('category',$category);
    }

}
