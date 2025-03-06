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
        $token = $_POST['token'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Vérifier si les mots de passe correspondent
        if ($password !== $confirm_password) {
            header("Location: reset_password.php?token=$token&error=password_mismatch");
            exit;
        }

        // Hacher le mot de passe
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Vérifier si le token est valide
        $stmt = $pdo->prepare("
            SELECT email FROM password_resets 
            WHERE reset_token = ? AND expires_at > NOW()
        ");
        $stmt->execute([$token]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $email = $result['email'];

            // Mettre à jour le mot de passe de l'utilisateur
            $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
            $stmt->execute([$password_hash, $email]);

            // Supprimer le token utilisé
            $stmt = $pdo->prepare("DELETE FROM password_resets WHERE reset_token = ?");
            $stmt->execute([$token]);

            // Rediriger vers la page de connexion
            header("Location: login.php?success=password_reset");
            exit;
        } else {
            // Token invalide ou expiré
            header("Location: reset_password.php?token=$token&error=invalid_token");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
