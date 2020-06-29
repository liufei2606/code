const mix = require('laravel-mix')

mix.js('application/resources/js/app.js', 'application/public/js')
    // .js('application/resources/js/share.js', 'application/public/js/share.js')
    .sass('application/resources/sass/app.scss', 'application/public/css')
// .sass('application/resources/sass/share.scss', 'application/public/css/share.css');

mix.copy('node_modules/startbootstrap-clean-blog/vendor/fontawesome-free/css/all.css', 'application/public/css/fontawesome.css')