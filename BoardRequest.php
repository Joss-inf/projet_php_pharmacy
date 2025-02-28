<?php


class Board {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // 1. Récupérer toutes les pharmacies
    public function getPharmacies() {
        try {
            $stmt = $this->db->query("SELECT * FROM Pharmacy");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [200, $result];
        } catch (Exception $e) {
            return [400, 'Erreur lors de la récupération des pharmacies : ' . $e->getMessage()];
        }
    }

    // 2. Ajouter une pharmacie
    public function addPharmacy($name, $email, $phone, $address, $country, $department, $is_valid, $description) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Pharmacy (name, email, phone, address, country, department, is_valid, description)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $phone, $address, $country, $department, $is_valid, $description]);
            return [200, 'Pharmacie ajoutée avec succès'];
        } catch (Exception $e) {
            return [400, 'Erreur lors de l\'ajout de la pharmacie : ' . $e->getMessage()];
        }
    }

    // 4. Supprimer une pharmacie
    public function deletePharmacy($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Pharmacy WHERE id = ?");
            $stmt->execute([$id]);
            return [200, 'Pharmacie supprimée avec succès'];
        } catch (Exception $e) {
            return [400, 'Erreur lors de la suppression de la pharmacie : ' . $e->getMessage()];
        }
    }
}
