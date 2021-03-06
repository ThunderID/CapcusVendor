var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
	    .scripts(['Chart.min.js'], 'public/js/app.js')
		.version(['public/js/app.js', 'public/css/app.css'])
		.copy('resources/assets/images/', 'public/images/');
});
