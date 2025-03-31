<?php 

require "header/header.php";  // Include the header file
require "database.php";       // Include the database connection file

$pdo = Database::getConnection(); // Establish database connection

// Initialize search parameters
$search = "";

// Construct the SQL query to fetch all pharmacies or filtered results
$sql = "SELECT * FROM Pharmacy";
$params = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $sql .= " WHERE name LIKE ? OR address LIKE ? OR department LIKE ?";
    $params = ["%$search%", "%$search%", "%$search%"];
}

// Prepare and execute the query
$query = $pdo->prepare($sql);
$query->execute($params);
$pharmacies = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<body class="bg-gray-100 min-h-screen">
    
    <!-- Main container -->
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Recherche de Pharmacies</h1>
        
        <!-- Search form -->
        <form method="GET" action="search.php" class="mb-6 bg-white p-6 rounded-lg shadow-lg">
            <input type="text" name="search" value="<?= $search ?>" placeholder="Recherche par nom de pharmacie, adresse ou département..."
                class="w-full p-2 border rounded-md focus:outline-none focus:ring-0 focus:border-green-600">
            
            <!-- Submit button -->
            <button type="submit"
                class="w-full bg-green-600 text-white p-2 mt-4 rounded-md hover:bg-blue-600 transition">
                🔍 Rechercher
            </button>
        </form>

        <!-- Search results -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Results:</h2>
            <?php if (count($pharmacies) > 0): ?>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($pharmacies as $pharmacy): ?>
                        <li class="border p-4 rounded-md bg-gray-50 shadow-md">
                            <strong class="text-lg"><a href='pharmacy.php?id=<?= htmlspecialchars($pharmacy["id"]) ?>' class='text-green-600 hover:underline'>🏥 <?= htmlspecialchars($pharmacy['name']) ?></a></strong>
                            <p class="text-gray-600">📍 <?= htmlspecialchars($pharmacy['address']) ?></p>
                            <p class="text-gray-500">🗺️ Department: <span class="font-semibold"><?= htmlspecialchars($pharmacy['department']) ?></span></p>
                            <p class="text-gray-500">📞 Contact: <span class="font-semibold"><?= htmlspecialchars($pharmacy['phone']) ?></span></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-red-500">No pharmacies found.</p>
            <?php endif; ?>
        </div>
    </div>

<?php require "footer/footer.php"; ?>