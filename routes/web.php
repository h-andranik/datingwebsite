<?php

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
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');




Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');






Route::get('/settings', 'UserController@index')->middleware(['auth','verified'])->name('settings');


Route::get('/user/search', 'UserController@searchResults')->middleware(['auth','verified']);



Route::get('/email/verify', function () {

    return view('auth.verify-email');

})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');

})->middleware(['auth', 'signed'])->name('verification.verify');

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::post('/add/field','UserController@update');
