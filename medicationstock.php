<?php
session_start();

$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "root";
$base_de_donnees = "pharmacy";

$conn = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

if ($conn->connect_error) {
    die("<p class='text-red-600'>Erreur de connexion : " . $conn->connect_error . "</p>");
}

$pharmacy_id = 1;
$sql = "SELECT p.name, pp.quantity FROM PharmacyProduct pp JOIN Product p ON pp.product_id = p.id WHERE pp.pharmacy_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pharmacy_id);
$stmt->execute();
$resultat = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock de Médicaments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Stock de Médicaments</h2>
    <table class="w-full max-w-lg bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="py-2 px-4">Médicament</th>
                <th class="py-2 px-4">Quantité</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php while ($ligne = $resultat->fetch_assoc()): ?>
                <tr class="border-b">
                    <td class="py-2 px-4 text-center"><?= htmlspecialchars($ligne['name']) ?></td>
                    <td class="py-2 px-4 text-center"><?= intval($ligne['quantity']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="mt-6 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Retour au tableau de bord</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
