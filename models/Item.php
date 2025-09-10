<?php

require_once 'BaseModel.php';

class Item extends BaseModel {
    public $id;
    public $name;
    public $completed;

    public function __construct($id = null, $name = null, $completed = false) {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->completed = $completed;
        $this->ensureTableExists();
    }

    public function save() {
        if ($this->id) {
            $sql = "UPDATE items SET name = ?, completed = ? WHERE id = ?";
            return $this->executeQuery($sql, [$this->name, $this->completed, $this->id]);
        } else {
            $sql = "INSERT INTO items (name, completed) VALUES (?, ?)";
            $result = $this->executeQuery($sql, [$this->name, $this->completed]);
            if ($result) {
                $this->id = $this->getLastInsertId();
            }
            return $result;
        }
    }

    public static function getAll() {
        $item = new Item();
        $item->ensureTableExists();
        $sql = "SELECT * FROM items ORDER BY id";
        $rows = $item->fetchAll($sql);
        $items = [];
        foreach ($rows as $row) {
            $items[] = new Item($row['id'], $row['name'], $row['completed']);
        }
        return $items;
    }

    public static function delete($id) {
        $item = new Item();
        $item->ensureTableExists();
        $sql = "DELETE FROM items WHERE id = ?";
        return $item->executeQuery($sql, [$id]);
    }

    protected function ensureTableExists() {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS items (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                completed BOOLEAN DEFAULT 0
            )";
            $this->getConnection()->exec($sql);
        } catch (PDOException $e) {
            error_log("Database error in ensureTableExists(): " . $e->getMessage());
        }
    }
    
    protected function getTableName() {
        return 'items';
    }
}