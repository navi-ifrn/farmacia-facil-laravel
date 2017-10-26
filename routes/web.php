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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::post('/adicionar-ao-carrinho/{id}', 'HomeController@adicionarAoCarrinho')->name('adicionar-ao-carrinho');
Route::post('/remover-do-carrinho/{id}', 'HomeController@removerDoCarrinho')->name('remover-do-carrinho');
Route::get('finalizar')->name('finalizar');


Route::resource('laboratorios', 'LaboratorioController');

//Route::resources('laboratorios', 'LaboratorioController')->middleware('auth');
//Route::group(['middleware' => 'auth'], function(){
//    Route::resources('laboratorios', 'LaboratorioController');
//});
//
Route::resource('medicamentos', 'MedicamentoController');
Route::resource('vendas', 'VendaController');
Route::resource('usuarios', 'UserController');
