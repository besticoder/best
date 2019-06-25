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

//Cars
Route::get('/cars', 'CarController@cars')->name('cars');
Route::post('/getCars', 'CarController@getCars')->name('getCars');
Route::post('/addCars', 'CarController@addCars')->name('addCars');
Route::post('/showCars', 'CarController@showCars')->name('showCars');
Route::post('/updateCar', 'CarController@updateCar')->name('updateCar');
Route::post('/deleteCars', 'CarController@deleteCars')->name('deleteCars');

//Phone
Route::get('/cell_phone', 'CellPhoneController@cell_phone')->name('cell_phone');
Route::post('/get_cell_phone', 'CellPhoneController@get_cell_phone')->name('get_cell_phone');
Route::post('/add_cell_phone', 'CellPhoneController@add_cell_phone')->name('add_cell_phone');
Route::post('/show_cell_phone', 'CellPhoneController@show_cell_phone')->name('show_cell_phone');
Route::post('/update_cell_phone', 'CellPhoneController@update_cell_phone')->name('update_cell_phone');
Route::post('/delete_cell_phone', 'CellPhoneController@delete_cell_phone')->name('delete_cell_phone');

//Inventory
Route::get('/inventory', 'InventoryController@inventory')->name('inventory');
Route::post('/get_inventory', 'InventoryController@get_inventory')->name('get_inventory');
Route::post('/add_inventory', 'InventoryController@add_inventory')->name('add_inventory');
Route::post('/show_inventory', 'InventoryController@show_inventory')->name('show_inventory');
Route::post('/update_inventory', 'InventoryController@update_inventory')->name('update_inventory');
Route::post('/delete_inventory', 'InventoryController@delete_inventory')->name('delete_inventory');