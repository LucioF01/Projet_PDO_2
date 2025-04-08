<?php
include "../db.php";

if (isset($_POST['ajouter'])) {
    $stmt = $pdo->prepare("INSERT INTO taches (utilisateur_id, titre, description, date_limite) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['utilisateur_id'], $_POST['titre'], $_POST['description'], $_POST['date_limite']]);
    echo "Nouvelle tâche ajoutée avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Tâche</title>
    <link rel="stylesheet" href="../css/ajout.css"> <!-- Liaison avec le fichier CSS -->
</head>
<body>
    <form method="POST">
        <h4>Ajouter une Tâche</h4> <!-- Ajout du titre du formulaire -->
        <hr>

        <input type="number" name="utilisateur_id" placeholder="utilisateur_id" required>
        <input type="text" name="titre" placeholder="Titre" required>
        <input type="textarea" name="description" placeholder="Description" required>
        <label for="date_limite">Tâche pour le:</label>
        <input type="date" name="date_limite" placeholder="date_limite" required>
        
        <button type="submit" name="ajouter">Ajouter</button> <!-- Bouton pour envoyer le formulaire -->
        <p></p>
        <!-- Boutons de retour à la page principale -->
        <input type="button" onclick="window.location.href = 'index_admin.php';" value="Retour" />
    </form> 
</body>
</html>