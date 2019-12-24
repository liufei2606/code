<?php
namespace controller;

use Family\Pool\Context;

class Index
{
    public function index()
    {
        $context = Context::getContext();
        $request = $context->getRequest();
        return 'i am family by route!' . json_encode($request->get);
    }

    public function tong()
    {
        return 'i am tong ge';
    }
}
