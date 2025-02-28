<!DOCTYPE html>
<html>
<head>
    <title>Pharmacy</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body class="bg-gray-100">
<!-- Header section with dark background and white text -->
<header class="bg-gray-800 text-white py-4 relative">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-4">
        <!-- Site logo/name linked to the homepage -->
        <a href="index.php" class="text-2xl font-bold mb-4 md:mb-0">Pharmacy</a>

        <!-- Navigation menu centered horizontally using absolute positioning -->
        <nav class="md:absolute md:left-1/2 md:transform md:-translate-x-1/2 mb-4 md:mb-0">
            <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6">
                <!-- Home link -->
                <li><a href="index.php" class="hover:text-gray-300">Accueil</a></li>
                <!-- About link -->
                <li><a href="aboutus.php" class="hover:text-gray-300">À propos</a></li>
                <!-- Contact link -->
                <li><a href="contact.php" class="hover:text-gray-300">Contact</a></li>
            </ul>
        </nav>

        <!-- Icons container for search, profile, and shopping cart -->
        <div class="flex space-x-4">
            <!-- Search icon -->
            <a href="search.php" class="hover:text-gray-300">
                <i class="fas fa-magnifying-glass"></i>
            </a>
            <!-- Profile icon -->
            <?php
            session_start(); // Démarre la session

            // Vérifie si l'utilisateur est connecté (par exemple, on suppose que 'user_id' existe dans $_SESSION)
            $isConnected = isset($_SESSION['user_id']);
            ?>

            <!-- Si l'utilisateur est connecté, on affiche le lien vers card.php, sinon on affiche le lien vers login.php -->
            <?php if ($isConnected): ?>
                <a href="card.php" class="hover:text-gray-300">
                    <i class="fas fa-user"></i>
                </a>
                <a href="message.php" class="hover:text-gray-300">
                    <i class="fa-solid fa-comment"></i>
                </a>
            <?php else: ?>
                <a href="login.php" class="hover:text-gray-300">Connexion</a>
            <?php endif; ?>

            <!-- Shopping cart icon -->
            <a href="card.php" class="hover:text-gray-300">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>
    </div>
</header>