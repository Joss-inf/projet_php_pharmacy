<?php 
require "header/header.php";
require "database.php"; // Include the database connection

$pdo = Database::getConnection();

// Check if a pharmacy ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p class='text-red-500 text-center mt-10'>⚠️ No pharmacy selected.</p>";
    exit;
}

$pharmacy_id = intval($_GET['id']);

// Fetch pharmacy details
$sql = "SELECT * FROM Pharmacy WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$pharmacy_id]);
$pharmacy = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pharmacy) {
    echo "<p class='text-red-500 text-center mt-10'>⚠️ Pharmacy not found.</p>";
    exit;
}

// Get latitude and longitude from address
function getCoordinates($address) {
    $url = "https://nominatim.openstreetmap.org/search?q=10+Rue+de+Rivoli,+75004+Paris,+France&format=json&limit=1" . urlencode($address) . "&format=json&limit=1";

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

$coords = getCoordinates($pharmacy['address']);
?>

<body class="bg-gray-100 min-h-screen">
    
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">🏥 <?= htmlspecialchars($pharmacy['name']) ?></h1>
        
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <p class="text-gray-600"><strong>📍 Address:</strong> <?= htmlspecialchars($pharmacy['address']) ?></p>
            <p class="text-gray-500"><strong>🗺️ Department:</strong> <?= htmlspecialchars($pharmacy['department']) ?></p>
            <p class="text-gray-500"><strong>📞 Phone:</strong> <?= htmlspecialchars($pharmacy['phone']) ?></p>
            <p class="text-gray-500"><strong>📧 Email:</strong> <?= htmlspecialchars($pharmacy['email']) ?></p>
            <p class="text-gray-500"><strong>🌍 Country:</strong> <?= htmlspecialchars($pharmacy['country']) ?></p>
            <p class="text-gray-700 mt-4"><strong>ℹ️ Description:</strong> <?= nl2br(htmlspecialchars($pharmacy['description'])) ?></p>
            
            <p class="mt-4 <?= $pharmacy['is_valid'] ? 'text-green-600' : 'text-red-600' ?>">
                <?= $pharmacy['is_valid'] ? '✅ Validated' : '❌ Not validated' ?>
            </p>
        </div>
        
        <!-- Map Section -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">📍 Location</h2>
            <div id="map" class="w-full h-[500px] rounded-lg shadow-lg"></div>
        </div>

        <script>
            var map = L.map('map').setView([<?= $coords['lat'] ?? 48.8566 ?>, <?= $coords['lon'] ?? 2.3522 ?>], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            <?php if ($coords['lat'] !== null && $coords['lon'] !== null): ?>
                L.marker([<?= $coords['lat'] ?>, <?= $coords['lon'] ?>])
                    .addTo(map)
                    .bindPopup("<b><?= htmlspecialchars($pharmacy['name']) ?></b><br><?= htmlspecialchars($pharmacy['address']) ?>")
                    .openPopup();
            <?php endif; ?>
        </script>
        
        <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="search.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">⬅ Back to Search</a>
        </div>
    </div>
<?php require "footer/footer.php";?>