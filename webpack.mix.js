const mix = require('laravel-mix');
//mucho para corregir
mix.js([
    'resources/js/app.js',
    'resources/js/login.js',
    'resources/js/patient.js',
    'resources/js/patientNN.js',
    'resources/js/attention.js',
    'resources/js/user.js',
    'resources/js/config.js' ,
    'resources/js/institution.js',
    'resources/js/password.js',
    'resources/js/role.js',
    ], 'public/js/app.js')
    .styles([
    'resources/css/bootstrap.css',
    'resources/css/toastr.css',
    'resources/css/layout.css',  
    'resources/css/buttons.css',
    ], 'public/css/app.css');
