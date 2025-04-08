<?php
// Inclusion de la base de données
require_once "db.php";

// Démarrage de la session
session_start();

// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['utilisateurs_id'])) {
    $utilisateur_id = $_SESSION['utilisateurs_id'];

    // Requête SQL pour récupérer les tâches de l'utilisateur connecté
    // On utilise des alias pour éviter la confusion avec les colonnes dupliquées (comme "id")
    $taches = $pdo->prepare("
        SELECT 
            taches.id AS tache_id,
            taches.titre,
            taches.description,
            taches.date_limite,
            taches.statut,
            utilisateurs.email
        FROM taches 
        INNER JOIN utilisateurs 
        ON taches.utilisateur_id = utilisateurs.id 
        WHERE utilisateurs.id = ?
    ");
    $taches->execute([$utilisateur_id]);
    $taches = $taches->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>

    <!-- Lien vers Bootstrap pour un style rapide et responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Lien vers ton fichier CSS personnalisé -->
    <link rel="stylesheet" href="css/style-bootstrap.css">
</head>
<body>

<!-- Barre supérieure : bienvenue + boutons de connexion/déconnexion -->
<div class="container-fluid py-3 px-4 bg-white border-bottom shadow-sm">
    <div class="top-links d-flex justify-content-between align-items-center">
        <div>
            <?php if (isset($_SESSION['utilisateurs_id'])): ?>
                <span class="me-2 fw-semibold">Bienvenue, <?= htmlspecialchars($_SESSION['utilisateurs_email']) ?></span>
                <a href='deconnexion.php' class="btn btn-outline-secondary btn-sm">Déconnexion</a>
            <?php else: ?>
                <a href='connexion.php' class="btn btn-primary btn-sm">Se connecter</a>
                <a href='nouvel_utilisateur.php' class="btn btn-secondary btn-sm ms-2">Créer un compte</a>
                <a href='admin/connexion_admin.php' class="btn btn-secondary btn-sm ms-2">Admin</a>
            <?php endif; ?>
        </div>
        <h4 class="mb-0">HOME</h4>
    </div>
</div>

<!-- Liens de navigation -->
<div class="container-lg mt-4 mb-3">
    <a href="ajout_tache.php" class="btn btn-success btn-sm">Ajouter une Tâche</a>
<!--    <a href="bonus/tache.php" class="btn btn-info btn-sm ms-2">Afficher les tâches</a> -->
<!--     <a href="nouvel_utilisateur.php" class="btn btn-warning btn-sm ms-2">Ajouter un utilisateur</a> -->
<!--    <a href="bonus/utilisateur.php" class="btn btn-info btn-sm ms-2">Afficher les utilisateurs</a> -->
</div>

<!-- Zone d'affichage des tâches -->
<main class="container-lg mt-4">
    <?php if (isset($_SESSION['utilisateurs_id'])): ?>
        <h4 class="mb-3">Vos tâches</h4>

        <div class="row row-cols-1 row-cols-md-5 g-4">
            <?php foreach ($taches as $tache): ?>
                <div class="col">
                    <div class="utilisateur-card border rounded p-3 shadow-sm h-100">
                        <h5><?= htmlspecialchars($tache["titre"]) ?></h5>
                        <p><strong>Description:</strong> <?= htmlspecialchars($tache["description"]) ?></p>
                        <p><strong>Date limite:</strong> <?= htmlspecialchars($tache["date_limite"]) ?></p>
                        <p><strong>Statut:</strong> <?= htmlspecialchars($tache["statut"]) ?></p>

                        <!-- Boutons d'action -->
                        <div class="actions mb-2">
                            <!-- On utilise ici "tache_id" (et non "id") pour éviter les erreurs -->
                            <a href="modifier.php?id=<?= $tache["tache_id"] ?>" class="btn btn-outline-primary btn-sm">Modifier</a>
                            <a href="supprimer.php?id=<?= $tache["tache_id"] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer cette tâche ?');">Supprimer</a>
                        </div>

                        <!-- Formulaire de changement de statut -->
                        <form method="POST" action="bonus/changer_statut.php">
                            <input type="hidden" name="id" value="<?= $tache["tache_id"] ?>">
                            <select name="statut" class="form-select form-select-sm mb-2">
                                <option value="En attente" <?= $tache["statut"] == "En attente" ? "selected" : "" ?>>En attente</option>
                                <option value="Terminée" <?= $tache["statut"] == "Terminée" ? "selected" : "" ?>>Terminée</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-secondary">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Message si l'utilisateur n'est pas connecté -->
        <div class="alert alert-warning">Veuillez vous connecter pour voir vos tâches.</div>
    <?php endif; ?>
</main>

<!-- Pied de page -->
<footer class="text-center mt-4">
    <p>&copy; 2024 — Tous droits réservés.</p>
</footer>

<!-- Script Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
