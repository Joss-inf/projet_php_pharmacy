<?php
class Pharmacy {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Create a new pharmacy
    public function postPharmacy($name, $email, $phone, $address, $country, $department, $description) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Pharmacy (name, email, phone, address, country, department, description) VALUES (:name, :email, :phone, :address, :country, :department, :description)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'country' => $country,
                'department' => $department,
                'description' => $description
            ]);
            return [200, 'Pharmacie créée avec succès.'];
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') { // Duplicate entry error
                return [400, 'Erreur: L\'email ou le téléphone existe déjà.'];
            }
            return [400, 'Erreur lors de la création de la pharmacie: ' . $e->getMessage()];
        }
    }

    public function uploadFile($userId, $fileTmpPath, $fileName, $fileType) {
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $validExtensions)) {
            return [400, 'Seuls les fichiers JPG, PNG, GIF et PDF sont autorisés.'];
        }

        if (filesize($fileTmpPath) > 2 * 1024 * 1024) { // 2 MB
            return [400, 'Le fichier est trop volumineux. La taille maximale autorisée est 2 Mo.'];
        }

        $fileData = file_get_contents($fileTmpPath);
        $stmt = $this->db->prepare("INSERT INTO Upload (id_user, file_name, mime_type, data) VALUES (:id_user, :file_name, :mime_type, :data)");
        if ($stmt->execute(['id_user' => $userId, 'file_name' => $fileName, 'mime_type' => $fileType, 'data' => $fileData])) {
            return [200, 'Fichier téléchargé avec succès.'];
        } else {
            return [400, 'Erreur lors du téléchargement du fichier.'];
        }
    }
}
?>