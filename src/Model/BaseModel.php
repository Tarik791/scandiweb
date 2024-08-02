<?php

namespace App\Model;

use App\Config\Database;
use PDO;

abstract class BaseModel {
    protected $db;

    public function __construct() {

        $this->db = Database::getInstance();
    }
    
    abstract protected function getTableName(): string;

    public function getAll(): array
    {
        $query = "SELECT * FROM " . $this->getTableName();
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductDetails(): array {
        $query = "
            SELECT p.*, 
                   b.weight,
                   d.size,
                   CONCAT(f.height, 'x', f.width, 'x', f.length) as dimensions
            FROM products p
            LEFT JOIN book_attributes b ON p.id = b.product_id
            LEFT JOIN dvd_attributes d ON p.id = d.product_id
            LEFT JOIN furniture_attributes f ON p.id = f.product_id
        ";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data): bool {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        
        $sql = "INSERT INTO " . $this->getTableName() . " ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        return $stmt->execute();
    }

    public function insertIntoAdditionalTable($table, $data): bool {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        return $stmt->execute();
    }

    protected function unique($column, $value)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->getTableName() . " WHERE $column = :value";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['value' => $value]);
        return $stmt->fetchColumn() == 0;
    }

    public function deleteByIds(array $ids): bool {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM " . $this->getTableName() . " WHERE id IN ($placeholders)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($ids);
    }

    public function beginTransaction()
    {
        $this->db->beginTransaction();
    }

    public function commit()
    {
        $this->db->commit();
    }

    public function rollBack()
    {
        $this->db->rollBack();
    }
}
