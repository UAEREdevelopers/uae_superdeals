const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .webpackConfig(require('./webpack.config'));

/*
|--------------------------------------------------------------------------
| FRONTEND THEME FILES
|--------------------------------------------------------------------------

|
*/


mix.js([
    'resources/theme/js/main.js',
    'resources/theme/js/validate.js',
    'resources/theme/js/typed.min.js',
    // 'resources/theme/js/isotope.min.js',

], 'public/js/themescripts.js');

mix.styles(['resources/theme/css/bootstrap.min.css',
    'resources/theme/css/vendors.css',
    'resources/theme/css/custom.css',
    'public/css/autoComplete',
    'resources/theme/css/selectize.css',
    'resources/theme/css/style.css'
], 'public/css/themestyles.css');

/*
 |--------------------------------------------------------------------------
 | BACKEND THEME FILES
 |--------------------------------------------------------------------------

 |
 */
// mix.js([
//     'public/backend/assets/vendors/chartjs/Chart.min.js',
//     'public/backend/assets/vendors/jquery.flot/jquery.flot.js',
//     'public/backend/assets/vendors/jquery.flot/jquery.flot.resize.js',
//     'public/backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js',
//     'public/backend/assets/vendors/apexcharts/apexcharts.min.js',
//     'public/backend/assets/vendors/progressbar.js/progressbar.min.js',

//     'public/backend/assets/js/template.js',
//     'public/backend/assets/js/dashboard.js',
//     'public/backend/assets/js/datepicker.js'

// ], 'public/js/backendscripts.js');

// mix.styles([

//     'public/backend/assets/vendors/core/core.css',
//     'public/backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css',
//     'public/backend/assets/fonts/feather-font/css/iconfont.css',
//     'backend/assets/vendors/flag-icon-css/css/flag-icon.min.css',
//     'backend/assets/css/demo_1/style.css'
// ], 'public/css/backendstyles.css');






if (mix.inProduction()) {
    mix.version();
}