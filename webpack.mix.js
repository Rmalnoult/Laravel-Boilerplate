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

// bower install

mix.js('resources/assets/js/app.js', 'public/js').version();

mix.sass('resources/assets/sass/app.scss', 'public/css')

mix.styles([
	'resources/assets/css/app.css',
	'resources/assets/css/style.css',
	'resources/assets/css/mobile.css',
], 'public/css/all.css')
.version();

// mix.delete('public/css/all.css');

mix.browserSync({
	proxy: 'localhost:8000',
	browser: 'firefox',
	// notify: false
});
