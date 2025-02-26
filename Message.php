<?php
require "database.php";

class Messages {

    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // new message
    public function postMessage($user_id, $pharmacy_id, $timestamp, $message) {

        // Insert new message
        $stmt = $this->db->prepare("INSERT INTO Message (user_id, pharmacy_id, timestamp, message) VALUES (:user_id, :pharmacy_id, :timestamp, :message)");
        if ($stmt->execute([ 'user_id' => $user_id, 'pharmacy_id' => $pharmacy_id, 'timestamp' => $timestamp, 'message' => $message])) {
            return [200,'Inscription réussie.'];
        } else {
            return [400,"Erreur lors de l'inscription."];
        }
    }
}
?>