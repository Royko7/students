<?php

namespace Controllers;

use core\Controller;
use core\Db;
use core\Model;
use Models\Students;

class StudentsController extends Controller
{
//    public $model = new Students();

    private $db;

    public function studAction()
    {
        $model = new Students();
        $this->view->render('Студенти');
        $this->model->getUsers();
//       debug(loadModel());

    }

    public function indexAction()
    {
        $data = $this->model->getUsers();
        $vars = [
            'data' => $data
        ];
//debug($this->model->getUsers());
        $this->view->render('Головна', $vars);
    }

    public function updateAction()
    {
        $this->view->render('Студенти');

    }

    public function readAction()
    {
        $db = new Db;
        $data = $db->row('SELECT * FROM users');
//         debug($data);
//         echo $data;
        $vars = [
            'data' => $data,
        ];
        $this->view->render('Студенти', $vars);

    }



    public function deleteAction()
    {
        $this->view->render('Студенти');

    }


}