<?php


trait Component
{
    use PowerTrait, Engine {
        Engine::print insteadof PowerTrait;
        PowerTrait::print as printPower;
        Engine::print as printEngine;
    }

    protected function init()
    {
        $this->gas();
        $this->four();
    }
}