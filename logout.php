<?php
require_once 'database.php';
require_once 'User.php';

$u = new User(Database::getConnection());
$u -> clearSession();
Database::closeConnection();
echo'disconnected';
exit;