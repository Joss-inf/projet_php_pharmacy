<?php
session_start();

require "database.php";
require "Message.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$messages = new Messages(Database::getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    $user_id = $_SESSION['user_id']; 
    $pharmacy_id = 1;
    
    $response = $messages->postMessage($user_id, $pharmacy_id, $message);
    
    echo json_encode([
        'status' => $response[0],  // 200 if Ok or 400 if not
        'message' => $response[1] // the error message
    ]);
}
?>