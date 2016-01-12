<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


//Auth Routes that can be found in the AuthController
Route::group(array('prefix' => 'auth'), function(){

	//Registration
	Route::post('register', array('as' => 'auth.register', 'uses' => 'AuthController@register'));

	//Login/Authentication
	Route::post('login', array('as' => 'auth.login', 'uses' => 'AuthController@login'));

	//Activation
	Route::get('activate/{code}', array('as' => 'auth.activate', 'uses' => 'AuthController@activate'));

});

//Mail routes that can be found in the MailController
Route::group(array('prefix' => 'mail'), function(){

	//Sponsorship
	Route::post('sponsor', array('as' => 'mail.sponsor', 'uses' => 'MailController@sponsor'));

});
