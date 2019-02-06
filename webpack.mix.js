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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/app.js', 'public/assets/js')
mix.sass('resources/assets/sass/import.scss', 'public/assets/css/main/main.css', {
  outputStyle:mix.inProduction ? 'compressed':'expanded'
}).options({
      processCssUrls: false // SET FALSE TO REMOVE HANG PC
   });;

// live update browser
// mix.browserSync('http://localhost:8000/')
