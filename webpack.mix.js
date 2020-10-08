const mix = require('laravel-mix');

mix
  .sass('resources/sass/pasteyuk.scss', 'public/css')
  .sass('resources/sass/auth/auth.scss', 'public/css')
  .sass('resources/sass/bootstrap-purple/bootstrap-purple.scss', 'public/css')
  .js([
    'node_modules/bootstrap/dist/js/bootstrap.bundle.js'
  ], 'public/js/app.js')
  .copyDirectory('node_modules/jquery/dist', 'public/vendor/jquery')
  .copyDirectory('node_modules/@fortawesome/fontawesome-free', 'public/vendor/fontawesome');

mix
  .extract()
  .version()
  .setPublicPath('public')
  .options({
      autoprefixer: false,
      processCssUrls: false,
  });

if (!mix.inProduction()) {
    mix
      .webpackConfig({
          devtool: 'source-map',
      })
      .sourceMaps()
      .browserSync({
          open: 'external',
        host: 'urlhub.test',
          proxy: 'urlhub.test'
      })
}

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
