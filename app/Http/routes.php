<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');

Route::get('admin', 'DashBoardController@index');

// Authentication routes...
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(array('middleware' => 'auth'), function(){
    Route::resource('carrello', 'CarrelliController');
});

// Gestione backoffice
Route::group(array('middleware' => 'admin'), function() {
    Route::resource('admin/prodotti', 'ProdottiController');
    Route::resource('admin/sconti/quantita', 'ScontiQuantitaController');
    Route::resource('admin/sconti/pagamento', 'ScontiTipoPagamentoController');
    Route::resource('admin/clienti', 'ClientiController');
    Route::resource('admin/ordini', 'OrdiniController');
});
// Cambio linguaggio
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguagesController@switchLang']);