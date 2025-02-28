<?php
require "header/header.php";  
?>

<?php// Assurez-vous que la session est bien démarrée

// Vérifier si l'utilisateur est admin (role = 3)
$isAdm = isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 3;

// Rediriger vers l'accueil si l'utilisateur n'est pas admin
if (!$isAdm) {
    header("Location: index.php"); // Rediriger vers la page d'accueil
    exit(); // Toujours arrêter le script après une redirection
}
?>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-center mb-6">Gestion des Pharmacies</h1>
        <!-- Liste des pharmacies -->
        <a class="block text-center text-xl font-semibold mb-4">Liste de pharmacies</a>
<div id="pharmaciesList" class="max-h-[400px] max-w-[800px] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 overflow-y-auto gap-4 p-4 border border-gray-300 rounded-lg shadow-md mx-auto mb-4">
    <!-- La liste de pharmacies sera générée dynamiquement ici -->
</div>

<!-- Bouton centré avec un cadre flottant et ombre -->
<div class="flex justify-center mb-8">
    <button id="addPharmacyBtn" class="bg-blue-600 text-white p-2 rounded-lg shadow-md hover:shadow-lg transition">Ajouter une pharmacie</button>
</div>

<a class="block text-center text-xl font-semibold mb-4">Liste des utilisateurs</a>
<div id="usersList" class="max-h-[400px] max-w-[800px] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 overflow-y-auto gap-4 p-4 border border-gray-300 rounded-lg shadow-md mx-auto mb-4">
    <!-- La liste des utilisateurs sera générée dynamiquement ici -->
</div>>
</div>
    <!-- Formulaire Ajouter une pharmacie -->
    <div id="addPharmacyForm" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 hidden">
    <div class="bg-white p-8 rounded shadow-lg w-96">
        <h2 class="text-2xl mb-4">Ajouter une pharmacie</h2>
        <form id="addPharmacyFormSubmit">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Nom</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium">Numéro de téléphone</label>
                <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium">Adresse</label>
                <input type="text" id="address" name="address" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="country" class="block text-sm font-medium">Pays</label>
                <input type="text" id="country" name="country" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="department" class="block text-sm font-medium">Département</label>
                <input type="text" id="department" name="department" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="is_valid" class="block text-sm font-medium">Valide</label>
                <input type="checkbox" id="is_valid" name="is_valid" class="w-full px-4 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium">Description</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border rounded" required></textarea>
            </div>
            <button type="submit" class="bg-green-600 text-white p-2 rounded">Ajouter</button>
            <button id="closeAddPharmacyForm" class="bg-red-600 text-white p-2 rounded">Fermer</button>
        </form>
    </div>
</div>

    <script src="dashboard.js"></script>
</body>

</html>

<?php
require "footer/footer.php";  
?>



