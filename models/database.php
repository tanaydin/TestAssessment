<?php

class Database {
    private $conn;
    private $dbFile = 'shopping_list.db';

    public function __construct() {
        $this->ensureDatabaseExists();
        $this->conn = new PDO("sqlite:{$this->dbFile}");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function ensureDatabaseExists() {
        if (!file_exists($this->dbFile)) {
            $tempConn = new PDO("sqlite:{$this->dbFile}");
            $tempConn = null;
            if (function_exists('chmod')) {
                chmod($this->dbFile, 0644);
            }
        }
    }


    public function getConnection() {
        return $this->conn;
    }
}