<?php
include "../db.php";

if (isset($_POST['ajouter'])) {
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mot_de_passe']]);
    echo "Nouvel utilisateur ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <link rel="stylesheet" href="../css/ajout.css"> <!-- Liaison avec le fichier CSS -->
</head>
<body>
    <form method="POST">
        <h4>Ajouter un Utilisateur</h4> <!-- Ajout du titre du formulaire -->
        <hr>

        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        
        <button type="submit" name="ajouter">Ajouter</button> <!-- Bouton pour envoyer le formulaire -->
        <p></p>
        <!-- Boutons de retour à la page principale -->
        <input type="button" onclick="window.location.href = 'index_admin.php';" value="Retour" />
    </form> 
</body>
</html>