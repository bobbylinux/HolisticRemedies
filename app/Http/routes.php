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

Route::group(['prefix' => 'auth'], function () {
// Authentication routes...
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
// Registration routes...
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
});

Route::group(array('middleware' => 'auth'), function() {
    Route::resource('carrello', 'CarrelliController');
    Route::get('carrello/{idPagamento}/pagamento','CarrelliController@getTotalWithPaymentDiscount');
    Route::resource('ordini', 'OrdiniController');
});

// Gestione backoffice
Route::group(array('middleware' => 'admin'), function() {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('prodotti', 'ProdottiController');
        Route::resource('sconti/quantita', 'ScontiQuantitaController');
        Route::resource('sconti/pagamento', 'ScontiTipoPagamentoController');
        Route::resource('clienti', 'ClientiController');
    });
});
// Cambio linguaggio
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguagesController@switchLang']);
