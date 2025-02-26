<?php
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
echo json_encode(['succes' => 'succes', 'message'=> $res]);
exit;
}