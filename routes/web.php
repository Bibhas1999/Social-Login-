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

Route::get('/success','PaymentController@success')->name('success');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('users')->group(function () {
    Route::post('/store', 'UserController@store')->name('users.store');
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'UserController@update')->name('users.update');
    Route::get('/delete/{id}', 'UserController@delete')->name('users.delete');

});

Route::prefix('profiles')->group(function(){
    
    Route::get('/view', 'UserController@view')->name('profiles.view');
    Route::get('/add', 'UserController@add')->name('profiles.add');
    Route::post('/store', 'UserController@store')->name('profiles.store');
    Route::get('/edit/profile', 'UserController@editProfile')->name('edit-profile');
    Route::post('/update/{id}', 'UserController@update')->name('profiles.update');
    Route::get('/delete/{id}', 'UserController@delete')->name('profiles.delete');
    Route::get('/password/view', 'UserController@passwordEdit')->name('profiles.password.edit');
    Route::post('/password/update', 'UserController@passwordUpdate')->name('profiles.password.update');

});

Route::get('/view/{id}', 'PaymentController@view')->name('payments.view');
Route::post('/store/{id}', 'PaymentController@store')->name('payments.store');
Route::post('/pay', 'PaymentController@pay')->name('pay');
// Google login
Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

// Facebook login
Route::get('login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

// Github login
Route::get('login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);