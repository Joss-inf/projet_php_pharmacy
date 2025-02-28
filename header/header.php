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
<body class="bg-gray-100  overflow-x-hidden">
<!-- Header section with dark background and white text -->
<header class="bg-gray-800 text-white py-4 relative">
    <div class="container mx-auto flex justify-between items-center px-4">
        <!-- Logo / Nom de site -->
        <a href="index.php" class="text-2xl font-bold">Pharmacy</a>

        <!-- Menu Burger pour mobile -->
        <div class="lg:hidden flex items-center space-x-4">
            <button id="menu-toggle" class="text-white">
                <i class="fas fa-bars"></i> <!-- Menu Burger -->
            </button>
        </div>

        <!-- Navigation -->
        <nav class="hidden lg:flex space-x-6 items-center"> <!-- Utilisation lg:hidden pour cacher sur mobile -->
            <ul class="flex space-x-6">
                <li><a href="index.php" class="hover:text-gray-300">Accueil</a></li>
                <!-- About link -->
                <li><a href="aboutus.php" class="hover:text-gray-300">À propos</a></li>
                <!-- Contact link -->
                <li><a href="contact.php" class="hover:text-gray-300">Contact</a></li>
                <?php
                session_start();
                $isAdm = isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 3;
                ?>
                <?php if($isAdm): ?>
                <li><a href="dashboard.php" class="hover:text-gray-300">Page Admin</a></li>
                <?php endif; ?>
            </ul>

            <!-- Icons de profil et panier -->
            <div class="flex space-x-4">
              <?php 
              $isStaff = false;
              $isgraded = isset($_SESSION['user_id'] )&& isset($_SESSION['role']) ;
              if( $isgraded && $_SESSION['role'] == 1 ||  $isgraded && $_SESSION['role'] == 2 ||  $isgraded && $_SESSION['role'] == 3  ){
                $isStaff = true;
              }
              ?>
              <?php if($isStaff): ?>
                <a href="message.php" class="hover:text-gray-300">
                  <i class="fas fa-comment-dots"></i>
                </a>
                <?php endif; ?>
                <a href="search.php" class="hover:text-gray-300">
                    <i class="fas fa-magnifying-glass"></i>
                </a>
                <?php
                $isConnected = isset($_SESSION['user_id']);
                ?>
                <?php if ($isConnected): ?>
                    <a href="profil.php" class="hover:text-gray-300">
                        <i class="fas fa-user"></i>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="hover:text-gray-300">Connexion</a>
                <?php endif; ?>
                <a href="card.php" class="hover:text-gray-300">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </nav>
    </div>

    <!-- Menu burger pour mobile -->
    <div id="mobile-menu" class="lg:hidden hidden bg-gray-800 text-white py-4 absolute top-16 left-0 right-0">
        <ul class="flex flex-col items-center space-y-4">
            <li><a href="index.php" class="hover:text-gray-300">Accueil</a></li>
            <li><a href="about.php" class="hover:text-gray-300">À propos</a></li>
            <li><a href="contact.php" class="hover:text-gray-300">Contact</a></li>
            <?php if($isAdm): ?>
                <li><a href="dashboard.php" class="hover:text-gray-300">Page Admin</a></li>
                <?php endif; ?>

                <?php if($isStaff): ?>
                <li><a href="message.php" class="hover:text-gray-300">messagerie</a></li>
                <?php endif; ?>
            <li><a href="search.php" class="hover:text-gray-300">Recherche</a></li>
            <?php if ($isConnected): ?>
                <li><a href="profile.php" class="hover:text-gray-300">Mon Profil</a></li>
            <?php else: ?>
                <li><a href="login.php" class="hover:text-gray-300">Connexion</a></li>
            <?php endif; ?>
            <li><a href="card.php" class="hover:text-gray-300">Panier</a></li>
        </ul>
    </div>
</header>

<script>
    // Script pour gérer l'affichage du menu burger sur mobile
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden'); // Toggle la visibilité du menu
    });
</script>


