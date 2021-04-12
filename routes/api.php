<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users','UserController@search');

Route::get('/countries', function (Request $request) {
    $countries = Http::get('http://country.io/names.json');
    $s         = json_decode($countries);
//
    if ($request->country != "") {
        $arr = [];

        foreach ($s as $k) {
            $d = strtolower($request->country);
            $f = strtolower($k);
            if (preg_match("/^{$d}/", $f)) {
                $arr[] = $k;
            }
        }
        return response($arr);
    }
});
