<?php

namespace App;

require_once __DIR__ . '/Database.php';
use PDO;

class Model
{
    protected $db;
    protected $table;

    public function __construct($table)
    {
        $database = new Database();
        $this->db = $database->getConnection();
        if (!isset($this->table)) {
            throw new \Exception('Table not defined in model.');
        }
    }

    public function create(array $data) {
        if (!isset($this->db)) {
            throw new \Exception('Database connection not set.');
        }
    
        if (!isset($this->table)) {
            throw new \Exception('Table name not defined in the model.');
        }
    
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
    
        $stmt = $this->db->prepare($sql);
    
        // Bind values manually for better debugging
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
    
        return $stmt->execute();
    }

    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    
        // Correctly fetch the row as an instance of the Book class
        return $stmt->fetch();
    }
    

    public function update(int $id, array $data) {
        $setClauses = [];
        foreach ($data as $key => $value) {
            $setClauses[] = "$key = :$key";
        }
        $setClause = implode(', ', $setClauses);
        $sql = "UPDATE {$this->table} SET $setClause WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
