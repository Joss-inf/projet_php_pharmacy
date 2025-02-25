<?php 

require "header/header.php";
require "database.php"; 
?>

<body class="bg-gray-100 font-sans antialiased">

    <div class="max-w-4xl mx-auto mt-10 p-8">
        <div class="flex items-center justify-center">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 text-center">Nom d'utilisateur</h2>
                    <p class="text-lg text-gray-600 text-center">Utilisateur@example.com</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto p-8 space-y-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Changer mon Email</h3>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium text-gray-700">Nouvel Email</label>
                    <input type="email" id="email" name="email" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm" placeholder="nouvel email" required>
                </div>
                <div class="mb-4">
                    <label for="current-password" class="block text-lg font-medium text-gray-700">Mot de passe</label>
                    <input type="password" id="current-password" name="current-password" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Mot de passe" required>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-md hover:bg-green-700 transition duration-200">Enregistrer l'Email</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Changer mon Mot de Passe</h3>
            <form action="#" method="POST">
 
                <div class="mb-4">
                    <label for="new-password" class="block text-lg font-medium text-gray-700">Nouveau mot de passe</label>
                    <input type="password" id="new-password" name="new-password" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Nouveau mot de passe" required>
                </div>
                <div class="mb-6">
                    <label for="confirm-password" class="block text-lg font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm" placeholder="Confirmez le nouveau mot de passe" required>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-green-600 text-white p-3 rounded-md hover:bg-green-700 transition duration-200">Enregistrer le Mot de Passe</button>
                </div>
            </form>
        </div>
    </div>

</body>

<?php 
require "footer/footer.php";
?>
