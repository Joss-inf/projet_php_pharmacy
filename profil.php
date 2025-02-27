<?php
session_start();

// Initialisation des données utilisateur (remplacez par une base de données dans un vrai projet)
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'email' => 'utilisateur@example.com',
        'password' => password_hash('motdepasse', PASSWORD_DEFAULT), // Hachage du mot de passe
        'nom' => 'Nom Utilisateur',
        'adresse' => '123 Rue Exemple, Ville',
        'telephone' => '0123456789',
        'photo' => 'uploads/default.jpg' // Photo par défaut
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['user']['email'] = $_POST['email'];
    $_SESSION['user']['nom'] = $_POST['nom'];
    $_SESSION['user']['adresse'] = $_POST['adresse'];
    $_SESSION['user']['telephone'] = $_POST['telephone'];
    
    if (!empty($_POST['password'])) {
        $_SESSION['user']['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    
    // Gestion du téléchargement de la photo de profil
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $dossier = 'uploads/';
        $fichier_temp = $_FILES['photo']['tmp_name'];
        $fichier_nom = basename($_FILES['photo']['name']);
        $chemin_fichier = $dossier . $fichier_nom;

        // Vérification de l'extension
        $extensions_autorisees = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($fichier_nom, PATHINFO_EXTENSION));
        if (in_array($extension, $extensions_autorisees) && $_FILES['photo']['size'] < 2000000) {
            move_uploaded_file($fichier_temp, $chemin_fichier);
            $_SESSION['user']['photo'] = $chemin_fichier;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }
        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const img = document.getElementById("photo-preview");
                img.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Profil Utilisateur</h1>
    <img id="photo-preview" src="<?php echo $_SESSION['user']['photo']; ?>" alt="Photo de profil">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>" required>
        <input type="password" name="password" placeholder="Nouveau mot de passe">
        <input type="text" name="nom" value="<?php echo $_SESSION['user']['nom']; ?>" required>
        <input type="text" name="adresse" value="<?php echo $_SESSION['user']['adresse']; ?>">
        <input type="tel" name="telephone" value="<?php echo $_SESSION['user']['telephone']; ?>">
        <input type="file" name="photo" accept="image/*" onchange="previewImage(event)">
        <button type="submit">Enregistrer</button>
    </form>
</div>

</body>
</html>
