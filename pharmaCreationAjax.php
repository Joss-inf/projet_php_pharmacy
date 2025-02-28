<?php
session_start();
require "PharmacyClass.php";
require "database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['status' => 400, 'message' => 'Vous devez être connecté pour créer une pharmacie.']));
}

$userId = $_SESSION['user_id'];
$pharmacy = new Pharmacy(Database::getConnection());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and process the form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $country = trim($_POST['country']);
    $department = trim($_POST['department']);
    $description = isset($_POST['description']) ? trim($_POST['description']) : "";

    error_log("Email soumis : " . $email);
    error_log("Téléphone soumis : " . $phone);
    // Create the pharmacy
    $response = $pharmacy->postPharmacy($name, $email, $phone, $address, $country, $department, $description);

    if ($response[0] === 200) {
        // Handle file upload if a file was provided
        if (isset($_FILES['siret']) && $_FILES['siret']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['siret']['tmp_name'];
            $fileName = $_FILES['siret']['name'];
            $fileType = $_FILES['siret']['type'];

            $uploadResponse = $pharmacy->uploadFile($userId, $fileTmpPath, $fileName, $fileType);

            if ($uploadResponse[0] !== 200) {
                echo json_encode(['status' => 400, 'message' => 'Erreur lors de l\'upload du fichier SIRET.']);
                exit;
            }
        }

        echo json_encode(['status' => 200, 'message' => 'Pharmacie créée avec succès.']);
    } else {
        echo json_encode(['status' => 400, 'message' => $response[1]]);
    }
}
?>