<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données
    $host = 'localhost';
    $db = 'projet_it_2';
    $user = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les données du formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Vérifier si les mots de passe correspondent
        if ($password !== $confirm_password) {
            // Rediriger avec une erreur si les mots de passe ne correspondent pas
            header("Location: create_password.php?email=" . urlencode($email) . "&error=password_mismatch");
            exit;
        }

        // Hacher le mot de passe
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Mettre à jour l'utilisateur avec le mot de passe
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
        $stmt->execute([$password_hash, $email]);

        // Rediriger vers la page d'accueil pour connexion
        header("Location: acceuil.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
