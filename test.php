<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Compléter le profil</title>
</head>
<body>
    <form action="process_complete_profile.php" method="POST" enctype="multipart/form-data">
        <label>Photo de profil :</label>
        <input type="file" name="profile_picture">
        
        <label>Localisation :</label>
        <select name="province">
            <option value="">Sélectionner une province</option>
            <option value="Estuaire">Estuaire</option>
            <option value="Haut-Ogooué">Haut-Ogooué</option>
            <option value="Moyen-Ogooué">Moyen-Ogooué</option>
            <option value="Ngounié">Ngounié</option>
            <option value="Nyanga">Nyanga</option>
            <option value="Ogooué-Ivindo">Ogooué-Ivindo</option>
            <option value="Ogooué-Lolo">Ogooué-Lolo</option>
            <option value="Ogooué-Maritime">Ogooué-Maritime</option>
            <option value="Woleu-Ntem">Woleu-Ntem</option>
        </select>
        
        <label>Bio :</label>
        <textarea name="bio" required><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
        
        <label>Type d'utilisateur :</label>
        <select name="user_type" required>
            <option value="">Choisir un type</option>
            <option value="vendeur">Vendeur</option>
            <option value="client">Client</option>
        </select>
        
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
