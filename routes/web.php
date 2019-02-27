<?php

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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();


Route::group(['middleware' => ['web']] ,function(){
    Auth::routes();
});


Route::group(['middleware' => ['web', 'auth']] ,function(){
    Route::get('/', function () {
        return redirect('/');
    });

    Route::get('/', 'HomeController@index')->name('home');

    Route::post('/api/tweet', 'TwitterController@post_tweet')->name('tweet.post');
    Route::get('/', 'TwitterController@get');

    Route::post('/profil/follow/{profileId}', 'ProfilController@followUser');
    Route::post('/unfollow/{profileId}', 'ProfilController@unFollowUser');
    Route::get('/profil/{username}', 'ProfilController@profil')->name('profil');
    Route::get('/edit/profil', 'ProfilController@edit');
    Route::put('/profil/{id}/update', 'ProfilController@updateProfil')->name('updateProfilphp');
});




