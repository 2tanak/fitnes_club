<?php

use Illuminate\Support\Facades\Route;
use Modules\Grafika\App\Http\Controllers\GrafikaController;

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
/*
Route::group([], function () {
    Route::resource('grafika', GrafikaController::class)->names('grafika');
});
*/

Route::prefix('grafika')->group(function() {
//тест vue
Route::get('/vue', 'IndexController@index')->name('vue');
//передача параметров в vue
Route::get('/peredacha', 'IndexController@peredacha')->name('peredacha');

//axios
Route::get('/ajax', 'IndexController@ajax')->name('ajax');
Route::get('/ajax2', 'IndexController@ajax2')->name('ajax2');


//char линейный
Route::get('/char', 'CharController@char')->name('char');//для запроса аяксом линейного
Route::any('/charline', 'CharController@charline')->name('charline');//показ графика
//char круг
Route::get('/charkrug', 'CharController@charkrug')->name('charkrug');//для запроса аяксом линейного
Route::any('/charviewkrug', 'CharController@charviewkrug')->name('charviewkrug');//показ графика
//обновление графика по событию
Route::get('/char-dunam', 'CharController@charDunam')->name('char-dunam');//для запроса аяксом линейного
Route::any('/char-view-dunam', 'CharController@charViewDunam')->name('char-view-dunam');//показ графика

//soket
Route::get('/sokets', 'SoketController@index')->name('sokets');//для запроса аяксом линейного
Route::get('/sokets2', 'SoketController@index2')->name('sokets2');//для запроса аяксом линейного
});

