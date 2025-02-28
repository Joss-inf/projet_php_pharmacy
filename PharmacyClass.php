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

        // Dossier de destination
        $uploadDir = __DIR__ . '/siret/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Supprimer l'ancien fichier s'il existe
        $oldFile = $this->db->prepare("SELECT file_name FROM Upload WHERE id_user = :id_user");
        $oldFile->execute(['id_user' => $userId]);
        $oldFileName = $oldFile->fetchColumn();

        if ($oldFileName && file_exists($uploadDir . $oldFileName)) {
            unlink($uploadDir . $oldFileName);
        }

        // Déplacer le nouveau fichier
        $newFilePath = $uploadDir . "siret" . $userId . '.' . $fileExtension;
        if (move_uploaded_file($fileTmpPath, $newFilePath)) {
            // Enregistrer le fichier dans la base de données
            $stmt = $this->db->prepare("INSERT INTO Upload (id_user, file_name, mime_type, data) VALUES (:id_user, :file_name, :mime_type, :data)");
            if ($stmt->execute(['id_user' => $userId, 'file_name' => $fileName, 'mime_type' => $fileType, 'data' => file_get_contents($newFilePath)])) {
                return [200, 'Fichier téléchargé avec succès.'];
            } else {
                return [400, 'Erreur lors du téléchargement du fichier.'];
            }
        } else {
            return [400, 'Erreur lors du déplacement du fichier.'];
        }
    }
}
?>