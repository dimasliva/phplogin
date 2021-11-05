<?php

use app\lib\Database;

require_once '../lib/Database.php';

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
}
