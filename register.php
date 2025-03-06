<?php
require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $contact = $_POST['contact'];
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

        // Insérer les données dans la table users
        $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, date_naissance, contact, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $date_naissance, $contact, $email]);

        // Récupérer l'ID de l'utilisateur inséré
        $user_id = $pdo->lastInsertId();

        // Générer un code de confirmation
        $confirmation_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Insérer le code dans la table email_confirmations
        $stmt = $pdo->prepare("INSERT INTO email_confirmations (user_id, confirmation_code) VALUES (?, ?)");
        $stmt->execute([$user_id, $confirmation_code]);

        // Envoyer l'email avec PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurer SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'gedeonthefirst@gmail.com'; // Remplacez par votre email Gmail
            $mail->Password = 'ljvmmvwtmszvomfy'; // Remplacez par votre mot de passe Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Configurer l'expéditeur et le destinataire
            $mail->setFrom('gedeonthefirst@gmail.com', 'EbourseIT');
            $mail->addAddress($email);

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'Code de confirmation';
            $mail->Body = "Bonjour,<br><br>Votre code de confirmation est : <strong>$confirmation_code</strong><br><br>Merci de confirmer votre adresse email.";

            // Envoyer l'email
            $mail->send();

            
            
             // Redirection vers la page loading.php
header("Location: loading.php?email=" . urlencode($email));
exit;

        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
        }
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            // Rediriger avec une erreur si l'email existe déjà
            header("Location: acceuil.php?error=email_exists");
            exit;
        } else {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>
