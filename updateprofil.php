<?php
session_start();


if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

// Récupération des informations actuelles de l'utilisateur
$req = $DB->prepare("SELECT * FROM utilisateur WHERE id = ?");
$req->execute([$_SESSION['id']]);
$user = $req->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];
    $photo = $_FILES['photo'] ?? null;
    $valid = true;

    // Vérification de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $er_email = "L'email n'est pas valide";
    } else {
        $req_mail = $DB->prepare("SELECT id FROM utilisateur WHERE email = ? AND id <> ?");
        $req_mail->execute([$email, $_SESSION['id']]);
        if ($req_mail->fetch()) {
            $valid = false;
            $er_email = "Cet email est déjà utilisé";
        }
    }

    // Vérification du mot de passe (optionnel)
    if (!empty($password)) {
        if (strlen($password) < 6) {
            $valid = false;
            $er_password = "Le mot de passe doit contenir au moins 6 caractères";
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        }
    } else {
        $password_hashed = $user['password']; // Garde l'ancien mot de passe
    }

    // Gestion de la photo de profil
    if ($photo && $photo['size'] > 0) {
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $extensions)) {
            $valid = false;
            $er_photo = "Format d'image non valide (JPG, JPEG, PNG, GIF uniquement)";
        } else {
            $photo_name = "uploads/" . uniqid() . "." . $ext;
            move_uploaded_file($photo['tmp_name'], $photo_name);
        }
    } else {
        $photo_name = $user['photo']; // Garde l'ancienne photo
    }

    if ($valid) {
        $update = $DB->prepare("UPDATE utilisateur SET email = ?, password = ?, photo = ? WHERE id = ?");
        $update->execute([$email, $password_hashed, $photo_name, $_SESSION['id']]);

        $_SESSION['email'] = $email;
        $_SESSION['photo'] = $photo_name;

        header('Location: profil.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil</title>
</head>
<body>
    <h2>Modifier mon profil</h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        <span style="color:red"><?= $er_email ?? "" ?></span>

        <br><br>

        <label>Nouveau mot de passe (laisser vide pour ne pas changer) :</label>
        <input type="password" name="password">
        <span style="color:red"><?= $er_password ?? "" ?></span>

        <br><br>

        <label>Photo de profil :</label>
        <input type="file" name="photo">
        <span style="color:red"><?= $er_photo ?? "" ?></span>

        <br><br>

        <button type="submit">Modifier</button>
    </form>

    <br>
    <a href="profil.php">Retour au profil</a>
</body>
</html>
