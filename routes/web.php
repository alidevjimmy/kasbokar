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

use Illuminate\Support\Facades\Auth;

Route::get('/', 'AppController@index')->name('index');

Auth::routes();

Route::group([
    'middleware' => 'isAdmin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'prefix' => 'admin'
] , function() {

    Route::get('/index' , 'AdminController@index')->name('index');
    Route::resource('/content' , 'ContentController');
    Route::get('/whichContent' , 'ContentController@whichContent')->name('whichContent');
});
