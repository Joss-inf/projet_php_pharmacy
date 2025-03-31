<?php
require_once 'BoardRequest.php';
require_once 'database.php';
// Instancier la classe Board
$board = new Board(Database::getConnection());


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'getPharmacies') {
        $message = $board->getPharmacies();
        echo json_encode(['code' => $message[0], 'message' => $message[1]]);
        exit;
    }
    if (isset($_GET['action']) && $_GET['action'] === 'getUsers') {
        $message = $board->getUsers();
        echo json_encode(['code' => $message[0], 'message' => $message[1]]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajouter une pharmacie
    if (isset($_POST['action']) && $_POST['action'] === 'addPharmacy') {
        if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['country'], $_POST['department'], $_POST['is_valid'], $_POST['description'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $country = $_POST['country'];
            $department = $_POST['department'];
            $is_valid = $_POST['is_valid'];
            $description = $_POST['description'];

            list($code, $message) = $board->addPharmacy($name, $email, $phone, $address, $country, $department, $is_valid, $description);
            echo json_encode(['code' => $code, 'message' => $message]);
            exit;
        }
    }

    // Supprimer une pharmacie
    if (isset($_POST['action']) && $_POST['action'] === 'deletePharmacy') {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            list($code, $message) = $board->deletePharmacy($id);
            echo json_encode(['code' => $code, 'message' => $message]);
            exit;
        }
    }
}
?>
