<?php require "header/header.php"?>

<body class="bg-gray-100 flex items-center justify-center h-screen flex-row ">
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md">
        <form id="loginForm" method="POST" class="bg-black shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-gray-100 mb-6 text-center text-2xl font-bold">Connexion</h2>
            <div id="response-container"></div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="username">
                    email
                </label>
                <input class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" name="email" placeholder="email@exemple.com">
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="password">
                    Mot de passe
                </label>
                <input class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="********">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-gray-200 hover:bg-gray-400 text-black font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="login">
                    Se connecter
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-gray-200 hover:text-gray-400" href="register.php">
                    Enregistrez-vous !
                </a>
            </div>
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;2025 Votre Société. Tous droits réservés.
        </p>
    </div>
</div>

<?php require "footer/footer.php"?>

</body>
</html>
<script src="login.js" ></script>