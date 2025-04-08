<!--
<div>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" />
</div>
<div>
  <label for="pass">Password (8 characters minimum):</label>
  <input type="password" id="pass" name="password" minlength="8" required />    PEUT ÊTRE UTILE
</div>
<input type="submit" value="Sign in" />

label {
  display: block;
}

input[type="submit"],
label {
  margin-top: 1rem;
}
-->


<?php
// Inclusion du fichier de connexion à la base de données
include "../db.php";

// Récupération de tous les contacts depuis la base de données
$utilisateurs = $pdo->query("SELECT * FROM utilisateurs")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="css/bonus.css"> <!-- Liaison avec le fichier CSS -->
</head>
<body>
    <div>
        <h4>Liste des utilisateurs</h4>
        <hr>
        
        <!-- Lien pour ajouter un nouveau contact -->
        <a href="../index.php">HOME</a>
        <a href="../nouvel_utilisateur.php">Ajouter un utilisateur</a>

        <!-- Tableau affichant la liste des contacts -->
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Mot de passe</th>
                <th>Actions</th>
            </tr>
            
            <!-- Boucle pour afficher chaque contact -->
            <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <td><?= $utilisateur["nom"] ?></td>
                <td><?= $utilisateur["prenom"] ?></td>
                <td><?= $utilisateur["email"] ?></td>
                <td><?= $utilisateur["mot_de_passe"] ?></td>
                <td>
                    <!-- Lien pour modifier un contact -->
                    <a href="modifier.php?id=<?= $utilisateur["id"] ?>">Modifier</a>
                    <!-- Lien pour supprimer un contact avec confirmation -->
                    <a href="supprimer.php?id=<?= $utilisateur["id"] ?>" onclick="return confirm('Supprimer ce contact ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <input type="button" onclick="window.location.href = '../index.php';" value="Retour" />
    </div>
</body>
</html>
