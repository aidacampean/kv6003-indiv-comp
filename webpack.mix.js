const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .vue()
   .sass('resources/sass/app.scss', 'public/css', {
      sassOptions: {
        quietDeps: true,
      }
   })
   .sass('resources/sass/main.scss', 'public/css', {
    sassOptions: {
      quietDeps: true,
    }
 })
   .sourceMaps();

//add version in production for cache busting
if (mix.inProduction()) {
    mix.version();
}

mix.options({
  cssNano : {
      discardComments: {
          removeAll: true
      }
  },
});

// module.exports = {
//     module: {
//       rules: [
//         {
//           test: /\.s[ac]ss$/i,
//           use: [
//             "style-loader",
//             "css-loader",
//             {
//               loader: "sass-loader",
//               options: {
//                 sourceMap: true,
//                 sassOptions: {
//                   outputStyle: "compressed",
//                   quietDeps: true,
//                 },
//               },
//             },
//           ],
//         },
//       ],
//     },
//   };



    // mix.sass('resources/sass/app.scss', 'public/css')
    // .options({
    //      postCss: [
    //          require('postcss-css-variables')()
    //      ]
    // });

//mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');