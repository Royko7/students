<?php


namespace core;


class View
{
    public $path;
    public $route;
    public string $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
//        debug($this->path);
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        ob_start();
        require 'View/'.$this->path.'.php';
        $content = ob_get_clean();
        require 'View/layouts/'.$this->layout.'.php';
    }
}