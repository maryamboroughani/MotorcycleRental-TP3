<?php
use App\Routes\Route;
use App\Controllers\HomeController;
use App\Controllers\RentalController;

// Home routes
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');


// Test route
Route::get('/test', 'HomeController@test');

// Rental routes
Route::get('/rental', 'RentalController@index'); 
Route::get('/rental/create', 'RentalController@create'); 
Route::post('/rental/create', 'RentalController@store'); 
Route::get('/rental/show', 'RentalController@show'); 
Route::get('/rental/edit', 'RentalController@edit'); 
Route::post('/rental/edit', 'RentalController@update'); 
Route::post('/rental/delete', 'RentalController@delete');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');

// Dispatch routes
Route::dispatch();
