<?php

require_once 'database.php';

class Item {
    public $id;
    public $name;
    public $completed;
    private $db;

    public function __construct($id = null, $name = null, $completed = false) {
        $this->id = $id;
        $this->name = $name;
        $this->completed = $completed;
        $this->db = new Database();
        $this->createTable();
    }

    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS items (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            completed BOOLEAN DEFAULT 0
        )";
        $this->db->getConnection()->exec($sql);
    }

    public function save() {
        if ($this->id) {
            $sql = "UPDATE items SET name = ?, completed = ? WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            return $stmt->execute([$this->name, $this->completed, $this->id]);
        } else {
            $sql = "INSERT INTO items (name, completed) VALUES (?, ?)";
            $stmt = $this->db->getConnection()->prepare($sql);
            $result = $stmt->execute([$this->name, $this->completed]);
            $this->id = $this->db->getConnection()->lastInsertId();
            return $result;
        }
    }

    public static function getAll() {
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM items ORDER BY id";
        $stmt = $conn->query($sql);
        $items = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = new Item($row['id'], $row['name'], $row['completed']);
        }
        return $items;
    }

    public static function delete($id) {
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "DELETE FROM items WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}