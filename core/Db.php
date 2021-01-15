<?php


namespace core;

use PDO;

class Db
{
    public  $db;
    public $id;
    public $name;
    public $last_name;
    public $group_name;


    public function __construct()
    {
        $config = require 'config/db.php';
        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . '', $config['user'], $config['password']);
    }

    public function query($sql)
    {
        $query = $this->db->query($sql);
        return $query;
    }

    public function row($sql)
    {
        $result = $this->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql)
    {
        $result = $this->query($sql);
        return $result->fetchColumn();

    }

}
//__________________________

