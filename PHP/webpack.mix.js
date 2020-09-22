const mix = require('laravel-mix')

mix.js('application/resources/js/app.js', 'application/public/js')
    .js('application/resources/js/contact.js', 'application/public/js/contact.js')
    // .js('application/resources/js/share.js', 'application/public/js/share.js')
    .sass('application/resources/sass/app.scss', 'application/public/css')
// .sass('application/resources/sass/share.scss', 'application/public/css/share.css');

// 编译后台资源
mix.js('application/resources/js/admin.js', 'application/public/js/admin.js')
    .js('application/resources/js/chart.js', 'application/public/js/chart.js')
    .js('application/resources/js/table.js', 'application/public/js/table.js')
    .sass('application/resources/sass/admin.scss', 'application/public/css/admin.css')
    .copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css', 'application/public/css/table.css')
	.copy('node_modules/@fortawesome/fontawesome-free/css/all.css', 'application/public/css/fontawesome.css')
    .copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css', 'application/public/css/table.css')
	.copy('node_modules/startbootstrap-clean-blog/vendor/fontawesome-free/css/all.css', 'application/public/css/fontawesome.css');
