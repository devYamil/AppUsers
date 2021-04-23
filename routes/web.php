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
// PAGE WELCOME
Route::get('/', function () {
    return view('welcome');
});
// AUTHENTIFICATION APP USERS
Auth::routes();

// PAGE HOME
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ROUTE FOR COUNTRIES
Route::get('get-countries-data', [App\Http\Controllers\CountriesController::class, 'getCountriesData']);
// ROUTE FOR STATES
Route::get('get-states-data', [App\Http\Controllers\StatesController::class, 'getStatesData']);
// ROUTE FOR CITIES
Route::get('get-cities-data', [App\Http\Controllers\CitiesController::class, 'getCitiesData']);

// ROUTE FOR USER
Route::get('user-list', [App\Http\Controllers\UsersController::class, 'getUsers']);
Route::get('user-edit/{id}', [App\Http\Controllers\UsersController::class, 'editUser']);
Route::post('user-update', [App\Http\Controllers\UsersController::class, 'updateUser']);
Route::get('user-delete/{id}', [App\Http\Controllers\UsersController::class, 'deleteUser']);


// ROUTE EMAIL
Route::get('create-email', [App\Http\Controllers\EmailsController::class, 'createEmail']);
Route::get('list-emails', [App\Http\Controllers\EmailsController::class, 'listEmails']);
Route::post('register-emails', [App\Http\Controllers\EmailsController::class, 'registerEmails']);
Route::get('envio-emails-masivos', [App\Http\Controllers\EmailsController::class, 'envioMasivoEmails']);
