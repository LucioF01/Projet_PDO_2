<?php
require_once "../db.php";

if (!isset($_GET['id'])) {
    die("ID de la tache manquant !");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM taches WHERE id = ?");
$stmt->execute([$id]);

header("Location: index_admin.php");
exit();
?>
