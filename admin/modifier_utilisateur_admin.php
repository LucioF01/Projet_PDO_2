<?php
require_once "../db.php";

// Vérifie si l'ID de l'utilisateur est passé dans l'URL
if (!isset($_GET['id'])) {
    die("ID de l'utilisateur manquant !");
}

$id = $_GET['id'];

// Récupère les informations de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$id]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    die("Aucun utilisateur trouvé avec cet ID !");
}

// Traitement du formulaire de modification
if (isset($_POST['modifier'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Mise à jour des informations de l'utilisateur
    $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, mot_de_passe = ? WHERE id = ?");
    $stmt->execute([$nom, $prenom, $email, $mot_de_passe, $id]);

    // Redirige vers la page d'accueil après modification
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="../css/modifier.css">
</head>
<body>

<form method="POST">
    <h2>Modifier un utilisateur</h2>
    <hr>

    <!-- Champ pour le nom de l'utilisateur -->
    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>

    <!-- Champ pour le prénom de l'utilisateur -->
    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" required>

    <!-- Champ pour l'email de l'utilisateur -->
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>

    <!-- Champ pour le mot de passe de l'utilisateur -->
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" value="<?= htmlspecialchars($utilisateur['mot_de_passe']) ?>" required>

    <!-- Bouton de soumission du formulaire -->
    <button type="submit" name="modifier">Modifier</button>
    <!-- Bouton de retour vers la page d'accueil -->
    <input type="button" onclick="window.location.href = 'index_admin.php';" value="Retour">
</form>

</body>
</html>
