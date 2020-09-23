<?php

namespace Application\services\Http\Controller;

use Application\services\Model\Post;

class PostController extends Controller
{
    public function show()
    {
        $id = (int) $this->request->get('id');
        if (empty($id)) {
            echo '请指定要访问的文章 ID';
            exit();
        }

//        $post = $this->connection->table('posts')->select($id);
        $post = Post::with('album')->findOrFail($id)->toArray();
        $printer = $this->container->resolve(\Application\services\Printer\PrinterContract::class);

        if ($this->container->resolve('app.editor') === 'markdown') {
            var_dump($printer->driver('markdown'));
            die;
            $post['content'] = $printer->driver('markdown')->render($post['text']);
            var_dump($post['content']);
            die;
        } else {
            $post['content'] = $printer->render($post['html']);
        }

//        $album = $this->connection->table('albums')->select($post['album_id']);
        $album = $post['album'];
        $pageTitle = $post['title'].' - '.$this->container->resolve('app.name');
        $siteUrl = $this->container->resolve('app.url');

        $this->view->render('blog/post.php', compact('post', 'album', 'pageTitle', 'siteUrl'));
    }
}
