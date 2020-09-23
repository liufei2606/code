<?php

namespace Application\services\Printer;

class HtmlPrinter implements PrinterContract
{
    public function render($content)
    {
        return $content;
    }
}
