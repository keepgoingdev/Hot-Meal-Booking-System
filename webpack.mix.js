let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |s
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/Clients/UploadClient', 'public/js')
    .js('resources/assets/js/Clients/MealClient', 'public/js')
    .js('resources/assets/js/Clients/GroceryListClient', 'public/js')
    .js('resources/assets/js/Clients/ProfileClient', 'public/js')
    .js('resources/assets/js/Clients/DayViewClient', 'public/js')
    .js('resources/assets/js/Utils/ApiUtil', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .scripts(['resources/assets/slick/slick.js'], 'public/slick/slick.min.js')
    .sass('resources/assets/slick/slick.scss', 'public/slick/')
    .sass('resources/assets/slick/slick-theme.scss', 'public/slick/');
