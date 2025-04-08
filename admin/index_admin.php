<?php
// Inclusion de la base de données
require_once "../db.php";

// Démarrage de la session
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'administrateur
if (isset($_SESSION['admin_id'])) {
    // Requête pour récupérer les utilisateurs
    $utilisateurs = $pdo->query("SELECT * FROM utilisateurs")->fetchAll();

    // Requête pour récupérer les tâches
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
    ");
    $taches->execute(); // Pas besoin de lier de paramètre ici
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
    <link rel="stylesheet" href="../css/style-bootstrap.css">
</head>
<body>

<!-- Barre supérieure : bienvenue + boutons de connexion/déconnexion -->
<div class="container-fluid py-3 px-4 bg-white border-bottom shadow-sm">
    <div class="top-links d-flex justify-content-between align-items-center">
        <div>
            <?php if (isset($_SESSION['admin_id'])): ?>
                <span class="me-2 fw-semibold">Bienvenue, <?= htmlspecialchars($_SESSION['admin_email']) ?></span>
                <a href='deconnexion.php' class="btn btn-outline-secondary btn-sm">Déconnexion</a>
            <?php endif; ?>
        </div>
        <h4 class="mb-0">HOME</h4>
    </div>
</div>

<!-- Liens de navigation -->
<div class="container-lg mt-4 mb-3">
    <a href="ajout_tache_admin.php" class="btn btn-success btn-sm">Ajouter une Tâche</a>
    <a href="nouvel_utilisateur_admin.php" class="btn btn-warning btn-sm ms-2">Ajouter un utilisateur</a>
</div>

<!-- Zone d'affichage des utilisateurs et tâches -->
<main class="container-lg mt-4">
    <div class="row">
        <!-- Section des utilisateurs -->
        <div class="col-12 mb-4">
            <h4>Liste des utilisateurs</h4>
            <hr>
            <!-- Tableau affichant la liste des utilisateurs -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Mot de passe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= htmlspecialchars($utilisateur["nom"]) ?></td>
                        <td><?= htmlspecialchars($utilisateur["prenom"]) ?></td>
                        <td><?= htmlspecialchars($utilisateur["email"]) ?></td>
                        <td><?= htmlspecialchars($utilisateur["mot_de_passe"]) ?></td>
                        <td>
                            <a href="modifier_utilisateur_admin.php?id=<?= $utilisateur["id"] ?>" class="btn btn-outline-primary btn-sm">Modifier</a>
                            <a href="supprimer_utilisateur_admin.php?id=<?= $utilisateur["id"] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer cet utilisateur ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Section des tâches -->
        <div class="col-12">
            <h4>Liste des tâches</h4>
            <hr>
            <!-- Tableau affichant la liste des tâches -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Email</th>
                        <th>Date limite</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taches as $tache): ?>
                    <tr>
                        <td><?= htmlspecialchars($tache["titre"]) ?></td>
                        <td><?= htmlspecialchars($tache["description"]) ?></td>
                        <td><?= htmlspecialchars($tache["email"]) ?></td>
                        <td><?= htmlspecialchars($tache["date_limite"]) ?></td>
                        <td><?= htmlspecialchars($tache["statut"]) ?></td>
                        <td>
                            <a href="modifier_tache_admin.php?id=<?= $tache["tache_id"] ?>" class="btn btn-outline-primary btn-sm">Modifier</a>
                            <a href="supprimer_tache_admin.php?id=<?= $tache["tache_id"] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer cette tâche ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Pied de page -->
<footer class="text-center mt-4">
    <p>&copy; 2024 — Tous droits réservés.</p>
</footer>

<!-- Script Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
