<?php
$router = new \Application\services\Http\Router();

$router->register('get', '/', 'HomeController@index');
$router->register('get', 'album', 'AlbumController@list');
$router->register('get', 'post', 'PostController@show');
$router->register('get', 'about', 'HomeController@about');
$router->register(['get', 'post'], 'contact', 'HomeController@contact');
//$store = $container->resolve(\App\Store\StoreContract::class);
//$connection = $store->newConnection();
//$request = $container->resolve('request');
//
//$router->register('get', '/', function () use ($container, $connection) {
////    $albums = $connection->table('albums')->selectAll();
//    include __DIR__."/../views/blog/home.php";
//});
//
//$router->register('get', 'album', function () use ($container, $request, $connection) {
//    $id = (int) $request->get('id');
//    if (empty($id)) {
//        echo '请指定要访问的专辑 ID';
//        exit();
//    }
//    $album = $connection->table('albums')->select($id);
//    $posts = $connection->table('posts')->selectByWhere(['album_id' => $id]);
//    include __DIR__.'/../views/blog/album.php';
//});
//
//$router->register('get', 'post', function () use ($container, $request, $connection) {
//    $id = (int) $request->get('id');
//    if (empty($id)) {
//        echo '请指定要访问的文章 ID';
//        exit();
//    }
//    $post = $connection->table('posts')->select($id);
//    $printer = $container->resolve(\App\Printer\PrinterContract::class);
//    if ($container->resolve('app.editor') == 'markdown') {
//        $post['content'] = $printer->driver('markdown')->render($post['text']);
//    } else {
//        $post['content'] = $printer->render($post['html']);
//    }
//    $pageTitle = $post['title'].' - '.$container->resolve('app.name');
//    $album = $connection->table('albums')->select($post['album_id']);
//    include __DIR__.'/../views/post.php';
//});


// admin
$router->register('get', 'admin', 'Admin\DashboardController@index');
$router->register(['get', 'post'], 'login', 'AuthController@login');
$router->register('post', 'logout', 'AuthController@logout');

$router->register('get', 'admin/albums', 'Admin\AlbumController@index');
$router->register(['get', 'post'], 'admin/album/new', 'Admin\AlbumController@add');
$router->register(['get', 'post'], 'admin/album/edit', 'Admin\AlbumController@edit');
$router->register(['post'], 'admin/album/delete', 'Admin\AlbumController@delete');

return $router;
