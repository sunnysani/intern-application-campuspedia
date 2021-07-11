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

Route::get('/', 'Controller@index');

Route::get('/edit/{id}', 'Controller@edit');

Route::get('/exercise/{id}', 'Controller@exercise');

Route::post('/getscore', 'Controller@getScore');

Route::get('/createsubject', 'Controller@createSubject');

Route::post('/createsubject', 'Controller@createSubject');

Route::post('/createBlankQuestion', 'Controller@createBlankQuestion');

Route::post('/deleteQuestion', 'Controller@deleteQuestion');

Route::post('/updateQuestion', 'Controller@updateQuestion');