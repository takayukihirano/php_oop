<?php

require_once('config/dbconnect.php');

class Todo
{
    private $table = 'tasks';
    private $db_manager;

    function __construct()
    {
        $this->db_manager = new DbManager();
        $this->db_manager->connect();
    }
}