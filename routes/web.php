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
Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function() {
	Route::get('/users', function () {
    return 'Controle de Users';
	});

	Route::get('/financeiro', function () {
    return 'Financeiro Painel';
	});

	Route::get('/', function () {
    return 'DashBoard';
	});

});

Route::get('/login', function () {
    return '#form login';
	});

Route::get('/categoria2/{idCat?}', function($idCat=null) {
	return "Posts da categoria {$idCat}";
});

Route::get('/categoria/{idCat}', function($idCat) {
	return "Posts da categoria {$idCat}";
});

Route::get("nome/nome2/nome6", function() {
	return 'Rota grande';
})->name('rota.nomeada');

Route::any('/any', function () {
    return 'Route any'; 
});

Route::match(['get', 'post'], '/match', function() {
	return 'Route match';
});

Route::post('/post', function () {
    return 'Route Post'; 
});

Route::get('/contato', function () {
    return 'Contato';
});

Route::get('/empresa', function () {
    return view('empresa');
});

Route::get('/', function () {
    return redirect()->route('rota.nomeada');
});
