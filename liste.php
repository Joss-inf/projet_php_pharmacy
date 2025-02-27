<?php
// Inclure le fichier de connexion à la base de données
require_once 'db_connect.php'; // Assurez-vous que ce fichier contient la connexion à la base de données

// Vérifier si la connexion est bien établie
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Exécuter la requête SQL
$sql = "SELECT p.id, p.name, p.description, t.type, p.quantity, p.need_prescription 
        FROM Product p
        JOIN ProductType t ON p.id_type = t.id";

$result = $conn->query($sql);

if (!$result) {
    die("Erreur dans la requête SQL : " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Liste des Produits</h2>
    <a href="add_product.php">➕ Ajouter un produit</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Type</th>
            <th>Quantité</th>
            <th>Prescription</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['type']) ?></td>
                <td><?= htmlspecialchars($row['quantity']) ?></td>
                <td><?= $row['need_prescription'] ? 'Oui' : 'Non' ?></td>
                <td>
                    <a href="edit_product.php?id=<?= htmlspecialchars($row['id']) ?>">✏️ Modifier</a>
                    <a href="delete_product.php?id=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">🗑️ Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
