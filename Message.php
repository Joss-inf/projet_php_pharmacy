<?php
class Messages {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // new message
    public function postMessage($user_id, $pharmacy_id, $message) {

        // Insert a new message
        $stmt = $this->db->prepare("INSERT INTO Message (user_id, pharmacy_id, message) VALUES (:user_id, :pharmacy_id, :message)");
        if ($stmt->execute([ 'user_id' => $user_id, 'pharmacy_id' => $pharmacy_id, 'message' => $message])) {
            return [200,'Message send.'];
        } else {
            return [400,"Error while sending the message."];
        }
    }

    public function getMessage() {
        try {
            $stmt = $this->db->query("SELECT * FROM Message ORDER BY timestamp ASC");
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [200, $messages];
        } catch (PDOException $e) {
            return [400, "Error while fetching messages: " . $e->getMessage()];
        }
    }

}
?>