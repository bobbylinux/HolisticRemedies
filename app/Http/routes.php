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
    //cambio password
    Route::get('password', 'Auth\AuthController@getPassword');
    Route::post('password', 'Auth\AuthController@postPassword');
    //pagina di verifica
    Route::get('verify/{code}', ['middleware' => 'guest', 'uses' => 'Auth\AuthController@verifyUser']);
});

Route::group(array('middleware' => 'auth'), function() {
    Route::resource('carrello', 'CarrelliController');
    Route::get('carrello/{idPagamento}/pagamento', 'CarrelliController@getTotalWithPaymentDiscount');
    //ordini utente
    Route::get('utente/ordini', 'OrdiniController@getUserOrders');
    Route::get('utente/profilo', 'ClientiController@editProfile');
    Route::post('utente/profilo', 'ClientiController@updateProfile');
});

// Gestione backoffice

Route::group(['prefix' => 'admin'], function () {

    Route::resource('ordini', 'OrdiniController');
    Route::resource('prodotti', 'ProdottiController');
    Route::resource('sconti/quantita', 'ScontiQuantitaController');
    Route::resource('sconti/pagamento', 'ScontiTipoPagamentoController');
    Route::resource('clienti', 'ClientiController');
    Route::post('clienti/search', 'ClientiController@search');
    Route::post('ordini/search', 'OrdiniController@search');
});

// Cambio linguaggio
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguagesController@switchLang']);

Route::get('email/{order}', array('as' => 'group', 'uses' => 'OrdiniController@sendMail'));