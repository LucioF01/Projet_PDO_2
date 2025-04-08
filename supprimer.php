<?php
// Inclusion du fichier de connexion à la base de données
include "db.php";

$id = $_GET['id'];

// Récupération des données du contact actuel
$stmt = $pdo->prepare("DELETE FROM taches WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

echo "Tâche supprimer avec succès !";
header("Location: index.php"); // Redirection après mise à jour
echo "<a href='index.php'>Cliquez ici si vous n'êtes pas redirigé</a>";
exit();
?>
