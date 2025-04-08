<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion ADMINISTRATEUR</title>
    <link rel="stylesheet" href="../css/ajout.css"> <!-- Liaison avec le fichier CSS -->
</head>
<body>
    <form action="auth_admin.php" method="post">
        <h4>Page de connexion ADMINISTRATEUR</h4>
        <hr>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        
        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" name="mot_de_passe" required><br>

        <!-- Suggestion ajouteur un CAPTCHA pour plus de sécuriter -->

        <input type="submit" value="Login">
        <input type="button" onclick="window.location.href = 'index_admin.php';" value="Retour" />
    </form>
</body>
</html>