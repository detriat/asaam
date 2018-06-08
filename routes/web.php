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
Route::get('/second', 'HomeController@second');

/*Route::get('/example-3', 'HomeController@example');*/

Route::get('/terms-of-action', 'HomeController@termsOfAction');
Route::get('/user-agreement', 'HomeController@userAgreement');
Route::get('/winners', 'HomeController@winners');
Route::get('/prizes', 'HomeController@prizes');
Route::get('/publication/{id}', 'HomeController@publication')->where('id', '[0-9]+');

Route::get('/sequences_desktop', 'HomeController@sequencesDesktop');
Route::get('/sequences_mobile', 'HomeController@sequencesMobile');

Route::get('/sequences_desktop_0', 'HomeController@sequencesDesktopEyes');
Route::get('/sequences_mobile_0', 'HomeController@sequencesMobileEyes');

/*images*/
Route::post('/images/uploadBase64Image', 'ImageEditor@uploadBase64Image');

/*AutoRegister*/
Route::post('ulogin/{token}', 'UloginController@getUserData');
Route::post('/register', 'UloginController@register');

/*Posts*/




