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

Route::get('/', function () {
	return view('welcome');
})->name('home');

Route::get('locale/{locale}', function($locale){
    App::setLocale($locale);
})->name('locale');

Auth::routes();
Route::get('/activate/token/{token}','Auth\ActivationController@activate')->name('auth.activate');
Route::get('/activate/resend/{user}', 'Auth\ActivationController@resend')->name('auth.activate.resend');

Route::resource('user', 'UserController');

Route::get('/home', ['as' => 'dashboard.home', 'uses' => 'Controller@home']);
Route::resource('clubs', 'ClubController');
Route::resource('races', 'RaceController');
Route::get('races/{race}/json', 'RaceController@json');
Route::resource('sections', 'SectionController');
Route::resource('pigeons', 'PigeonController', ['except' => ['index']]);
Route::post('actions/exists', 'ActionController@exists')->name('actions.exists');
Route::post('pigeons/chip', 'PigeonController@setChip')->name('pigeons.chip');
Route::post('pigeons/chip/remove', 'PigeonController@removeChip')->name('pigeons.chip.remove');
Route::post('pigeons/json', 'PigeonController@json')->name('pigeons.json');
Route::get('pigeons/{field?}/{direction?}', 'PigeonController@sortedIndex')->name('pigeons.index');

Route::get('logs', 'LogController@index')->name('antennas.logs');

Route::get('antennas/all', 'AntennaController@all')->name('antennas.all');
Route::post('antennas/race', 'AntennaController@setRace')->name('antennas.race');
Route::get('antennas/{antenna}/toggle', 'AntennaController@toggle')->name('antennas.toggle');
Route::post('antennas/type', 'AntennaController@setType')->name('antennas.setType');
Route::post('antennas/owner', 'AntennaController@setOwner')->name('antennas.setOwner');
Route::resource('antennas', 'AntennaController');
Route::get('antennas/{antenna}/refresh', 'AntennaController@refresh')->name('antennas.refresh');
Route::get('/doctor/vaccinate', 'Doctor\VaccinateController@index')->name('vaccinate');
Route::get('/doctor/vaccinate/{pigeon}', 'Doctor\VaccinateController@pigeon')->name('vaccinate.pigeon');

Route::get('/login/test', 'MijnNpoController@loginTest');
Route::get('/npo/pigeons/load', 'MijnNpoController@loadPigeons');
Route::post('/npo/pigeons/{page?}', 'MijnNpoController@getRingNumbersByPageNumber');
Route::post('/npo/pigeons/pagecount', 'MijnNpoController@getPageCount');
