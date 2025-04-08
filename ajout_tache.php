<?php
include "db.php";
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateurs_id'])) {
    header("Location: connexion.php"); // Redirige vers la page de login si non connecté
    exit;
}

if (isset($_POST['ajouter'])) {
    $utilisateur_id = $_SESSION['utilisateurs_id']; // Utilisateur connecté
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_limite = $_POST['date_limite'];

    $stmt = $pdo->prepare("INSERT INTO taches (utilisateur_id, titre, description, date_limite) VALUES (?, ?, ?, ?)");
    $stmt->execute([$utilisateur_id, $titre, $description, $date_limite]);

    echo "Nouvelle tâche ajoutée avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Tâche</title>
    <link rel="stylesheet" href="css/ajout.css">
</head>
<body>
    <form method="POST">
        <h4>Ajouter une Tâche</h4>
        <hr>

        <!-- utilisateur_id supprimé car récupéré depuis la session -->
        <input type="text" name="titre" placeholder="Titre" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <label for="date_limite">Tâche pour le:</label>
        <input type="date" name="date_limite" required>
        
        <button type="submit" name="ajouter">Ajouter</button>
        <p></p>
        <input type="button" onclick="window.location.href = 'index.php';" value="Retour" />
    </form> 
</body>
</html>
