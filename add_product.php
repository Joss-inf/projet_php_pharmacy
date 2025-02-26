<?php

// Retrieve product types for form
$result = $conn->query("SELECT * FROM ProductType");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id_type = $_POST['id_type'];
    $quantity = $_POST['quantity'];
    $need_prescription = isset($_POST['need_prescription']) ? 1 : 0;

    $sql = "INSERT INTO Product (name, description, id_type, quantity, need_prescription) 
            VALUES ('$name', '$description', $id_type, $quantity, $need_prescription)";

    if ($conn->query($sql) === TRUE) {
        echo "Produit ajouté avec succès.";
    } else {
        echo "Erreur : " . $conn->error;
    }
}
?>

<h2>Ajouter un Produit</h2>
<form method="POST">
    Nom: <input type="text" name="name" required><br>
    Description: <textarea name="description"></textarea><br>
    Type: 
    <select name="id_type" required>
        <?php while ($row = $result->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= $row['type'] ?></option>
        <?php endwhile; ?>
    </select><br>
    Quantité: <input type="number" name="quantity" required><br>
    Prescription requise ? <input type="checkbox" name="need_prescription"><br>
    <button type="submit">Ajouter</button>
</form>
