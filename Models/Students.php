<?php


namespace Models;


//use core\Db;
use core\Model;

class Students extends Model
{

    public function getUsers()
    {
        $res = $this->db->row('SELECT * FROM users ');
        return $res;
//        debug($this->db);
    }

}