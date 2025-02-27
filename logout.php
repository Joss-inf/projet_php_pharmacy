<?php
session_start();

// Détruire la session
session_unset();
session_destroy();

// Rediriger vers la page de connexion avec un message
header("Location: login.php?message=deconnexion");
exit();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center h-screen bg-gray-100">
    <h2 class="text-2xl font-bold text-gray-800">Déconnexion</h2>
    <p class="text-green-600 mt-4">Vous avez été déconnecté avec succès.</p>
    <a href="login.php" class="mt-6 px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Se reconnecter</a>
</body>
</html>
