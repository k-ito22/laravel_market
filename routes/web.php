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

Route::get('/', 'ItemController@index')
    ->name('items.index');

Route::get('/items/display', 'ItemController@display')
    ->name('items.display');
    
Route::resource('items', 'ItemController')
    ->except(['index']);
    
Route::get('/items/{item}/edit_image', 'ItemController@edit_image')
    ->name('items.edit_image');

Route::patch('/items/{item}/update_image', 'ItemController@update_image')
    ->name('items.update_image');
    
Route::post('/items/{item}/confirm', 'ItemController@confirm')
    ->name('items.confirm');
    
Route::post('/items/{item}/finish', 'ItemController@finish')
    ->name('items.finish');
    
Route::post('/ribbons/toggle_red', 'RibbonController@toggle_red')
    ->name('ribbons.toggle_red');
    
Route::post('/ribbons/toggle_blue', 'RibbonController@toggle_blue')
    ->name('ribbons.toggle_blue');
    
Route::post('/ribbons/toggle_green', 'RibbonController@toggle_green')
    ->name('ribbons.toggle_green');

Route::get('/ribbons/red', 'RibbonController@red')
    ->name('ribbons.red');

Route::get('/ribbons/blue', 'RibbonController@blue')
    ->name('ribbons.blue');

Route::get('/ribbons/green', 'RibbonController@green')
    ->name('ribbons.green');
    
Route::delete('/ribbons/destroy_red', 'RibbonController@destroy_red')
    ->name('ribbons.destroy_red');
    
Route::delete('/ribbons/destroy_blue', 'RibbonController@destroy_blue')
    ->name('ribbons.destroy_blue');
    
Route::delete('/ribbons/destroy_green', 'RibbonController@destroy_green')
    ->name('ribbons.destroy_green');

Route::get('/users/{user}', 'UserController@show')
    ->name('users.show');
    
Route::get('/users/{user}/exhibitions', 'UserController@exhibitions')
    ->name('users.exhibitions');
    
Route::resource('likes', 'LikeController')
    ->only(['index', 'store', 'destroy']);
    
Route::post('/likes/toggle', 'LikeController@toggle')
    ->name('likes.toggle');
    
Auth::routes();

Route::get('/profile/edit', 'ProfileController@edit')
    ->name('profile.edit');
    
Route::get('/profile/edit_image', 'ProfileController@edit_image')
    ->name('profile.edit_image');
    
Route::patch('/profile/update', 'ProfileController@update')
    ->name('profile.update');
    
Route::patch('/profile/update_image', 'ProfileController@update_image')
    ->name('profile.update_image');
    