<?php 
require "header/header.php";

// Connexion à la base de données
$host = "localhost";
$dbname = "pharmacy";
$username = "root";
$password = "root";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifier si une suppression a été demandée
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $conn->query("DELETE FROM Product WHERE id = $delete_id");
    header("Location: delete_product.php"); // Redirection après suppression
    exit();
}

// Récupérer la liste des produits existants
$products_result = $conn->query("SELECT Product.id, Product.name, ProductType.type FROM Product INNER JOIN ProductType ON Product.id_type = ProductType.id");
$products = $products_result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Produit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-4xl mx-auto my-16 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-5xl font-bold text-center text-gray-800 mb-2">Supprimer un Produit</h1>
        <h3 class="text-1xl text-center text-gray-800 mb-5">Cliquez sur un produit pour le supprimer définitivement.</h3>
        
        <ul class="space-y-4">
            <?php foreach ($products as $product): ?>
                <li class="flex justify-between items-center p-3 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-300 active:bg-gray-400 shadow-sm transition duration-200" onclick="window.location.href='?delete_id=<?= $product['id'] ?>'">
                    <span><?= htmlspecialchars($product['name']) ?> (<?= htmlspecialchars($product['type']) ?>)</span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>

<?php 
require "footer/footer.php";
?>
