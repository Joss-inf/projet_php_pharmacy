<?php
session_start();

require "database.php";
require "Message.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['pharmacy_id'])) {
        echo json_encode(["success" => false, "error" => "Utilisateur non connecté."]);
        alerte("utilisateur non connecté");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $pharmacy_id = $_SESSION['pharmacy_id'];
    $message = trim($_POST['message'] ?? '');

    if (empty($message)) {
        echo json_encode(["success" => false, "error" => "Le message ne peut pas être vide."]);
        exit;
    }

    $messages = new Messages($pdo);
    $result = $messages->postMessage($user_id, $pharmacy_id, $message);

    if ($result[0] === 200) {
        echo json_encode(["success" => true, "message" => "Message envoyé avec succès."]);
    } else {
        echo json_encode(["success" => false, "error" => $result[1]]);
    }
    exit;
} else {
    echo json_encode(["success" => false, "error" => "Méthode non autorisée."]);
    exit;
}

