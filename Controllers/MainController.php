<?php


namespace Controllers;


use core\Controller;

class MainController extends Controller
{
    public function mainAction()
    {
        $this->view->render('Головна');
    }

}