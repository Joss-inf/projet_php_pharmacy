<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'pharmacy';
    private $username = 'root';
    private $password = '';
    private static $instance = null;
    private $conn;

    // Constructeur privé pour empêcher la création directe d'instances
    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    // Méthode statique pour obtenir la connexion PDO unique
    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
    public static function closeConnection() {
        // Close the static instance connection if necessary
        self::$instance = null;
    
        // If 'conn' is an instance property, use 'self' for a static method:
        if (isset(self::$instance)) {
            self::$instance->conn = null;
        }
    }
    
}