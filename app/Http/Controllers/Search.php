<?php

namespace App\Http\Controllers;

use App\ChuckNorris;
use App\Models\Result;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\Search as SearchResource;
use App\Models\Search as ModelsSearch;
use Illuminate\Http\Request;

class Search extends Controller
{

    public function random(Request $request) {
        $response = ChuckNorris::callApi('random');
        $save = array(
            'path' => $request->path(),
        );
        $this->saveSearch($save);
        return $this->saveAndShow($response);
    }

    public function words(Request $request,$word) {
        $response = ChuckNorris::callApi('words',$word);
        $save = array(
            'path' => $request->path(),
            'keyword' => $word
        );
        $this->saveSearch($save);
        return $this->saveAndShow($response);
    }

    public function categories(Request $request,$category) {
        $response = ChuckNorris::callApi('category',$category);
        $save = array(
            'path' => $request->path(),
            'keyword' => $category
        );
        $this->saveSearch($save);
        return $this->saveAndShow($response);
    }

    private function saveSearch($data) {
        ModelsSearch::insert($data);
    }

    private function saveAndShow($response) {
        // Check if there has been any errors
        if(!empty($response['error'])) {
            return $response['error']['message'];
        }

        $collection = collect(SearchResource::collection($response));

        //Save on database
        Result::insert($collection->toArray());

        // Paginate the data
        $data = $this->paginate($collection);

        // Show results on view
        $data->withPath(URL::current());
        return view('chuck',compact('data'));
    }

    public function paginate($items, $perpage = 5, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ? : 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page,$perpage),$items->count(),$perpage,$page,$options);
    }

}
