<footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <!-- Left section for address, aligned to the left -->
            <div class="text-center md:text-left">
                <address class="not-italic">
                    123 Rue Exemple,<br>
                    75000 Paris, France
                </address>
            </div>

            <!-- Center section for copyright text -->
            <div class="text-center">
                <p>&copy; <?php echo date('Y'); ?> Mon Site. Tous droits réservés.</p>
            </div>

            <!-- Right section for newsletter form, arranged in a column and centered -->
            <div class="flex flex-col items-center">
                <form action="newsletter.php" method="post" class="flex flex-col items-center">
                    <label for="newsletter" class="mb-2 text-center">Newsletter</label>
                    <div class="flex">
                        <input type="email" id="newsletter" name="newsletter" placeholder="Votre email" class="px-2 py-1 rounded-l bg-gray-700 text-white placeholder-gray-400 focus:outline-none" required>
                        <button type="submit" class="px-4 py-1 rounded-r bg-green-600 hover:bg-green-700 focus:outline-none">S'abonner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>