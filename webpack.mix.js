const mix = require('laravel-mix');

require('mix-tailwindcss');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/checkout.js', 'public/js/checkout.js')
    .js('resources/js/payment.js', 'public/js/payment.js')
    .less('resources/less/app.less', 'public/css')
    .less('resources/less/admin.less', 'public/admin/css')
    .tailwind()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .postCss('resources/admin/css/admin.css', 'public/admin/css', [
        //
    ]);
