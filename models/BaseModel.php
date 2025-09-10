<?php

require_once 'database.php';

abstract class BaseModel {
    protected $db;
    protected $tableName;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    protected function getConnection() {
        return $this->db->getConnection();
    }
    
    protected function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Database error in executeQuery(): " . $e->getMessage());
            return false;
        }
    }
    
    protected function fetchAll($sql, $params = []) {
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error in fetchAll(): " . $e->getMessage());
            return [];
        }
    }
    
    protected function fetchOne($sql, $params = []) {
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error in fetchOne(): " . $e->getMessage());
            return false;
        }
    }
    
    protected function getLastInsertId() {
        return $this->getConnection()->lastInsertId();
    }
    
    abstract protected function getTableName();
    
    protected function ensureTableExists() {
        // Override in child classes to create specific table structure
    }
}
