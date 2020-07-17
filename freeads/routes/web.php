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

Route::get('/', function(){
    return view('welcome');
});


Auth::routes(['verify' => true]);

// Route::get('/', function () {
//    return view('home');
// })->middleware('verified');

Route::get('/edit', 'UserController@edit')->name('user.edit');
Route::post('/edit', 'UserController@update')->name('user.update');


Route::get('/delete', 'UserController@destroy');
Route::post('/delete', 'UserController@destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->middleware('auth');
Route::get('home', 'HomeController@index')->middleware('verified');


Route::get('/ajout', "AnnonceController@create");
Route::post('/ajout', "AnnonceController@store");
Route::group([],function(){
    Route::get('/home',"AnnonceController@index");
    Route::get('/view/{id}',"AnnonceController@show")->name('view');
    Route::get('/view_edit/{id}',"AnnonceController@edit")->name('view_edit');
    Route::post('/view_edit/{id}',"AnnonceController@update")->name('view_update');
    Route::post('/view_delete/{id}',"AnnonceController@destroy")->name('view_delete');

});