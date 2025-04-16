<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private string $host = 'localhost';
    private string $dbname = 'book_catalog';
    private string $username = 'root';
    private string $password = 'testpass';
    
    private PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Never expose raw error messages in production
            die("Database connection failed.");
        }
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
