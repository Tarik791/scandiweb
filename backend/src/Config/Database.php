<?php
// src/Config/Database.php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static $conn;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$conn === null) {
            $config = include __DIR__ . '/Config.php';
            $env = $_SERVER['SERVER_NAME'] === 'localhost' ? 'localhost' : 'production';
            
            $dsn = $config[$env]['dsn'];
            $username = $config[$env]['username'];
            $password = $config[$env]['password'];

            try {
                self::$conn = new PDO($dsn, $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new PDOException('Connection Error: ' . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
