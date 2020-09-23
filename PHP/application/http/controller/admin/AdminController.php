<?php

namespace Application\services\Http\Controller\Admin;

use Application\services\Http\Controller\Controller;
use Application\services\Model\Message;

class AdminController extends Controller
{
    protected $messages;

    protected $authUser;

    protected int $itemsPerPage = 15;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has('auth_user')) {
            redirect('/login');
        }
        $this->authUser = $this->session->get('auth_user');
        $this->messages = Message::orderBy('created_at', 'desc')->limit(3)->get();
    }
}
