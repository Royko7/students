<?php


namespace core;

use core\View;

abstract class Controller
{
    public $route;
    public $view;
    /**
     * @var mixed
     */
    protected $model;
    /**
     * @var mixed
     * //     */
//    public $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
//        debug($this->model);
    }


    public function loadModel($name)
    {
        $path = 'Models\\' . ucfirst($name);
//        if (class_exists($path)) {
////            debug($path);
            return new $path;
//
//        }
    }

}