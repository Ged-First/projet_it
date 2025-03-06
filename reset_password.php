<?php
// Récupérer le token depuis l'URL
$token = isset($_GET['token']) ? $_GET['token'] : '';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Réinitialisation de mot de passe</title>
</head>

<body>
    <div class="container">
        <form action="process_reset_password.php" method="POST">
            <h1>Réinitialisation de mot de passe</h1>
            <p>Entrez un nouveau mot de passe pour votre compte.</p>
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <input type="password" name="password" placeholder="Nouveau mot de passe" required>
            <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_token'): ?>
                <p style="color: red;">Le lien de réinitialisation est invalide ou a expiré.</p>
            <?php elseif (isset($_GET['error']) && $_GET['error'] === 'password_mismatch'): ?>
                <p style="color: red;">Les mots de passe ne correspondent pas.</p>
            <?php endif; ?>
            <button type="submit">Réinitialiser</button>
        </form>
    </div>
</body>

</html>
