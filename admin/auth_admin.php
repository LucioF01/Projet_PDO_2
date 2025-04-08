<?php
// Inclusion de la connexion PDO
include "../db.php"; //  include suffit ici, sauf si db.php peut être inclus plusieurs fois (dans ce cas : require_once)

session_start();

// Données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

try {
    // Requête SQL pour trouver l'utilisateur par email
    $query = "SELECT id, email, mot_de_passe FROM admin WHERE email = :email";
    $stmt = $pdo->prepare($query); //  On prépare avec $pdo
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Récupère les données de l'utilisateur
    $admin = $stmt->fetch(PDO::FETCH_ASSOC); //  fetch = récupérer une ligne sous forme de tableau associatif

    if ($admin) {
        // Vérifie si le mot de passe correspond au hash enregistré
        if ($mot_de_passe == $admin['mot_de_passe']) {
            // Authentification réussie
            $_SESSION['admin_email'] = $admin['email'];
            $_SESSION['admin_id'] = $admin['id'];

            echo "Connexion réussie. Bienvenue, " . htmlspecialchars($admin['email']) . "!<br>";
            header('Location: index_admin.php');
            exit(); // On arrête ici pour éviter que le reste du code s'affiche
        } else {
            echo "Mot de passe incorrect. Veuillez réessayer.<br>";
            echo "<a href='connexion_admin.php'>Retour</a>";
        }
    } else {
        echo "Admin introuvable. Vérifiez votre adresse e-mail.<br>";
        echo "<a href='connexion_admin.php'>Retour</a>";
    }
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des données : " . $e->getMessage();
}
?>
