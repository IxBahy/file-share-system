<?php

use Illuminate\Support\Facades\Route;

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

###########Routes##########

#no id 
Route::get('/drive', "DriveController@index")->name('drive.index');
Route::get('/drive/create', "DriveController@create")->name('drive.create');
Route::get('/drive/public', "DriveController@public")->name('drive.public');
Route::post('/drive/create', "DriveController@store")->name('drive.store');
#id
Route::get('/drive/show/{id}', "DriveController@show")->name('drive.show');
Route::get('/drive/edit/{id}', "DriveController@edit")->name('drive.edit');
Route::post('/drive/update/{id}', "DriveController@update")->name('drive.update');
Route::get('/drive/delete/{id}', "DriveController@destroy")->name('drive.destroy');
Route::get('/drive/download/{id}', "DriveController@download")->name('drive.download');
Route::get('/drive/share/{id}', "DriveController@share")->name('drive.share');


