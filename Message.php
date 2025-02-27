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

    public function getMessage($pharmacy) {
        try {
            // Utilisation de requêtes préparées pour éviter les injections SQL
            $sql = "SELECT Message.message, Message.timestamp, Users.email, Pharmacy.name 
                    FROM Message 
                    INNER JOIN Pharmacy ON Message.pharmacy_id = Pharmacy.id 
                    INNER JOIN Users ON Message.user_id = Users.id 
                    WHERE Message.pharmacy_id = :pharmacy_id 
                    ORDER BY Message.timestamp ASC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pharmacy_id', $pharmacy, PDO::PARAM_INT);
            $stmt->execute();
            
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [200, $messages];
        } catch (PDOException $e) {
            return [400, "Error while fetching messages: " . $e->getMessage()];
        }
    }

}
?>