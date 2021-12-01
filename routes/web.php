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

Route::middleware('auth')->group(function(){


//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
Route::get('/dashboard/teater', 'Dashboard\TheaterController@index')->name('dashboard.teater');
Route::get('/dashboard/tiket', 'Dashboard\TicketController@index')->name('dashboard.tiket');

//MOVIES
Route::get('/dashboard/movies', 'Dashboard\MovieController@index')->name('dashboard.movies');
Route::get('/dashboard/movies/create', 'Dashboard\MovieController@create')->name('dashboard.movies.create');
Route::post('/dashboard/movies', 'Dashboard\MovieController@store')->name('dashboard.movies.store');
Route::delete('/dashboard/movies', 'Dashboard\MovieController@destroy')->name('dashboard.movies.delete');
Route::get('/dashboard/movies/{movie}', 'Dashboard\MovieController@edit')->name('dashboard.movies.edit');
Route::put('/dashboard/movies/{movie}', 'Dashboard\MovieController@update')->name('dashboard.movies.update');




//Users
Route::get('/dashboard/users', 'Dashboard\UserController@index')->name('dashboard.users');
Route::get('/dashboard/users/{id}', 'Dashboard\UserController@edit')->name('dashboard.users.edit');;
Route::put('/dashboard/users/{id}', 'Dashboard\UserController@update')->name('dashboard.users.update');
Route::delete('/dashboard/users/{id}', 'Dashboard\UserController@destroy')->name('dashboard.users.delete');
});