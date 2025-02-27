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

// Récupérer les types de médicaments pour le menu déroulant
$result = $conn->query("SELECT * FROM ProductType");
$types = $result->fetch_all(MYSQLI_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $quantity = (int)$_POST['quantity'];
    $need_prescription = isset($_POST['need_prescription']) ? 1 : 0;

    // Vérifier si un nouveau type a été ajouté
    if (!empty($_POST['new_type'])) {
        $new_type = $conn->real_escape_string($_POST['new_type']);
        $conn->query("INSERT INTO ProductType (type) VALUES ('$new_type')");
        $id_type = $conn->insert_id; // Récupérer l'ID du nouveau type
    } else {
        $id_type = (int)$_POST['id_type'];
    }

    // Insertion des données dans la base
    $sql = $conn->prepare("INSERT INTO Product (name, description, id_type, quantity, need_prescription) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("ssiii", $name, $description, $id_type, $quantity, $need_prescription);
    
    if ($sql->execute()) {
        echo "<p class='text-center text-green-600 font-bold'>✅ Produit ajouté avec succès.</p>";
    } else {
        echo "<p class='text-center text-red-600 font-bold'>❌ Erreur : " . $sql->error . "</p>";
    }
    
    $sql->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-4xl mx-auto my-16 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-5xl font-bold text-center text-gray-800 mb-2">Ajouter un Produit</h1>
        <h3 class="text-1xl text-center text-gray-800 mb-5">Remplissez les champs ci-dessous pour ajouter un nouveau produit.</h3>
        
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom:</label>
                <input type="text" name="name" required class="w-full p-3 border border-gray-300 rounded-xl focus:ring focus:ring-green-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea name="description" class="w-full p-3 border border-gray-300 rounded-xl focus:ring focus:ring-green-300"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Type de médicament:</label>
                <select name="id_type" required class="w-full p-3 border border-gray-300 rounded-xl focus:ring focus:ring-green-300">
                    <?php foreach ($types as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['type']) ?></option>
                    <?php endforeach; ?>
                    <option value="other">Autre</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantité:</label>
                <input type="number" name="quantity" required class="w-full p-3 border border-gray-300 rounded-xl focus:ring focus:ring-green-300">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="need_prescription" class="mr-2">
                <label class="text-sm text-gray-700">Prescription requise ?</label>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-xl hover:bg-green-700 transition duration-300">Ajouter</button>
        </form>
    </div>
</body>
</html>

<?php 
require "footer/footer.php";
?>
