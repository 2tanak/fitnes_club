<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\AuthController;

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



    Route::group([], function () {
		
	    Route::get('login/{phone?}', 'AuthController@index')->name('login');
	    Route::post('check', 'AuthController@auth')->name('check_login');
		Route::get('registration/{phone?}', 'RegistrationController@index')->name('registration');
        Route::post('registration', 'RegistrationController@save')->name('registration_save');
		Route::post('registration2', 'RegistrationController@save2')->name('registration_save2');
		Route::post('registration3', 'RegistrationController@save3')->name('registration_save3');

		Route::any('logout', 'LoginController@logout')->name('admin_logout');
       
     
    });

 

Route::prefix('auth')->group(function() {
    Route::get('/', 'AuthController@index');
});

Route::group([], function () {
    Route::resource('auth', AuthController::class)->names('auth');
});
