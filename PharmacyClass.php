<?php

class Pharmacy {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // new pharmacy
    public function postPharmacy($name, $email, $phone, $address, $country, $department, $description) {

        // Insert a new pharmacy
        $stmt = $this->db->prepare("INSERT INTO Pharmacy (name, email, phone, address, country, department, description) VALUES (:name, :email, :phone, :address, :country, :department, :description)");
        if ($stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'address' => $address, 'country' => $country, 'department' => $department, 'description' => $description])) {
            return [200,'Message send.'];
        } else {
            return [400,"Error while sending the message."];
        }
    }
}
?>