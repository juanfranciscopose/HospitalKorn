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
Route::get('/patients/patient/{idPatient}', 'PatientController@getPatient')->name('get-patient')->middleware('checklogin');

//--patient attentions--
Route::get('/attentions', 'AttentionController@show')->name('show-attentions')->middleware('checklogin');
Route::get('/attentions/all', 'AttentionController@getAll')->name('all-attentions')->middleware('checklogin');
Route::post('/attentions/delete', 'AttentionController@delete')->name('delete-attentions')->middleware('checklogin');
Route::post('/attentions/create', 'AttentionController@store')->name('create-attentions')->middleware('checklogin');
Route::put('/attentions/update', 'AttentionController@update')->name('update-attentions')->middleware('checklogin');