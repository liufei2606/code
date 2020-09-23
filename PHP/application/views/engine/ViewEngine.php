<?php

namespace Application\services\View\Engine;

interface ViewEngine
{
    public function extract($path, $data): string;
}
