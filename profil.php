<?php
session_start();
$conn = new mysqli("localhost", "root", "root", "pharmacy");

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO users (email, password, name, surname, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $email, $password, $name, $surname, $phone);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Inscription réussie ! <a href='login.php'>Se connecter</a></p>";
    } else {
        echo "<p style='color: red;'>Erreur: " . $conn->error . "</p>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">S'inscrire</button>
    </form>
    <a href="login.php">Déjà un compte ? Se connecter</a>
</body>
</html>
