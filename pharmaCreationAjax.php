<?php
require "PharmacyClass.php";
require "database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pharmacy = new Pharmacy(Database::getConnection());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $country = trim($_POST['country']);
    $department = trim($_POST['department']);
    $description = trim($_POST['description']);

    $response = $pharmacy->postPharmacy($name, $email, $phone, $address, $country, $department, $description);
    echo json_encode([
        'status' => $response[0],  // 200 if Ok or 400 if not
        'message' => $response[1] // the error message
    ]);
}

?>