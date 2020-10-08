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

// Routing untuk authentication
Auth::routes();

// Routing untuk halaman depan
Route::view('/', 'welcome');
Route::get('/', 'PasteController@syntaxDropdownList');
Route::get('/home', 'HomeController@index');

Route::get('/archive', 'ArchiveController@index');
Route::get('/archive/{syntax}', 'ArchiveController@archiveTag')
    ->where('syntax', '[a-zA-Z0-9]+')
    ->name('archiveTag');

Route::post('/create', 'PasteController@submit');
Route::get('/{link}', 'PasteController@view')->where('link', '[a-zA-Z0-9]+');
Route::post('/{link}', 'PasteController@view')->where('link', '[a-zA-Z0-9]+');
Route::get('/raw/{link}', 'PasteController@raw')
    ->where('link', '[a-zA-Z0-9]+')
    ->name('pasteRaw');
Route::post('/raw/{link}', 'PasteController@raw')->where('link', '[a-zA-Z0-9]+');
Route::get('/dl/{link}', 'PasteController@download')
    ->where('link', '[a-zA-Z0-9]+')
    ->name('pasteDownload');
Route::post('/dl/{link}', 'PasteController@download')->where('link', '[a-zA-Z0-9]+');

Route::get('/users/delete/{link}', 'UserController@deletePaste')
    ->where('link', '[a-zA-Z0-9]+')
    ->name('userDelPaste');
