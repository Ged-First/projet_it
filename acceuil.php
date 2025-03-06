<?php
$error = isset($_GET['error']) && $_GET['error'] === 'email_exists' ? "Cette adresse email est déjà utilisée." : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Acceuil</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="register.php" method="POST">
            <h1>Créer Un Compte</h1>
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="date" name="date_naissance" placeholder="Date de naissance" required>
            <input type="text" name="contact" placeholder="Contact" required>
            <input type="email" name="email" placeholder="Email" required>
            <?php if ($error): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
            <button type="submit">S'enregistrer</button>
        </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Se Connecter</h1>
                <div class="social-icons"> 
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Mot de passe">
                <a href="forgot_password.php">Mot de passe oublie?</a>
                <button>Se connecter</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Salut l'ami!</h1>
                    <p>Entre tes identifiants pour acceder a notre site</p>
                    <button class="hidden" id="login">Se connecter</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Aucun compte?</h1>
                    <p>Enregistrer vous afin d'utiliser pleinement nos services</p>
                    <button class="hidden" id="register">je m'enregistre</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>