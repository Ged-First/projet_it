<?php
$email = isset($_GET['email']) ? $_GET['email'] : '';
$error = isset($_GET['error']) && $_GET['error'] === 'password_mismatch' ? "Les mots de passe ne correspondent pas." : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Création de mot de passe</title>
</head>
<body>
    <div class="container">
        <form action="save_password.php" method="POST">
            <h1>Créer un mot de passe</h1>
            <p>Définissez un mot de passe pour votre compte.</p>
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
            <?php if ($error): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>
