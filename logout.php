<?php
require_once 'databaseprofile.php';

session_start();

session_unset();

session_destroy();

header('Location: login.php');

$db = Database::getInstance();
$conn = $db->closeConnection();


exit();
?>
