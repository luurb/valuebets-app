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

mix.js([
        'resources/js/src/fetch.js',
        'resources/js/src/refresh-option.js',
        'resources/js/src/show-filters.js',
        'resources/js/src/game-filter.js',
        'resources/js/src/modules/sorting.js',
    ], 
    'public/js/valuebets.js').sourceMaps()
    .js([
        'resources/js/src/modules/add-icons.js',
        'resources/js/src/show-filters.js',
        'resources/js/src/delete-bet.js',
    ], 
    'public/js/history.js').sourceMaps()
    .sass('resources/scss/main.scss', 'public/css', [
        //
    ])
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ]);
