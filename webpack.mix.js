const mix = require('laravel-mix');

let ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;


mix.webpackConfig( {
  plugins: [
    new ImageminPlugin( {
      // disable: process.env.NODE_ENV !== 'production', // Disable during development
      pngquant: {
        quality: '95-100',
      },
      test: /\.(jpe?g|png|gif|svg|jpg)$/i,
    }),
  ],
})
mix.copy( 'resources/js/assets/images', 'public/images', false );

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

mix
  .vue()
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .less('resources/less/app.less', 'public/css')
  .disableNotifications();
