<?php
// Database connection parameters
$host = "localhost";
$dbname = "pharmacy"; 
$username = "root";
$password = "root"; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Define the low stock threshold
$seuil_stock_bas = 10;

// Query to retrieve products whose stock is less than or equal to the threshold
$query = "SELECT name, quantity FROM Product WHERE quantity <= :seuil";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":seuil", $seuil_stock_bas, PDO::PARAM_INT);
$stmt->execute();
$produits_en_risque = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($produits_en_risque)) {
    // building the warning message
    $message = "⚠️ Attention, les produits suivants sont en stock bas :\n\n";
    foreach ($produits_en_risque as $produit) {
        $message .= "- " . htmlspecialchars($produit['name']) . " : " . $produit['quantity'] . " restant(s)\n";
    }
    
    //  Send an e-mail alert
    $to = "votre@email.com"; // Modify with target e-mail
    $subject = "Alerte Stock Produits";
    $headers = "From: pharmacie@votre-site.com\r\n";
    
    if (mail($to, $subject, $message, $headers)) {
        echo "✅ Alerte envoyée avec succès.";
    } else {
        echo "❌ Erreur lors de l'envoi de l'alerte.";
    }
} else {
    echo "✅ Aucun produit en stock .";
}
?>
