<?php
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Inscription d'un nouvel utilisateur
    public function register($email, $password) {
        try {
            // Vérifier si l'email existe déjà
            $stmt = $this->db->prepare("SELECT 1 FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->rowCount() > 0) {
                return [400, 'Email déjà pris.'];
            }

            // Hacher le mot de passe
            $hached_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

            // Insérer le nouvel utilisateur
            $stmt = $this->db->prepare("INSERT INTO Users (password, email, role) VALUES (:password, :email, :role)");

            // Exécution de la requête avec les données associées
            if ($stmt->execute(['password' => $hached_password, 'email' => $email, 'role' => 0])) {
                return [200, 'Inscription réussie.'];
            } else {
                return [400, "Erreur lors de l'inscription."];
            }
        } catch (PDOException $e) {
            // Si une erreur se produit, on capture l'exception et on renvoie l'erreur
            return [500, "Erreur de base de données : " . $e->getMessage()];
        }
    }

    // Connexion de l'utilisateur
    public function login($email, $password) {
        try {
            // Préparer la requête pour récupérer l'utilisateur par email
            $stmt = $this->db->prepare("SELECT password FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]);

            if ($stmt->rowCount() != 1) {
                return [400, 'Email incorrect'];
            }

            $p = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si le mot de passe est correct
            if (password_verify($password, $p['password'])) {
                // Démarrer une session et stocker les informations de l'utilisateur
                $stmt = $this->db->prepare("SELECT id, pharmacy_id, email, role FROM Users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                return [200, 'Connexion réussie.', $user];
            } else {
                return [400, 'Mot de passe incorrect.'];
            }
        } catch (PDOException $e) {
            return [500, "Erreur de base de données : " . $e->getMessage()];
        }
    }

    // Vérifier si l'utilisateur est connecté
    public function isConnected() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    // Obtenir le rôle de l'utilisateur
    public function whatRole() {
        session_start();
        if ($this->isConnected() == false) {
            return -1;
        }
        return $_SESSION['role'];
    }

    // Déconnexion de l'utilisateur
    public function deconnexion() {
        session_start();
        session_unset();
        session_destroy();
    }
}
?>