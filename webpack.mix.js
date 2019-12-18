const mix = require('laravel-mix');
//mucho para corregir
mix.js([
    'resources/js/app.js',
    'resources/js/login.js',
    'resources/js/patient.js',
    'resources/js/attention.js',
    'resources/js/user.js',
    'resources/js/config.js' ,
    'resources/js/institution.js',
    ], 'public/js/app.js')
    .styles([
    'resources/css/bootstrap.css',
    'resources/css/toastr.css'
    ], 'public/css/app.css');
