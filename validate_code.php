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
        $confirmation_code = $_POST['confirmation_code'];

        // Vérifier si l'email existe et si le code est valide
        $stmt = $pdo->prepare("
            SELECT ec.id AS confirmation_id, u.id AS user_id
            FROM email_confirmations ec
            JOIN users u ON ec.user_id = u.id
            WHERE u.email = ? AND ec.confirmation_code = ?
        ");
        $stmt->execute([$email, $confirmation_code]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Code valide : supprimer le code et marquer l'email comme vérifié
            $confirmation_id = $result['confirmation_id'];
            $user_id = $result['user_id'];

            $pdo->prepare("DELETE FROM email_confirmations WHERE id = ?")->execute([$confirmation_id]);
            $pdo->prepare("UPDATE users SET email_verified = TRUE WHERE id = ?")->execute([$user_id]);

            // Rediriger vers la page de création de mot de passe
            header("Location: create_password.php?email=" . urlencode($email));
            exit;
        } else {
            // Code invalide : rediriger avec une erreur
            header("Location: confirm_email.php?email=" . urlencode($email) . "&error=invalid_code");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
