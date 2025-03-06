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

        // Récupérer l'email soumis
        $email = $_POST['email'];

        // Vérifier si l'email existe
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // L'email existe : Générer un lien unique
            $reset_token = bin2hex(random_bytes(16));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Insérer dans la table password_resets
            $stmt = $pdo->prepare("INSERT INTO password_resets (email, reset_token, expires_at) VALUES (?, ?, ?)");
            $stmt->execute([$email, $reset_token, $expires_at]);

            // Envoyer un email avec le lien de réinitialisation
            
            $to = $email;
            $subject = "Réinitialisation de votre mot de passe";
            $message = "Bonjour,\n\nVous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le lien ci-dessous pour continuer :\n\n$reset_link\n\nCe lien est valide pendant 1 heure.\n\nSi vous n'êtes pas à l'origine de cette demande, ignorez cet email.";
                $headers = "From: no-reply@votre-site.com";

            mail($to, $subject, $message, $headers);

            // Utiliser PHPMailer ou mail() pour envoyer le lien (voir exemple précédent)

            echo "Un email contenant un lien de réinitialisation a été envoyé.";
        } else {
            // Rediriger avec une erreur
            header("Location: forgot_password.php?error=not_found");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
