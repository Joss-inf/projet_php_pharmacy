<?php
session_start();
$host = "localhost";
$dbname = "pharmacy";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("<p style='color: red;'>Erreur de connexion : " . $e->getMessage() . "</p>");
}

$seuil_stock_bas = 10;
$query = "SELECT name, quantity FROM Product WHERE quantity <= :seuil";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":seuil", $seuil_stock_bas, PDO::PARAM_INT);
$stmt->execute();
$produits_en_risque = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerte Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center h-screen bg-gray-100 p-4">
    <h2 class="text-2xl font-bold text-gray-800">Alerte Stock</h2>
    <?php if (!empty($produits_en_risque)): ?>
        <p class="text-red-600 mt-4">⚠️ Attention, les produits suivants sont en stock bas :</p>
        <ul class="mt-2 p-4 bg-white shadow-md rounded-lg">
            <?php foreach ($produits_en_risque as $produit): ?>
                <li class="text-gray-700">- <?= htmlspecialchars($produit['name']) ?> : <?= $produit['quantity'] ?> restant(s)</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-green-600 mt-4">✅ Aucun produit en stock bas.</p>
    <?php endif; ?>
    <a href="dashboard.php" class="mt-6 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Retour au tableau de bord</a>
</body>
</html>
