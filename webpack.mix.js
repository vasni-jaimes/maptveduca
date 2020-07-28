const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/site/app.js', 'public/site/js')
    .sass('resources/sass/app.scss', 'public/site/css');

mix.js('resources/js/site/functions.js', 'public/site/js');
mix.js('resources/js/admin/app.js', 'public/admin/js');
mix.js('resources/js/admin/functions.js', 'public/admin/js');
