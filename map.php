<?php 

require "header/header.php";  // Include the header
require "database.php";       // Include the database connection

$conn = Database::getConnection(); // Establish database connection

// Function to get latitude and longitude from an address using OpenStreetMap API
function getCoordinates($address) {
    $url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($address) . "&format=json&limit=1";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0"); // Identify the request to the API
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (!empty($data)) {
        return [
            "lat" => floatval($data[0]['lat']),
            "lon" => floatval($data[0]['lon'])
        ];
    } else {
        return ["lat" => null, "lon" => null]; // Return null values if no coordinates are found
    }
}

// Fetch pharmacy names and addresses from the database
$sql = "SELECT name, address FROM Pharmacy";
$stmt = $conn->prepare($sql);
$stmt->execute();
$pharmacies = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pharmacy_data = [];

if (!empty($pharmacies)) {
    foreach ($pharmacies as $pharma) {
        $coords = getCoordinates($pharma['address']); // Get latitude and longitude
        if ($coords['lat'] !== null && $coords['lon'] !== null) {
            $pharmacy_data[] = [
                "name" => $pharma['name'],
                "lat" => $coords['lat'],
                "lon" => $coords['lon'],
                "address" => $pharma['address']
            ];
        }
    }
} else {
    echo "<p style='color:red; text-align:center;'>⚠️ No pharmacies found in the database!</p>";
}

$pharmacy_json = json_encode($pharmacy_data); // Convert pharmacy data to JSON format

?>

<body class="bg-gray-100 text-gray-900">
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-center mb-4">Map of Pharmacies in Paris</h2>
    <div id="map" class="w-full h-[500px] rounded-lg shadow-lg"></div>
</div>

<script>
    // Initialize the map centered around Paris
    var map = L.map('map').setView([48.841, 2.298], 14);

    // Load OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Load pharmacy data from PHP into JavaScript
    var pharmacies = <?php echo $pharmacy_json; ?>;
    
    console.log("Pharmacy data:", pharmacies); // Log data to console for debugging

    if (pharmacies.length === 0) {
        alert("⚠️ No pharmacies found. Check the database.");
    }

    // Add markers for each pharmacy on the map
    pharmacies.forEach(pharma => {
        L.marker([pharma.lat, pharma.lon])
            .addTo(map)
            .bindPopup(`<b>${pharma.name}</b><br>${pharma.address}`);
    });
</script>

<?php 

require "footer/footer.php"; // Include the footer

?>
