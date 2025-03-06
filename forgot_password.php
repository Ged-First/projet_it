<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mot de passe oublié</title>
</head>

<body>
    <div class="container">
        <form action="process_forgot_password.php" method="POST">
            <h1>Mot de passe oublié</h1>
            <p>Veuillez entrer votre email d'enregistrement.</p>
            <input type="email" name="email" placeholder="Email" required>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'not_found'): ?>
                <p style="color: red;">Compte introuvable, veuillez entrer votre email d'enregistrement.</p>
            <?php endif; ?>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>

</html>
