<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::resource('painel/produtos', 'Painel\ProdutoController');
Route::group(['namespace' => 'Site'], function() {
	Route::get('/categoria/{id}','SiteController@categoria');
	Route::get('/categoria2/{id?}','SiteController@categoriaOp');

	Route::get('/contato','SiteController@contato');
	Route::get('/','SiteController@index');
});