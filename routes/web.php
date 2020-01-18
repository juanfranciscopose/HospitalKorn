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
Route::get('/patients/search', 'PatientController@getSearch')->name('search-patients')->middleware('active-login')->middleware('permission:patient_index');
Route::get('/patients/{patient_id}', 'PatientController@getPatient')->name('get-patient')->middleware('active-login')->middleware('permission:patient_show');
//Route::get('/patients/attentions/all', 'PatientController@getPatientsWithAttention')->middleware('active-login')->middleware('permission:attention_index');

//--patient attentions--
Route::get('/attentions', 'AttentionController@show')->name('show-attentions')->middleware('active-login')->middleware('permission:attention_index');
Route::get('/attentions/all', 'AttentionController@getAll')->name('all-attentions')->middleware('active-login')->middleware('permission:attention_index');
Route::post('/attentions/delete', 'AttentionController@delete')->name('delete-attentions')->middleware('active-login')->middleware('permission:attention_destroy');
Route::post('/attentions/create', 'AttentionController@store')->name('create-attentions')->middleware('active-login')->middleware('permission:attention_new');
Route::put('/attentions/update', 'AttentionController@update')->name('update-attentions')->middleware('active-login')->middleware('permission:attention_update');
Route::get('/attentions/search', 'AttentionController@getSearch')->name('search-attentions')->middleware('active-login')->middleware('permission:attention_index');

//--users--
Route::get('/admin/users', 'admin\UserController@show')->name('show-users')->middleware('active-login')->middleware('permission:user_index');
Route::get('/admin/users/all', 'admin\UserController@getAll')->name('all-users')->middleware('active-login')->middleware('permission:user_index');
Route::get('/admin/users/search', 'admin\UserController@getSearch')->name('search-users')->middleware('active-login')->middleware('permission:user_index');
Route::post('/admin/users/delete', 'admin\UserController@delete')->name('delete-users')->middleware('active-login')->middleware('permission:user_destroy');
Route::post('/admin/users/create', 'admin\UserController@store')->name('create-users')->middleware('active-login')->middleware('permission:user_new');
Route::put('/admin/users/update', 'admin\UserController@update')->name('update-users')->middleware('active-login')->middleware('permission:user_update');
//--change password--
Route::get('/users/password', 'PasswordController@show')->name('show-pass')->middleware('active-login');
Route::put('/users/password/update', 'PasswordController@update')->name('update-pass')->middleware('active-login');

//--Config--
Route::get('/admin/config', 'admin\ConfigurationController@show')->name('show-config')->middleware('active-login')->middleware('permission:config_index');
Route::get('/admin/config/all', 'admin\ConfigurationController@getAll')->name('all-config')->middleware('active-login')->middleware('permission:config_index');
Route::put('/admin/config/update', 'admin\ConfigurationController@update')->name('update-config')->middleware('active-login')->middleware('permission:config_update');

//--role assignment--
Route::get('/admin/role', 'admin\RoleAssignmentController@show')->name('show-role')->middleware('active-login')->middleware('permission:user_index');
Route::get('/admin/role/all', 'admin\RoleAssignmentController@getAll')->name('all-role')->middleware('active-login')->middleware('permission:user_index');
Route::get('/admin/role/users/all', 'admin\RoleAssignmentController@getAllUsersWithRole')->name('all-role')->middleware('active-login')->middleware('permission:user_index');
Route::put('/admin/role/update', 'admin\RoleAssignmentController@update')->name('update-role')->middleware('active-login')->middleware('permission:user_update');
Route::get('/admin/role/users/search', 'admin\RoleAssignmentController@getSearch')->name('search-role')->middleware('active-login')->middleware('permission:user_index');

//-- reports --
Route::get('/report', 'ReportController@show')->name('show-report')->middleware('active-login')->middleware('permission:report_index');
Route::get('/report/reason', 'ReportController@reason')->name('report-reason-show')->middleware('active-login')->middleware('permission:report_index');
Route::get('/report/gender', 'ReportController@gender')->name('report-gender-show')->middleware('active-login')->middleware('permission:report_index');
