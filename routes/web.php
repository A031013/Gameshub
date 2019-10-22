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

Route::get('/', 'JogosController@index')->name('jogos.index');
Route::get('/politicas', 'PagesController@politicas');
Route::get('/sobre', 'PagesController@sobre');

Auth::routes();


Route::get('/profile/show/{id}', 'ProfilesController@show');
Route::get('/profile/configuration', 'ProfilesController@configuration');
Route::post('/profile/configuration/change_picture', 'ProfilesController@change_picture')->name('profiles.change_picture');
Route::post('/profile/configuration/change_username', 'ProfilesController@change_username')->name('profiles.change_username');
Route::post('/profile/configuration/change_password', 'ProfilesController@change_password')->name('profiles.change_password');
Route::post('/profile/configuration/change_mail', 'ProfilesController@change_mail')->name('profiles.change_mail');
Route::post('/profile/configuration/change_date_birth', 'ProfilesController@change_date_birth')->name('profiles.change_date_birth');
Route::post('/profile/configuration/change_biography', 'ProfilesController@change_biography')->name('profiles.change_biography');
Route::post('/profile/configuration/change_address', 'ProfilesController@change_address')->name('profiles.change_address');
Route::post('/profile/configuration/request_developer_status', 'ProfilesController@request_developer_status')->name('profiles.request_developer_status');


Route::get('/requests', 'Request_statusController@index')->name('requests.index');
Route::get('/requests/view/{id}', 'Request_statusController@view');
Route::get('/requests/download/{game_name}', 'Request_statusController@download')->name('requests.download');
Route::get('/requests/accept/{id}', 'Request_statusController@accept');
Route::get('/requests/deny/{id}', 'Request_statusController@deny');
Route::get('/uploads', 'Request_statusController@uploads')->name('requests.uploads');;

Route::get('/jogo/{id}', 'JogosController@show')->name('jogo.show');
Route::get('/dev-games/new', 'JogosController@create')->name('jogos.new');
Route::get('/dev-games/edit/{id}', 'JogosController@edit')->name('jogos.edit');
Route::get('/jogo/vote/{id}', 'JogosController@vote')->name('jogos.vote');
Route::post('/jogo/store_vote/{id}', 'JogosController@store_vote')->name('jogos.store_vote');
Route::get('/jogo/download/demo/{game_name}', 'JogosController@download_demo')->name('jogos.download_demo');
Route::get('/jogo/download/games/{game_name}', 'JogosController@download_jogo')->name('jogos.download_jogo');
Route::post('/dev-games/store', 'JogosController@store')->name('jogos.store');
Route::post('/dev-games/update/{id}', 'JogosController@update')->name('jogos.update');
Route::get('/dev-games/destroy/{id}', 'JogosController@destroy')->name('jogos.destroy');
Route::get('/dev-games', 'JogosController@developerIndex')->name('dev.index');