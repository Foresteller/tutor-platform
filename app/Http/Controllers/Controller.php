<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
