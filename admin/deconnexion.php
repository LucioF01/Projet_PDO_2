<?php   // page à annoter
session_start();    // question: pourquoi () ?

session_destroy();

header("Location: ../index.php");
echo "<a href='../index.php'>Cliquez ici si vous n'êtes pas redirigé</a>";
exit();
?>