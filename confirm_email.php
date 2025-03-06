<?php
$email = isset($_GET['email']) ? $_GET['email'] : '';
$error = isset($_GET['error']) && $_GET['error'] === 'invalid_code' ? "Code de confirmation invalide." : '';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Confirmation d'email</title>
</head>

<body>
    <div class="container">
        <form action="validate_code.php" method="POST">
            <h1>Confirmez votre email</h1>
            <p>Veuillez confirmer que l'email <strong><?= htmlspecialchars($email) ?></strong> est bien le vôtre.</p>
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
            <input type="text" name="confirmation_code" placeholder="Code de confirmation" required>
            <?php if ($error): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
            <button type="submit">Valider le code</button>
        </form>
        <form action="resend_code.php" method="POST">
            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
            <button type="submit">Renvoyer le code</button>
        </form>
    </div>
</body>

</html>
