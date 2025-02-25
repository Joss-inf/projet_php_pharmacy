<?php 
require "header/header.php";
require "database.php"; // Connexion à la base de données

// Fonction pour récupérer la latitude et la longitude avec OpenStreetMap (Nominatim)
function getCoordinates($address) {
    $url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($address) . "&format=json&limit=1";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0"); // Nominatim requiert un User-Agent
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (!empty($data)) {
        return [
            "lat" => floatval($data[0]['lat']),
            "lon" => floatval($data[0]['lon'])
        ];
    } else {
        return ["lat" => null, "lon" => null];
    }
}

// Récupérer les pharmacies depuis la base de données
$sql = "SELECT name, address FROM Pharmacy";
$result = $conn->query($sql);

$pharmacy_data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $coords = getCoordinates($row['address']);
        if ($coords['lat'] !== null && $coords['lon'] !== null) {
            $pharmacy_data[] = [
                "name" => $row['name'],
                "lat" => $coords['lat'],
                "lon" => $coords['lon'],
                "address" => $row['address']
            ];
        }
    }
} else {
    echo "<p style='color:red; text-align:center;'>⚠️ Aucune pharmacie trouvée dans la base de données !</p>";
}

// Convertir en JSON pour JavaScript
$pharmacy_json = json_encode($pharmacy_data);

?>

<body class="bg-gray-100 text-gray-900">
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-center mb-4">Carte des Pharmacies de Paris</h2>
    <div id="map" class="w-full h-[500px] rounded-lg shadow-lg"></div>
</div>

<script>
    var map = L.map('map').setView([48.841, 2.298], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Charger les pharmacies dynamiquement depuis PHP
    var pharmacies = <?php echo $pharmacy_json; ?>;
    
    console.log("Données des pharmacies:", pharmacies); // Vérification des données dans la console

    if (pharmacies.length === 0) {
        alert("⚠️ Aucune pharmacie trouvée. Vérifie la base de données.");
    }

    pharmacies.forEach(pharma => {
        L.marker([pharma.lat, pharma.lon])
            .addTo(map)
            .bindPopup(`<b>${pharma.name}</b><br>${pharma.address}`);
    });
</script>

<?php 

require "footer/footer.php";

?>