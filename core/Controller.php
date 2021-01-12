<?php


namespace core;

abstract class Controller
{
    public $route;

    public function __construct($route){
        var_dump($route);
    }

}