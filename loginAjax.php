<?php
session_start();
require_once 'User.php';
require_once 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$postData = json_decode(file_get_contents('php://input'), true);
// Récupération des données
$password = $postData['password'] ?? '';
$email = $postData['email'] ?? '';
$u = new User(Database::getConnection());
$res = $u -> login($email,$password);
if($res[0] == 200){

    $user = $res[2];
    $_SESSION['user_id'] = $user['id'] ?? '';
    $_SESSION['email'] = $user ['email']?? '';
    $_SESSION['role'] = $user ['role']?? '';
    $_SESSION['pharmacy_id'] = $user['pharmacy_id'] ?? '';
    $msg = $res[1];
    echo json_encode(['succes' => 200,'message'=> $msg]);
}else{
    echo json_encode(['succes' => 400, 'message'=> $res]);
}
exit;
}