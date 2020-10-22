<?php

use App\Http\Controllers\Search;
use App\Models\Search as ModelsSearch;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    $data = Search::getCategories();
    return view('home',['categories' => $data[0]]);
});

Route::get('/chuck', [Search::class,'chuck'])->name('chuck');
Route::get('/chuck/categories', [Search::class,'getCategories']);*/

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group(['prefix' => '{locale}','middleware' => 'setlocale'], function() {
    Route::get('/', function () {
        $data = Search::getCategories();
        return view('home',['categories' => $data[0]]);
    });

    Route::get('/chuck', [Search::class,'chuck'])->name('chuck');
    Route::get('/chuck/categories', [Search::class,'getCategories']);

});
