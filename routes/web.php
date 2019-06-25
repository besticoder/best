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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cars', 'CarController@cars')->name('cars');

Route::post('/getCars', 'CarController@getCars')->name('getCars');
Route::post('/addCars', 'CarController@addCars')->name('addCars');
Route::post('/showCars', 'CarController@showCars')->name('showCars');
Route::post('/updateCar', 'CarController@updateCar')->name('updateCar');
Route::post('/deleteCars', 'CarController@deleteCars')->name('deleteCars');