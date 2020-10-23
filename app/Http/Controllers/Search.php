<?php

namespace App\Http\Controllers;

use App\ChuckNorris;
use App\Models\Result;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\Search as SearchResource;
use App\Mail\MyMail;
use App\Models\Search as ModelsSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Search extends Controller
{

    public function chuck(Request $request) {
        $action = $request->input('action');
        if(!$action) $action = $request->action;
        switch ($action) {
            case 'random':
                return $this->random($request);
                break;

            case 'words':
                return $this->words($request);
                break;

            case 'category':
                return $this->categories($request);
                break;
        }
    }

    public static function getCategories()
    {
        $response = ChuckNorris::callApi('categories');
        return $response;
    }

    public function random(Request $request) {
        $response = ChuckNorris::callApi('random');
        $save = array(
            'path' => $request->path(),
        );
        $this->saveSearch($save);
        return $this->saveAndShow($request,$response);
    }

    public function words(Request $request) {
        $word = $request->word;
        $url = URL::current();
        $response = ChuckNorris::callApi('words',$word);
        $save = array(
            'path' => $request->path(),
            'keyword' => $word
        );
        $this->saveSearch($save);
        return $this->saveAndShow($request,$response);
    }

    public function categories(Request $request) {
        $category = $request->category;
        $response = ChuckNorris::callApi('category',$category);
        $save = array(
            'path' => $request->path(),
            'keyword' => $category
        );
        $this->saveSearch($save);
        return $this->saveAndShow($request,$response);
    }

    private function saveSearch($data) {
        ModelsSearch::insert($data);
    }

    private function saveAndShow($request, $response) {
        // Check if there has been any errors
        if(!empty($response['error'])) {
            return view('errors.chuck',['description' => $response['error']['message']]);
            //return $response['error']['message'];
        }

        $collection = collect(SearchResource::collection($response));

        // Save on database
        Result::insert($collection->toArray());

        // Paginate the data
        $data = $this->paginate($collection);

        // Check if we want to send an email with the results
        $email = $request->email;

        if($email) {
            $this->sendEmail($request,$email);
            return "Email sent, please check your inbox";
        }

        // Show results on view
        $data->withPath($request->fullUrl());
        return view('chuck',compact('data'));
    }

    public function paginate($items, $perpage = 5, $page = null, $options = []){
        $page = $page ?: (Paginator::resolveCurrentPage() ? : 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page,$perpage),$items->count(),$perpage,$page,$options);
    }

    private function sendEmail($request, $email) {
        $url = $request->url();
        $query = $request->query();
        if(isset($query['email'])) unset($query['email']);


        $details = [
            'url'  => $url.'?'.http_build_query($query)
        ];

        Mail::to($email)->send(new MyMail($details));
    }
}
