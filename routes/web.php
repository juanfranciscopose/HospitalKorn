<?php
//--disable user--
Route::get('/disable', 'InactiveUserController@show')->name('inactive-user')->middleware('checklogin');

//--login--
Route::get('/', 'LoginController@show')->name('show-login');//siempre q no haya otra sesion iniciada
Route::post('/login', 'LoginController@login')->name('login');//siempre q no haya otra sesion iniciada
Route::get('/logout', 'LoginController@logout')->name('logout')->middleware('checklogin');

//--articles--
Route::get('/articles', 'ArticlesController@show')->name('show-articles');

//--patients--
Route::get('/patients', 'PatientController@show')->name('show-patients')->middleware('active-login')->middleware('permission:patient_index');
Route::get('/patients/all', 'PatientController@getAll')->name('all-patients')->middleware('active-login')->middleware('permission:patient_index');
Route::post('/patients/delete', 'PatientController@delete')->name('delete-patient')->middleware('active-login')->middleware('permission:patient_destroy');
Route::post('/patients/create', 'PatientController@store')->name('create-patient')->middleware('active-login')->middleware('permission:patient_new');
Route::put('/patients/update', 'PatientController@update')->name('update-patient')->middleware('active-login')->middleware('permission:patient_update');
Route::get('/patients/patient/{patient_id}', 'PatientController@getPatient')->name('get-patient')->middleware('active-login')->middleware('permission:patient_show');

//--patient attentions--
Route::get('/attentions', 'AttentionController@show')->name('show-attentions')->middleware('active-login')->middleware('permission:attention_index');
Route::get('/attentions/all', 'AttentionController@getAll')->name('all-attentions')->middleware('active-login')->middleware('permission:attention_index');
Route::post('/attentions/delete', 'AttentionController@delete')->name('delete-attentions')->middleware('active-login')->middleware('permission:attention_destroy');
Route::post('/attentions/create', 'AttentionController@store')->name('create-attentions')->middleware('active-login')->middleware('permission:attention_new');
Route::put('/attentions/update', 'AttentionController@update')->name('update-attentions')->middleware('active-login')->middleware('permission:attention_update');

//--

