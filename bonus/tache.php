<?php
// Inclusion du fichier de connexion à la base de données
include "../db.php";

// Récupération de tous les contacts depuis la base de données
$taches = $pdo->query("SELECT * FROM taches")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des tâches</title>
    <link rel="stylesheet" href="css/bonus.css"> <!-- Liaison avec le fichier CSS -->
</head>
<body>
    <div>
        <h4>Liste des tâches</h4>
        <hr>
        
        <!-- Lien pour ajouter un nouveau contact -->
        <a href="../index.php">HOME</a>
        <a href="../ajout_tache.php">Ajouter une tâche</a>

        <!-- Tableau affichant la liste des contacts -->
        <table border="1">
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Email</th>
                <th>Date limite</th>
                <th>Statut</th>
            </tr>
            
            <!-- Boucle pour afficher chaque contact -->
            <?php foreach ($taches as $tache): ?>
            <tr>
                <td><?= $tache["titre"] ?></td>
                <td><?= $tache["description"] ?></td>
                <td><?= $tache["date_limite"] ?></td>
                <td><?= $tache["statut"] ?></td>
                <td>
                    <!-- Lien pour modifier un contact -->
                    <a href="modifier.php?id=<?= $tache["id"] ?>">Modifier</a>
                    <!-- Lien pour supprimer un contact avec confirmation -->
                    <a href="supprimer.php?id=<?= $tache["id"] ?>" onclick="return confirm('Supprimer cette tache ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <input type="button" onclick="window.location.href = '../index.php';" value="Retour" />
    </div>
</body>
</html>
