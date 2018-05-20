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

Route::get('/', 'HomeController@index');
Route::get('/terms-of-action', 'HomeController@termsOfAction');
Route::get('/user-agreement', 'HomeController@userAgreement');
Route::get('/winners', 'HomeController@winners');
Route::get('/prizes', 'HomeController@prizes');
Route::get('/publication/{id}', 'HomeController@publication')->where('id', '[0-9]+');

/*images*/
Route::post('/images/uploadBase64Image', 'ImageEditor@uploadBase64Image');

/*Socialite*/
Route::get('/socialite/{provider}', 'Auth\LoginController@socialite');
Route::get('/socialite/{provider}/callback', 'Auth\LoginController@socialiteCallback');

/*AutoRegister*/
Route::post('ulogin/{id_image}', 'UloginController@login')->where('id_image', '[0-9]+');


Auth::routes();

