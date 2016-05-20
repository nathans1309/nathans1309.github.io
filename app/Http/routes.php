<?php
use Facebook\FacebookRequest;

// Route::get('/', function () {
// 	echo '<a href="/fb">Use Facebook!</a><br>';
// 	echo '<a href="/instagram">Use Instagram!</a><br>';
// 	echo '<a href="/twitter">Use Twitter!</a>';
// });

Route::group(['middleware' => 'web'], function () {
    	Route::auth();

    	Route::get('/', function(){
    		return view('welcome');
    	});

	Route::group(['middleware'=>'auth'], function(){

		Route::group(['prefix'=>'account'], function(){
			Route::get('/', 'accountController@index');
			Route::get('profiles', 'accountController@index');
		});

		Route::group(['prefix'=>'content'], function(){
			Route::get('/', 'contentController@index');
			Route::get('/scheduled', 'contentController@scheduled');
			Route::get('history', 'contentController@history');
			Route::get('load/{id}', 'contentController@loadTemplate');
			Route::post('socialBlast', 'contentController@socialBlast');
		});

		Route::group(['prefix' => 'fb'], function () {
		    Route::get('/', 'fbController@index');
		    Route::get('/auth', 'fbController@auth');
		    Route::post('/post', 'fbController@post');
		    Route::post('/save_pages', 'fbController@save_pages');
		});

		Route::group(['prefix' => 'instagram'], function(){
		    Route::get('/', 'instagramController@index');
		    Route::get('/auth', 'instagramController@auth');
		    Route::get('/update', 'instagramController@update');

		});

		Route::group(['prefix' => 'twitter'], function(){
		    Route::get('/', 'twitterController@index');
		    Route::get('/auth', 'twitterController@auth');
		    Route::post('/tweet', 'twitterController@tweet');
		    Route::get('/unauth', 'twitterController@unauth');
		});

	}); //end auth middelware
}); //end web middleware




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


