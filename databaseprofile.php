<?php
class Database {
    private static $instance = null;
    private $conn;
    private $host = 'localhost';
    private $password = 'root';
    private $username = 'root';
    private $name = 'pharmacy';

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'error-Message: Error connecting to the database: ' . $e->getMessage().'';
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
