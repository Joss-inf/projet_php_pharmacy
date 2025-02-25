<!DOCTYPE html>
<html>
<head>
    <title>Pharmacy</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body class="bg-gray-100">
<!-- Header section with dark background and white text -->
<header class="bg-gray-800 text-white py-4 relative">
    <!-- Container to center the content and set spacing -->
    <div class="container mx-auto flex justify-between items-center px-4">
      <!-- Site logo/name linked to the homepage -->
      <a href="index.php" class="text-2xl font-bold">Pharmacy</a>

      <!-- Navigation menu centered horizontally using absolute positioning -->
      <nav class="absolute left-1/2 transform -translate-x-1/2">
        <ul class="flex space-x-6">
          <!-- Home link -->
          <li><a href="index.php" class="hover:text-gray-300">Accueil</a></li>
          <!-- About link -->
          <li><a href="about.php" class="hover:text-gray-300">À propos</a></li>
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
        <a href="profil.php" class="hover:text-gray-300">
          <i class="fas fa-user"></i>
        </a>
        <!-- Shopping cart icon -->
        <a href="panier.php" class="hover:text-gray-300">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </div>
    </div>
  </header>