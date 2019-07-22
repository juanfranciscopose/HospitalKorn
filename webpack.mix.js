const mix = require('laravel-mix');

mix.js([
    'resources/js/app.js',
    'resources/js/login.js',
    'resources/js/patient.js' 
    ], 'public/js/app.js')
    .styles([
    'resources/css/bootstrap.css',
    'resources/css/toastr.css'
    ], 'public/css/app.css');
