<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Connexion à la base de données
    $host = 'localhost';
    $db = 'projet_it_2';
    $user = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $user_id = $user['id'];

            // Générer un nouveau code de confirmation
            $confirmation_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Mettre à jour ou insérer le code dans la table email_confirmations
            $stmt = $pdo->prepare("REPLACE INTO email_confirmations (user_id, confirmation_code) VALUES (?, ?)");
            $stmt->execute([$user_id, $confirmation_code]);

            // Envoyer l'email avec le nouveau code
            require 'includes/PHPMailer/src/Exception.php';
            require 'includes/PHPMailer/src/PHPMailer.php';
            require 'includes/PHPMailer/src/SMTP.php';

            use PHPMailer\PHPMailer\PHPMailer;

            $mail = new PHPMailer(true);

            try {
                // Configuration SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mon_adresse_email'; // Remplacez par votre email Gmail
                $mail->Password = 'mon_mdp_des'; // Remplacez par votre mot de passe Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                // Configuration de l'expéditeur et du destinataire
                $mail->setFrom('mon_adresse_email', 'EbourseIT');
                $mail->addAddress($email);

                // Contenu de l'email
                $mail->isHTML(true);
                $mail->Subject = 'Nouveau code de confirmation';
                $mail->Body = "Bonjour,<br><br>Votre nouveau code de confirmation est : <strong>$confirmation_code</strong><br><br>Merci de confirmer votre adresse email.";

                // Envoyer l'email
                $mail->send();

                // Rediriger avec un message de succès
                header("Location: confirm_email.php?email=" . urlencode($email));
                exit;
            } catch (Exception $e) {
                echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
            }
        } else {
            echo "Utilisateur introuvable.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
