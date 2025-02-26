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
if(!isset($res[3]) && $res[0] == 200){

    $_SESSION['user_id'] = $res ['id'] ?? '';
    $_SESSION['email'] = $res ['email']?? '';
    $_SESSION['role'] = $res ['role']?? '';
    $_SESSION['id_pharmacy'] = $res['pharmacy_id'] ?? '';
    $msg = [$res[0],$res[1]];
    echo json_encode(['succes' => 'succes', 'message'=> $msg]);
}else{
    echo json_encode(['succes' => 'succes', 'message'=> $res]);
}
exit;
}