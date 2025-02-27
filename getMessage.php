<?php 
session_start();

require_once "MessageClass.php";
require_once "database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$messages = new Messages(Database::getConnection());

if (!isset($_SESSION['pharmacy_id'])) {
    $pharmacy_id = 1;
} else {
    $pharmacy_id = $_SESSION['pharmacy_id'];
}

$response = $messages->getMessage($pharmacy_id);

echo json_encode([
    'status' => $response[0],  // 200 if Ok or 400 if not
    'message' => $response[1] // the error message
]);
?>