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

	//Check
	Route::get('check', array('as' => 'auth.check', 'uses' => 'AuthController@check'));

	//logout
	Route::get('logout', array('as' => 'auth.logout', 'uses' => 'AuthController@logout'));

	//Registration
	Route::post('register', array('as' => 'auth.register', 'uses' => 'AuthController@register'));

	//Login/Authentication
	Route::post('login', array('as' => 'auth.login', 'uses' => 'AuthController@login'));

	//Activation
	Route::get('activate/{code}', array('as' => 'auth.activate', 'uses' => 'AuthController@activate'));

	

});

//Mail routes that can be found in the MailController
Route::group(array('prefix' => 'mail'), function(){

	//Return all the sent emails in DB
	Route::get('all', array('as' => 'mail.all', 'uses' => 'MailController@all'));

	//Return the section
	Route::get('section', array('as' => 'mail.section', 'uses' => 'MailController@section'));

	//Sponsorship
	Route::post('sponsor', array('as' => 'mail.sponsor', 'uses' => 'MailController@sponsor'));

});

Route::group(array('prefix' => 'utility'), function(){

	//Return all the sent emails in DB
	Route::get('leaderboard', array('as' => 'utility.leaderboard', 'uses' => 'UtilityController@leaderboard'));

});