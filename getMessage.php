<?php 
// session_start();

require_once "Message.php";
require_once "database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$messages = new Messages(Database::getConnection());

$response = $messages->getMessage();

echo json_encode([
    'status' => $response[0],  // 200 if Ok or 400 if not
    'message' => $response[1] // the error message
]);
?>