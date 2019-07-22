<?php

//--login--
Route::get('/', 'LoginController@show')->name('show-login');//siempre q no haya otra sesion iniciada
Route::post('/login', 'LoginController@login')->name('login');//siempre q no haya otra sesion iniciada
Route::get('/logout', 'LoginController@logout')->name('logout')->middleware('checklogin');

//--articles--
Route::get('/articles', 'ArticlesController@show')->name('show-articles');

//--patients--
Route::get('/patients', 'PatientController@show')->name('show-patients')->middleware('checklogin');
Route::get('/patients/all', 'PatientController@getAll')->name('all-patients')->middleware('checklogin');
Route::post('/patients/delete', 'PatientController@delete')->name('delete-patient')->middleware('checklogin');
Route::post('/patients/create', 'PatientController@store')->name('create-patient')->middleware('checklogin');
Route::put('/patients/update', 'PatientController@update')->name('update-patient')->middleware('checklogin');

//--atencion paciente--