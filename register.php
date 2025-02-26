<?php require "header/header.php"?>
<script src="register.js" async></script>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md">
        <form id="registerForm" method="POST" class="bg-black shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-gray-100 mb-6 text-center text-2xl font-bold">Inscription</h2>
            <div id="response-container"></div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="email">
                    Adresse e-mail
                </label>
                <input class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" placeholder="Adresse e-mail" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="confirm_email">
                    Confirmer l'adresse e-mail
                </label>
                <input class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confirm_email" type="email" name="confirm_email" placeholder="Confirmer l'adresse e-mail" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="password">
                    Mot de passe
                </label>
                <input class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="********" required>
                    <div id= "containerJaudge" >
                    <div id="line" ></div>
                    </div >
                    <p id="message"></p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-bold mb-2" for="confirm_password">
                    Confirmer le mot de passe
                </label>
                <input class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confirm_password" type="password" name="confirm_password" placeholder="********" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-gray-200 hover:bg-gray-400 text-black font-bold py-1 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    S'inscrire
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-gray-200 hover:text-gray-400" href="login.php">
                    Déjà inscrit ?
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