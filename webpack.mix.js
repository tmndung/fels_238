let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .js('resources/assets/templates/elearning/js/script.js', 'public/templates/elearning/js/script.js')
   .js('resources/assets/templates/admin/js/script.js', 'public/templates/admin/js/script.js')
   .js('resources/assets/templates/admin/js/jquery.nicescroll.js', 'public/templates/admin/js/jquery.nicescroll.js')
   .styles('resources/assets/templates/elearning/css/style.css', 'public/templates/elearning/css/style.css')
   .styles('resources/assets/templates/admin/css/style.css', 'public/templates/admin/css/style.css')
   .styles('resources/assets/templates/admin/css/animate.min.css', 'public/templates/admin/css/animate.min.css');
mix.copyDirectory('resources/assets/templates/elearning/images', 'public/templates/elearning/images');
mix.copyDirectory('resources/assets/templates/admin/images', 'public/templates/admin/images');
mix.copy('resources/assets/templates/admin/js/moment.min.js', 'public/templates/admin/js/moment.min.js');
