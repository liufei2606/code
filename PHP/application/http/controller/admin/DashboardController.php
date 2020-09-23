<?php
namespace Application\services\Http\Controller\Admin;

class DashboardController extends AdminController
{

    public function index()
    {
        $pageTitle = '管理后台 - '.$this->container->resolve('app.name');
        $siteName = $this->container->resolve('app.name');

        $user = $this->session->get('auth_user');
        $this->view->render('blog/admin/index.php', compact('pageTitle', 'siteName', 'user'));
    }
}
