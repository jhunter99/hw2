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

Route::get('/', function(){
    return view("home")->with('username',null);
});

Route::get('/login', 'LoginController@login');
Route::post('/login', 'LoginController@checkLogin');
Route::get('/logout', 'LoginController@logout');

Route::get('/home', 'HomeController@home');
Route::get('/home/blocchi', 'HomeController@aggiungiBlocchi');
Route::get('/home/amazonApi', 'HomeController@searchAmazon');
Route::get('/home/aggiungiPreferiti/{q}', 'HomeController@aggiungiPreferiti');
Route::get('/home/caricaPreferiti', 'HomeController@caricaPreferiti');
Route::get('/home/rimuoviPreferiti/{q}', 'HomeController@rimuoviPreferiti');

Route::get('/nutrizione_online', 'NutrizioneOnlineController@start');
Route::get('/nutrizione_online/caricaRicette', 'NutrizioneOnlineController@caricaRicette');
Route::get('/nutrizione_online/edamamApi/{q}', 'NutrizioneOnlineController@searchEdamam');
Route::get('/nutrizione_online/mymemoryApi/{q}', 'NutrizioneOnlineController@translate');
Route::post('/nutrizione_online/salvaRicetta', 'NutrizioneOnlineController@salvaRicetta');
Route::get('/nutrizione_online/eliminaRicetta/{q}','NutrizioneOnlineController@eliminaRicetta');

Route::get('/register', 'RegisterController@start');
Route::post('/register', 'RegisterController@create');
Route::get('/register/email/{q}', 'RegisterController@checkEmail');
Route::get('/register/username/{q}', 'RegisterController@checkUsername');

Route::get('/inscription', 'InscriptionController@start');
Route::post('/inscription', 'InscriptionController@create');

Route::get('/corsi', 'CorsiController@start');
Route::get('/corsi/blocchi', 'CorsiController@aggiungiBlocchi');

Route::get('/profile', 'ProfileController@start');
Route::get('/profile/anagrafica', 'ProfileController@anagrafica');
Route::get('/profile/abbonamenti', 'ProfileController@abbonamenti');






