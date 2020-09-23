<?php

namespace Application\services\Http\Controller;

use Application\services\Core\Container;
use Application\services\Http\Request;
use Application\services\Http\Session;
use Application\services\Store\StoreContract;
use Application\services\View\View;

class Controller
{
    /**
     * @var StoreContract
     */
    protected $connection;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var View
     */
    protected $view;

    /**
     * @var Session
     */
    protected $session;

    public function __construct()
    {
        $this->container = Container::getInstance();
        //$store = $this->container->resolve(StoreContract::class);
        //$this->connection = $store->newConnection();
        $this->request = $this->container->resolve('request');
        $this->view = $this->container->resolve('view');
        $this->session = $this->container->resolve('session');
        $this->siteName = $this->container->resolve('app.name');
    }
}
