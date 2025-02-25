<!DOCTYPE html>
<html>
<head>
    <title>{% yield title %}</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
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
        <a href="#" class="hover:text-gray-300">
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

{% yield body %}

<footer class="bg-gray-800 text-white py-6">
  <!-- Footer element with dark gray background, white text, and vertical padding -->
  <div class="container mx-auto px-4">
    <!-- Centered container with horizontal padding -->
    <div class="flex justify-between items-center">
      <!-- Flex container to distribute child elements evenly -->
      
      <div class="text-left">
        <!-- Left section for address, aligned to the left -->
        <address class="not-italic">
          123 Rue Exemple,<br>
          75000 Paris, France
        </address>
      </div>
      
      <div class="text-center">
        <!-- Center section for copyright text -->
        <p>&copy; <?php echo date('Y'); ?> Mon Site. Tous droits réservés.</p>
      </div>
      
      <div class="flex flex-col items-center">
        <!-- Right section for newsletter form, arranged in a column and centered -->
        <form action="newsletter.php" method="post" class="flex flex-col items-center">
          <!-- Form for newsletter subscription with vertical alignment -->
          <label for="newsletter" class="mb-2 text-center">Newsletter</label>
          <!-- Label for the newsletter input, centered with a bottom margin -->
          <div class="flex">
            <!-- Flex container to hold the email input and submit button side by side -->
            <input type="email" id="newsletter" name="newsletter" placeholder="Votre email" class="px-2 py-1 rounded-l bg-gray-700 text-white placeholder-gray-400 focus:outline-none" required>
            <!-- Email input field with padding, left-rounded border, dark gray background, and white text -->
            <button type="submit" class="px-4 py-1 rounded-r bg-blue-500 hover:bg-blue-600 focus:outline-none">S'abonner</button>
            <!-- Submit button with padding, right-rounded border, blue background that darkens on hover -->
          </div>
        </form>
      </div>
    </div>
  </div>
</footer>

</body>
</html>

</body>
</html>
