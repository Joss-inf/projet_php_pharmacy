<?php
session_start();
require_once 'User.php';
require_once 'database.php';
require_once 'validators.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$postData = json_decode(file_get_contents('php://input'), true);
// Récupération des données
$password = $postData['password'] ?? '';
$vpassword =  $postData['vpassword'] ?? '';
$email = $postData['email'] ?? '';
$vemail = $postData['vemail'] ?? '';


if(!validateEmail($email)){
    $res = [400,"Format incorrect d' email"];
    echo json_encode(['succes' => 'succes', 'message'=> $res]);
    exit;
}

if($email != $vemail ){
    $res = [400,'Les emails ne correspondent pas'];
    echo json_encode(['succes' => 'succes', 'message'=> $res]);
    exit;
}

if(!validatePassword($password)){
    $res = [400,getPasswordError($password)];
    echo json_encode(['succes' => 'succes', 'message'=> $res]);
    exit;
}

if($password != $vpassword){
    $res = [400,'les mots de passes ne sont pas identiques'];
    echo json_encode(['succes' => 'succes', 'message'=> $res]);
    exit;
}

$u = new User(Database::getConnection());
$res = $u -> register($email,$password);
if($res[0]  == 200 ){
    $resp = $u -> login($email,$password);

    if($resp[0] == 200){
        $user = $resp[2];
        $_SESSION['user_id'] = $user['id'] ?? '';
        $_SESSION['email'] = $user ['email']?? '';
        $_SESSION['role'] = $user ['role']?? '';
        $_SESSION['pharmacy_id'] = $user['pharmacy_id'] ?? '';
        echo json_encode(['succes' => 200, 'message'=> $resp]);
exit;
    }
    if($resp[0] == 400){
        echo json_encode(['succes' => 400, 'message'=> $resp]);
        exit;
    }
}
echo json_encode(['succes' => 400, 'message'=> $res]);
        exit;
}