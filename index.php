<?php 

// Include the header file for the page layout
require "header/header.php";  

// Include the database connection file to interact with the database
require "database.php";       

// Establish a connection to the database using the singleton pattern
$pdo = Database::getConnection(); 

// Fetch all product types from the database for the dropdown menu
$typeQuery = $pdo->query("SELECT * FROM ProductType"); 
$productTypes = $typeQuery->fetchAll(PDO::FETCH_ASSOC);

// Initialize search parameters
$search = "";
$id_type = "";
$need_prescription = "";

// Construction de la requête SQL pour récupérer tous les produits
$sql = "SELECT Product.*, ProductType.type, COALESCE(PharmacyProduct.price, 'Non disponible') AS price 
        FROM Product
        INNER JOIN ProductType ON Product.id_type = ProductType.id
        LEFT JOIN PharmacyProduct ON Product.id = PharmacyProduct.product_id
        WHERE 1=1"; // Toujours vrai pour récupérer tous les produits

$params = [];

// Appliquer les filtres uniquement si l'utilisateur effectue une recherche
if (!empty($_GET)) {
    $search = htmlspecialchars($_GET['search'] ?? '');
    $id_type = $_GET['id_type'] ?? '';
    $need_prescription = $_GET['need_prescription'] ?? '';

    if (!empty($search)) {
        $sql .= " AND Product.name LIKE ?";
        $params[] = "%$search%";
    }

    if (!empty($id_type)) {
        $sql .= " AND Product.id_type = ?";
        $params[] = $id_type;
    }

    if ($need_prescription !== "") { 
        $sql .= " AND Product.need_prescription = ?";
        $params[] = $need_prescription;
    }
}

// Préparer et exécuter la requête SQL
$query = $pdo->prepare($sql);
$query->execute($params);
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<body class="bg-gray-100 min-h-screen">
    
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Recherche de Médicaments</h1>
        
        <form method="GET" action="index.php" class="mb-6 bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <!-- Champ de recherche -->
                <input type="text" name="search" value="<?= $search ?>" placeholder="Nom du médicament..."
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-0 focus:border-green-600">

                <!-- Filtre par type de produit -->
                <select name="id_type" class="w-full p-2 border rounded-md focus:border-green-600 focus:ring-0 focus:outline-none">
                    <option value="">Tous les types</option>
                    <?php foreach ($productTypes as $type) : ?>
                        <option value="<?= $type['id'] ?>" <?= ($id_type == $type['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($type['type']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Filtre par nécessité d'ordonnance -->
                <div class="flex space-x-4 items-center">
                    <label class="flex items-center">
                        <input type="radio" name="need_prescription" value="" <?= ($need_prescription === "") ? 'checked' : '' ?> class="mr-2 accent-green-600 focus:ring-0 focus:outline-none">
                        Tous
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="need_prescription" value="1" <?= ($need_prescription === "1") ? 'checked' : '' ?> class="mr-2 accent-green-600 focus:ring-0 focus:outline-none">
                        Nécessite une ordonnance
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="need_prescription" value="0" <?= ($need_prescription === "0") ? 'checked' : '' ?> class="mr-2 accent-green-600 focus:ring-0 focus:outline-none">
                        En vente libre
                    </label>
                </div>
            </div>

            <!-- Bouton de recherche -->
            <button type="submit"
                class="w-full bg-green-600 text-white p-2 mt-4 rounded-md hover:bg-green-700 transition">
                🔍 Rechercher
            </button>
        </form>

        <!-- Résultats de la recherche -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">🛒 Résultats</h2>
            
            <?php if (!empty($products)) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($products as $product) : ?>
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <h3 class="text-lg font-bold"><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="text-gray-500"><strong>Type:</strong> <?= htmlspecialchars($product['type']) ?></p>
                            <p class="text-gray-700"><strong>Description:</strong> <?= nl2br(htmlspecialchars($product['description'])) ?></p>
                            <p class="mt-2 <?= $product['need_prescription'] ? 'text-red-600' : 'text-green-600' ?>">
                                <?= $product['need_prescription'] ? '❌ Nécessite une ordonnance' : '✅ En vente libre' ?>
                            </p>
                            <p class="text-green-600 font-semibold mt-2">
                                💰 Prix: <?= htmlspecialchars($product['price']) ?> €
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="text-red-500 text-center">⚠️ Aucun médicament trouvé.</p>
            <?php endif; ?>
        </div>

    </div>

<?php require "footer/footer.php"; ?>
