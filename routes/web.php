<?php
//--disable user--
Route::get('/disable', 'InactiveUserController@show')->name('inactive-user')->middleware('checklogin');

//--login--
Route::get('/', 'LoginController@show')->name('show-login')->middleware('checknotlogin');
Route::post('/login', 'LoginController@login')->name('login')->middleware('checknotlogin');
Route::get('/logout', 'LoginController@logout')->name('logout')->middleware('checklogin');

//--articles--
Route::get('/articles', 'ArticlesController@show')->name('show-index');

//--institutions--
Route::get('/institutions', 'InstitutionController@show')->name('show-institution');
Route::get('/institutions/sanitary_region/{sanitary_region_id}', 'InstitutionController@getBySanitaryRegionId')->name('get-by-sanitary-region-id');
Route::get('/institutions/all', 'InstitutionController@getAll')->name('all-institutions');
Route::get('/institutions/{id}', 'InstitutionController@getInstitution')->name('one-institutions');

//--patients--
Route::get('/patients', 'PatientController@show')->name('show-patients')->middleware('active-login')->middleware('permission:patient_index');
Route::get('/patients/all', 'PatientController@getAll')->name('all-patients')->middleware('active-login')->middleware('permission:patient_index');
Route::post('/patients/delete', 'PatientController@delete')->name('delete-patient')->middleware('active-login')->middleware('permission:patient_destroy');
Route::post('/patients/create', 'PatientController@store')->name('create-patient')->middleware('active-login')->middleware('permission:patient_new');
Route::put('/patients/update', 'PatientController@update')->name('update-patient')->middleware('active-login')->middleware('permission:patient_update');
Route::get('/patients/patient/{patient_id}', 'PatientController@getPatient')->name('get-patient')->middleware('active-login')->middleware('permission:patient_show');
Route::get('/patients/attentions/all', 'PatientController@getPatientsWithAttention')->middleware('active-login')->middleware('permission:attention_index');

//--patient attentions--
Route::get('/attentions', 'AttentionController@show')->name('show-attentions')->middleware('active-login')->middleware('permission:attention_index');
Route::get('/attentions/all', 'AttentionController@getAll')->name('all-attentions')->middleware('active-login')->middleware('permission:attention_index');
Route::post('/attentions/delete', 'AttentionController@delete')->name('delete-attentions')->middleware('active-login')->middleware('permission:attention_destroy');
Route::post('/attentions/create', 'AttentionController@store')->name('create-attentions')->middleware('active-login')->middleware('permission:attention_new');
Route::put('/attentions/update', 'AttentionController@update')->name('update-attentions')->middleware('active-login')->middleware('permission:attention_update');

Route::get('/Attentions/patient/allAttentions/{id}', 'AttentionController@getAllAttentionsById')->middleware('active-login')->middleware('permission:attention_index');
Route::get('/attentions/patient/{id}', 'AttentionController@showPatient')->name('patient-attentions')->middleware('active-login')->middleware('permission:attention_index');

//--users--
Route::get('/admin/users', 'admin\UserController@show')->name('show-users')->middleware('active-login')->middleware('permission:user_index');
Route::get('/admin/users/all', 'admin\UserController@getAll')->name('all-users')->middleware('active-login')->middleware('permission:user_index');
Route::post('/admin/users/delete', 'admin\UserController@delete')->name('delete-users')->middleware('active-login')->middleware('permission:user_destroy');
Route::post('/admin/users/create', 'admin\UserController@store')->name('create-users')->middleware('active-login')->middleware('permission:user_new');
Route::put('/admin/users/update', 'admin\UserController@update')->name('update-users')->middleware('active-login')->middleware('permission:user_update');

//--Config--
Route::get('/admin/config', 'admin\ConfigurationController@show')->name('show-config')->middleware('active-login')->middleware('permission:config_index');
Route::get('/admin/config/all', 'admin\ConfigurationController@getAll')->name('all-config')->middleware('active-login')->middleware('permission:config_index');
Route::put('/admin/config/update', 'admin\ConfigurationController@update')->name('update-config')->middleware('active-login')->middleware('permission:config_update');