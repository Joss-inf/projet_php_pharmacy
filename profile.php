<?php
session_start();
require_once 'databaseprofile.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>    
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <section class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">MON PROFIL</h1> 

        <!-- Messages de succès / erreur -->
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="bg-red-500 text-white p-3 rounded-md text-center mb-3">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php elseif (isset($_SESSION['success'])) : ?>
            <div class="bg-green-500 text-white p-3 rounded-md text-center mb-3">
                <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulaires -->
        <div class="space-y-6">

            <!-- Modifier l'email -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <p class="font-semibold text-gray-700 mb-3">Modifiez votre email</p>
                <form method="POST" action="profil.php" class="space-y-3">
                    <input type="email" name="emailactuel" placeholder="Email actuel" required class="w-full p-2 border rounded-md">
                    <input type="email" name="nvemail" placeholder="Nouveau email" required class="w-full p-2 border rounded-md">
                    <input type="email" name="confirmernvemail" placeholder="Confirmer votre nouvelle email" required class="w-full p-2 border rounded-md">
                    <input type="submit" value="Confirmer" name="emailconfirmation" class="w-full bg-blue-500 text-white p-2 rounded-md cursor-pointer hover:bg-blue-600">
                </form>
            </div>

            <!-- Modifier le mot de passe -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <p class="font-semibold text-gray-700 mb-3">Modifiez votre mot de passe</p>
                <form method="POST" action="profil.php" class="space-y-3">
                    <input type="password" name="motdepasseactuel" placeholder="Mot de passe actuel" required class="w-full p-2 border rounded-md">
                    <input type="password" name="nvmotdepasse" placeholder="Nouveau mot de passe" required class="w-full p-2 border rounded-md">
                    <input type="password" name="confirmmotdepasse" placeholder="Confirmer votre mot de passe" required class="w-full p-2 border rounded-md">
                    <input type="submit" value="Confirmer" name="motdepasseconfirmation" class="w-full bg-blue-500 text-white p-2 rounded-md cursor-pointer hover:bg-blue-600">
                </form>
            </div>

            <!-- Changer la photo de profil -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <p class="font-semibold text-gray-700 mb-3">Changer la photo de profil</p>
                <form method="POST" action="profil.php" enctype="multipart/form-data" class="space-y-3">
                    <input type="file" name="profilepic" required class="w-full p-2 border rounded-md">
                    <button type="submit" class="w-full bg-green-500 text-white p-2 rounded-md cursor-pointer hover:bg-green-600">Télécharger</button>
                </form>
            </div>

            <!-- Bouton de déconnexion -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md text-center">
                <form method="POST" action="logout.php">
                    <button type="submit" class="w-full bg-red-500 text-white p-2 rounded-md cursor-pointer hover:bg-red-600">Se déconnecter</button>
                </form>
            </div>

        </div>
    </section>

</body>
</html>