<?php
class User {
    private $db;
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // Inscription d'un nouvel utilisateur
    public function register( $email,$password) {
        // Vérifier si le nom d'utilisateur ou l'email existe déjà
        $stmt = $this->db->prepare("SELECT 1 FROM users WHERE  email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            return [400,"email déjà pris."];
        }

        // Hacher le mot de passe
        $hached_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

        // Insérer le nouvel utilisateur
        $stmt = $this->db->prepare("INSERT INTO users (password, email) VALUES (:password, :email)");
        if ($stmt->execute([ 'password' => $hached_password, 'email' => $email])) {
            return [200,'Inscription réussie.'];
        } else {
            return [400,"Erreur lors de l'inscription."];
        }
    }

    // Connexion de l'utilisateur
    public function login($email,$password) {
        // Préparer la requête pour récupérer l'utilisateur par email
        $stmt = $this->db->prepare("SELECT password FROM users WHERE  email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() >1 || $stmt -> rowCount() < 1) {
            return [400,'mail  incorrect'];
        }
        $p = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le mot de passe est correct
        if (password_verify($password,$p['password'])) {
            // Démarrer une session et stocker les informations de l'utilisateur
            $stmt = $this->db->prepare("SELECT id,pharmacy_id,email,role FROM users WHERE  email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return [200, 'Connexion réussie.',$user];

        } else {
            return [400, 'Mot de passe incorrect.'];
        }
    }

    // Vérifier si l'utilisateur est connecté
    public function isConnected() {
        session_start();
        return isset($_SESSION['user_id']);
    }
    public function whatRole() {
        if ($this ->isConnected() == false) {
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