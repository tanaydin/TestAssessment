<?php

class Database {
    private $conn;  

    public function __construct() {
        $this->conn = new PDO("sqlite:shopping_list.db");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->conn;
    }
}