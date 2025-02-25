<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la Pharmacie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 flex items-center justify-center min-h-screen">
    
    <!-- main container -->
    <div class="max-w-lg w-full bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 text-center">Modifier la Pharmacie</h2>

        <form class="mt-4 space-y-4">
            <!-- name of pharmacy -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom de la Pharmacie</label>
                <input type="text" id="nom" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Entrez le nom" />
            </div>

            <!-- Address -->
            <div>
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" id="adresse" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Entrez l'adresse" />
            </div>

            <!-- phone number -->
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="tel" id="telephone" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Entrez le numéro de téléphone" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Entrez l'email" />
            </div>

            <!-- schedule -->
            <div>
                <label for="horaires" class="block text-sm font-medium text-gray-700">Horaires</label>
                <input type="text" id="horaires" class="mt-1 w-full border border-gray-300 rounded-lg p-2" placeholder="Ex: 8h - 18h" />
            </div>

            <!-- registration button -->
            <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition">
                Enregistrer les modifications
            </button>
        </form>
    </div>

</body>
</html>
