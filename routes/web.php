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

//home routes
Route::get('/', 'HomeController@index');
Route::get('/popular', 'HomeController@popularList')->name('popular');
Route::get('/new', 'HomeController@newList')->name('new');
Route::get('/ongoing', 'HomeController@ongoingList')->name('ongoing');

//Social auth
Route::get('auth/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('auth/callback/{provider}', 'Auth\SocialController@handleProviderCallback');


//upload custom image
//Route::post('/upload-image', 'ImageController@handleImageUpload');

Route::group(['middleware' => ['auth']], function () {
    //profile routes
    Route::get('/profile/{id?}', 'ProfileController@showProfile');
    Route::get('/profile/{id?}/followers', 'ProfileController@showFollowers');
    Route::get('/profile/{id?}/following', 'ProfileController@showFollowing');

    //notifications
    Route::get('/feed', 'AjaxController@feed');
    Route::get('/notifications', 'ProfileController@showNotifications');

    //settings routes
    Route::get('/settings/{tab}', 'ProfileController@getSettings');
    Route::post('/settings', 'ProfileController@postSettings');

    //comic routes
    Route::get('/comic/create', 'ComicController@getUpload');
    Route::get('/comic/create-1', 'ComicController@getUpload1');
    Route::get('/comic/create-2', 'ComicController@getUpload2');
    Route::get('/comic/{slug}/update', 'ComicController@getUpdate');

    Route::post('/comic/create', 'ComicController@postUpload');
    Route::post('/comic/create-1', 'ComicController@postUpload1');
    Route::post('/comic/create-2', 'ComicController@postUpload2');
    Route::post('/comic/update', 'ComicController@postUpdate');
    Route::post('/comic/delete', 'AjaxController@delete');

    //comic likes
    Route::post('/comic/like', 'AjaxController@like');
    Route::post('/comic/dislike', 'AjaxController@dislike');
    //comic subscriptions
    Route::post('/comic/subscribe', 'AjaxController@subscribe');
    Route::post('/comic/unsubscribe', 'AjaxController@unsubscribe');

    //blacklist
    Route::post('/blacklist/add', 'ProfileController@addToBL');
    Route::post('/blacklist/remove', 'ProfileController@removeFromBL');

    //following
    Route::post('/profile/{id}/follow', 'ProfileController@follow');
    Route::post('/profile/{id}/unfollow', 'ProfileController@unfollow');

    //add comment
    Route::post('/comment/add', 'AjaxController@addComment');
    //add responce
    Route::post('/responce/add', 'AjaxController@addResponce');

    //user activation
    Route::get('/activate/{token}', 'ProfileController@activateUser');
    Route::get('/activate', 'ProfileController@getSendActivationLink');
});

//comic routes
Route::get('/comic/{slug}', 'ComicController@showComic')->name('show-comic');
Route::get('/comic/{slug}/{volSequence}/{chSequence}', 'ComicController@showChapter');
Route::get('/comic/{slug}/{volSequence}/{chSequence}/{imgSequence}', 'ComicController@showImage');

//errors
Route::get('/404', 'ErrorController@show404');

//search
Route::get('/search', 'AjaxController@search');

//other
Route::get('/about', 'HomeController@showAbout');
Route::get('/contact', 'HomeController@showContact');
Route::get('/help', 'HomeController@showHelp');
Route::get('/terms', 'HomeController@showTerms');




