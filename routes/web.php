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

use App\Category;
use Illuminate\Http\Request;
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
    Route::resource('/category' , 'CategoryController');
    Route::resource('/answer' , 'RepAndAnswerController');
    Route::get('/whichContent' , 'ContentController@whichContent')->name('whichContent');
    Route::post('/uploadImage' , 'UploadController@uploadImage')->name('upload.image');
    Route::post('/answer/{answer}' , 'RepAndAnswerController@update')->name('answer.update');
    Route::delete('/replay/{replay}' , 'RepAndAnswerController@destroy')->name('replay.destroy');
    Route::get('/replay/{replay}/edit' , 'RepAndAnswerController@editReplay')->name('replay.edit');
    Route::patch('/replay/{replay}' , 'RepAndAnswerController@updateReplay')->name('replay.update');
});


Route::get('/profile/{user}' , 'UserController@profile')->name('profile')->middleware('auth');
Route::post('/profile/{user}/edit' , 'UserController@userUpdate')->name('profile.edit')->middleware('auth');
Route::get('/content/{content}' , 'ContentController@show')->name('content.show');
Route::get('/s' , 'ContentController@search')->name('content.search');
Route::get('/category/{category}' , 'ContentController@categoryShow')->name('category.show');
Route::get('/redirectToPath' , function () {
    if (auth()->check()) {
        $user = auth()->user();
        $cat = Category::where('level' , $user->level)->first();
        return redirect(route('category.show' , ['category' => $cat]));
    } 
    else {
        return redirect(route('login' , ['redirect' => '/redirectToPath']));
    }
});
Route::post('/save/answer' , 'ContentController@saveAnswer')->name('save.answer')->middleware('auth');