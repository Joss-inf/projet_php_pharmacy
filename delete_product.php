<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Product WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Produit supprimé.";
    } else {
        echo "Erreur : " . $conn->error;
    }
}
?>
<a href="index.php">Retour</a>
