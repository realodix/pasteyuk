let mix = require('laravel-mix');

mix.options({
 processCssUrls: false
});

mix.sass('resources/assets/sass/pasteyuk.scss', 'public/css', {outputStyle: 'expanded'})
   .sass('resources/assets/sass/auth/auth.scss', 'public/css')
   .sass('resources/assets/sass/bootstrap-purple/bootstrap-purple.scss', 'public/css', {outputStyle: 'expanded'})
   .js([
      'node_modules/bootstrap/dist/js/bootstrap.bundle.js'
   ], 'public/js/app.js');;

mix.copyDirectory('node_modules/jquery/dist', 'public/vendor/jquery');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free', 'public/vendor/fontawesome');

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
