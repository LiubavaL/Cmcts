<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index');

//Social auth
Route::get('auth/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('auth/callback/{provider}', 'Auth\SocialController@handleProviderCallback');


//upload custom image
//Route::post('/upload-image', 'ImageController@handleImageUpload');

Route::group(['middleware' => ['auth']], function () {
    //settings routes
    Route::get('/profile/{id?}', 'ProfileController@getProfile');
    Route::get('/settings/{tab}', 'ProfileController@getSettings');
    Route::post('/settings', 'ProfileController@postSettings');

    //comic routes
    Route::get('/comic/create', 'ComicController@getUpload');
    Route::post('/comic/create', 'ComicController@postUpload');

    //comic routes
    Route::post('/comic/{slug}/like', 'ComicController@like');
    Route::post('/comic/{slug}/dislike', 'ComicController@dislike');

    //blacklist
    Route::post('/blacklist/add', 'ProfileController@addToBL');
    Route::post('/blacklist/remove', 'ProfileController@removeFromBL');

    //following
    Route::post('/profile/{id}/follow', 'ProfileController@follow');
    Route::post('/profile/{id}/unfollow', 'ProfileController@unfollow');

    //add comments
    Route::post('/comment/add', 'CommentController@add');

    //user activation
    Route::get('/activate/{token}', 'RegisterController@activateUser');
    Route::get('/activate', 'RegisterController@sendActivationLink');
});

//comic routes
Route::get('/comic/{slug}', 'ComicController@showComic');
Route::get('/comic/{slug}/{volSequence}/{chSequence}', 'ComicController@showChapter');
Route::get('/comic/{slug}/{volSequence}/{chSequence}/{imgSequence}', 'ComicController@showImage');

//errors
Route::get('/404', 'ErrorController@show404');




