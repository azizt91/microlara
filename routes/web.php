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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');    

Route::get('/netwatch', [App\Http\Controllers\NetwatchController::class, 'netwatch'])->name('netwatch');
Route::post('/connect', [App\Http\Controllers\IPBindingController::class, 'connect']);
Route::get('/disconnect', [App\Http\Controllers\IPBindingController::class, 'disconnect']);

Route::get('/ip-binding', 'App\Http\Controllers\IPBindingController@index')->name('ip_binding');
Route::post('/ip-binding/{id}/enable', 'App\Http\Controllers\IPBindingController@enable')->name('ip_binding.enable');
Route::post('/ip-binding/{id}/disable', 'App\Http\Controllers\IPBindingController@disable')->name('ip_binding.disable');

Route::get('/pppoe', 'App\Http\Controllers\PPPoEController@indexPPPoE')->name('pppoe');
Route::post('/pppoe/{id}/enable', 'App\Http\Controllers\PPPoEController@enablePPPoE')->name('pppoe.enable');
Route::post('/pppoe/{id}/disable', 'App\Http\Controllers\PPPoEController@disablePPPoE')->name('pppoe.disable');




