<?php

namespace Application\services\Http\Controller;

use Application\services\Model\Album;

class AlbumController extends Controller
{
    public function list()
    {
        $id = (int) $this->request->get('id');
        if (empty($id)) {
            echo '请指定要访问的专辑 ID';
            exit();
        }
//        $album = $this->connection->table('albums')->select($id);
//        $posts = $this->connection->table('posts')->selectByWhere(['album_id' => $id]);
        $album = Album::with('posts')->findOrFail($id)->toArray();
        $posts = $album['posts'];
        $pageTitle = $siteName = $this->container->resolve('app.name');
        $siteUrl = $this->container->resolve('app.url');

        $this->view->render('blog/album.php', compact('album', 'posts', 'pageTitle', 'siteName', 'siteUrl'));
    }
}
