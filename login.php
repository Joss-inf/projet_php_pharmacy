<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Page de Connexion</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md">
        <form action="login.php" method="post" class="bg-black shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-gray-100 mb-6 text-center text-2xl font-bold">Connexion</h2>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="username">
                    Nom d'utilisateur
                </label>
                <input class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="username" placeholder="Nom d'utilisateur">
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="password">
                    Mot de passe
                </label>
                <input class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="********">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-gray-200  hover:bg-gray-400 text-black font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Se connecter
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-gray-200 hover:text-gray-400" href="register.php">
                    Mot de passe oublié ?
                </a>
            </div>
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;2025 Votre Société. Tous droits réservés.
        </p>
    </div>
</body>
</html>