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
            if ($e->getCode() === '23000') { // if the mail or phone is already in use cause phone and mail are unique in class Pharmacy db
                return [400, 'Erreur: L\'email ou le téléphone existe déjà.'];
            }
            return [400, 'Erreur lors de la création de la pharmacie: ' . $e->getMessage()];
        }
    }

    public function uploadFile($userId, $fileTmpPath, $fileName, $fileType) {
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        // Verification of the extention
        if (!in_array($fileExtension, $validExtensions)) {
            return [400, 'Seuls les fichiers JPG, PNG, GIF et PDF sont autorisés.'];
        }
    
        // Verify the size of the file
        if (filesize($fileTmpPath) > 2 * 1024 * 1024) { // 2 MB
            return [400, 'Le fichier est trop volumineux. La taille maximale autorisée est 2 Mo.'];
        }
    
        // dir of the securisation
        $uploadDir = __DIR__ . '/siret/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                return [400, 'Erreur lors de la création du dossier siret.'];
            }
        }
    
        // sécurisation if the dir can't be accessed (you have to use chmod 755 on the dir if is not writable)
        if (!is_writable($uploadDir)) {
            return [400, 'Le dossier siret n\'est pas accessible en écriture.'];
        }
    
        // génération of the name of the file with a siret_id.extension
        $newFileName = "siret_" . $userId . "." . $fileExtension;
        $newFilePath = $uploadDir . $newFileName;
    
        // deletion of the previous file since we don't want to conserve the previous
        $oldFile = $this->db->prepare("SELECT file_name FROM Upload WHERE id_user = :id_user");
        $oldFile->execute(['id_user' => $userId]);
        $oldFileName = $oldFile->fetchColumn();
    
        if ($oldFileName && file_exists($uploadDir . $oldFileName)) {
            unlink($uploadDir . $oldFileName);
        }
    
        // move the new file
        if (!move_uploaded_file($fileTmpPath, $newFilePath)) {
            return [400, 'Erreur lors du déplacement du fichier.'];
        }
    
        // do a request in order to know if there is an upload with the user_id
        $stmt = $this->db->prepare("SELECT id FROM Upload WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $userId]);
        $existingUpload = $stmt->fetch();
    
        if ($existingUpload) {
            // update of the upload in order to have only one upload by user-id
            $stmt = $this->db->prepare("UPDATE Upload SET file_name = :file_name, mime_type = :mime_type, data = :data WHERE id_user = :id_user");
            $stmt->execute([
                'file_name' => $newFileName,
                'mime_type' => $fileType,
                'data' => file_get_contents($newFilePath),
                'id_user' => $userId
            ]);
            return [200, 'Fichier mis à jour avec succès.'];
        } else { // if the user_is don't have an upload yet
            $stmt = $this->db->prepare("INSERT INTO Upload (id_user, file_name, mime_type, data) VALUES (:id_user, :file_name, :mime_type, :data)");
            $stmt->execute([
                'id_user' => $userId,
                'file_name' => $newFileName,
                'mime_type' => $fileType,
                'data' => file_get_contents($newFilePath)
            ]);
            return [200, 'Fichier téléchargé avec succès.'];
        }
    }
}
?>