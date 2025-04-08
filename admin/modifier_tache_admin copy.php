<?php
require_once "../db.php";

if (!isset($_GET['id'])) {
    die("ID de la tâche manquante !");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM taches WHERE id = ?");
$stmt->execute([$id]);
$tache = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tache) {
    die("Aucune tâche trouvée avec cet ID !");
}

if (isset($_POST['modifier'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_limite = $_POST['date_limite'];
    $statut = $_POST['statut'];

    $stmt = $pdo->prepare("UPDATE taches SET titre = ?, description = ?, date_limite = ?, statut = ? WHERE id = ?");
    $stmt->execute([$titre, $description, $date_limite, $statut, $id]);

    header("Location: index_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Tâche</title>
    <link rel="stylesheet" href="../css/modifier.css">
</head>
<body>

<form method="POST">
    <h2>Modifier une Tâche</h2>
    <hr>

    <input type="text" name="titre" value="<?= htmlspecialchars($tache['titre']) ?>" required>
    <textarea name="description" required><?= htmlspecialchars($tache['description']) ?></textarea>
    <input type="date" name="date_limite" value="<?= htmlspecialchars($tache['date_limite']) ?>" required>

    <select name="statut" required>
        <option value="En attente" <?= $tache['statut'] === 'En attente' ? 'selected' : '' ?>>En attente</option>
        <option value="Terminée" <?= $tache['statut'] === 'Terminée' ? 'selected' : '' ?>>Terminée</option>
    </select>

    <button type="submit" name="modifier">Modifier</button>
    <input type="button" onclick="window.location.href = 'index_admin.php';" value="Retour">
</form>

</body>
</html>
