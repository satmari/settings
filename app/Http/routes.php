<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'WelcomeController@index');

Route::get('/', 'HomeController@index');

// Modules
Route::get('/modules', 'ModulesController@index');
Route::get('/add_module', 'ModulesController@add_module');
Route::post('/insert_module', 'ModulesController@insert_module');
Route::get('/edit_module/{id}', 'ModulesController@edit_module');
Route::post('/update_module/{id}', 'ModulesController@update_module');




Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
