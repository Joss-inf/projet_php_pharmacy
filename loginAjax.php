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

    $user=$res[2];
    $_SESSION['user_id'] = $user ['id'] ?? '';
    $_SESSION['email'] = $user ['email']?? '';
    $_SESSION['role'] = $user ['role']?? '';
    $_SESSION['id_pharmacy'] = $user['pharmacy_id'] ?? '';
    $msg = [$res[0],$res[1]];
    echo json_encode(['succes' => 'succes', 'message'=> $msg]);
}else{
    echo json_encode(['succes' => 'succes', 'message'=> $res]);
}
exit;
}