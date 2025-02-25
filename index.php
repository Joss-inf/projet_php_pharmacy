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
$products = [];

// Check if any search filters are applied by the user
if (isset($_GET['search']) || isset($_GET['id_type']) || isset($_GET['need_prescription'])) {
    $search = htmlspecialchars($_GET['search'] ?? '');
    $id_type = $_GET['id_type'] ?? '';
    $need_prescription = $_GET['need_prescription'] ?? '';

    // Construct the SQL query to fetch filtered products based on search criteria
    $sql = "SELECT Product.*, ProductType.type 
            FROM Product 
            INNER JOIN ProductType ON Product.id_type = ProductType.id
            WHERE 1=1"; // Always true to dynamically append filters

    $params = [];

    // Apply the search filter if the user has entered a search term
    if (!empty($search)) {
        $sql .= " AND Product.name LIKE ?";
        $params[] = "%$search%";
    }

    // Apply the product type filter if selected
    if (!empty($id_type)) {
        $sql .= " AND Product.id_type = ?";
        $params[] = $id_type;
    }

    // Apply the prescription requirement filter if selected
    if ($need_prescription !== "") { 
        $sql .= " AND Product.need_prescription = ?";
        $params[] = $need_prescription;
    }

    // Prepare the SQL statement to avoid SQL injection
    $query = $pdo->prepare($sql);
    
    // Execute the prepared SQL statement with the provided parameters
    $query->execute($params);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<body class="bg-gray-100 min-h-screen">
    
    <!-- Search form at the top of index.php -->
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Recherche de Médicaments</h1>
        
        <form method="GET" action="index.php" class="mb-6 bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <!-- Text input field for users to enter the medication name for search -->
                <input type="text" name="search" value="<?= $search ?>" placeholder="Nom du médicament..."
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">

                <!-- Dropdown menu to allow users to filter by medication type -->
                <select name="id_type" class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                    <option value="">Tous les types</option>
                    <?php foreach ($productTypes as $type) : ?>
                        <option value="<?= $type['id'] ?>" <?= ($id_type == $type['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($type['type']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Radio buttons to filter medications based on prescription requirement -->
                <div class="flex space-x-4 items-center">
                    <label class="flex items-center">
                        <input type="radio" name="need_prescription" value="" <?= ($need_prescription === "") ? 'checked' : '' ?> class="mr-2">
                        Tous
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="need_prescription" value="1" <?= ($need_prescription === "1") ? 'checked' : '' ?> class="mr-2">
                        Nécessite une ordonnance
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="need_prescription" value="0" <?= ($need_prescription === "0") ? 'checked' : '' ?> class="mr-2">
                        En vente libre
                    </label>
                </div>
            </div>

            <!-- Submit button to trigger the search request -->
            <button type="submit"
                class="w-full bg-blue-500 text-white p-2 mt-4 rounded-md hover:bg-blue-600 transition">
                🔍 Rechercher
            </button>
        </form>
    </div>

<?php require "footer/footer.php"; ?>
