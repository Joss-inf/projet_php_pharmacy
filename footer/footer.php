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
            <button type="submit" class="px-4 py-1 rounded-r bg-green-600 hover:bg-green-700 focus:outline-none">S'abonner</button>
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