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

mix.js(
    [
        'resources/js/src/valuebets/fetch.js',
        'resources/js/src/valuebets/events.js',
        'resources/js/src/show-filters.js',
        'resources/js/src/valuebets/game-filter.js',
        'resources/js/src/modules/sorting.js',
    ],
    'public/js/valuebets.js'
)
    .sourceMaps(false)
    .js('resources/js/src/tools.js', 'public/js/tools.js')
    .sourceMaps(false)
    .js(
        [
            'resources/js/src/show-filters.js',
            'resources/js/src/history/delete-bets.js',
            'resources/js/src/history/pagination.js',
        ],
        'public/js/history.js'
    )
    .sourceMaps(false)
    .js('resources/js/src/add/events.js', 'public/js/add.js')
    .sourceMaps(false)
    .sass('resources/scss/main.scss', 'public/css', [
        //
    ]);
