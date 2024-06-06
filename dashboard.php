<?php
session_start();

if (!isset($_SESSION['courriel'])){
    header('Location: index.html');
    exit;
}

$courriel = $_SESSION['courriel'];
$prenom =  $_SESSION['prenom'];
$nom = $_SESSION['nom'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/stylesheet.css"> 
    <title>Document</title>
</head>
<body>
        <div id="centrer">
            <h1>Bienvenue sur le Dashboard<br><?php echo $prenom . ' ' . $nom ?></h1><br>
            <a href="./api/deconnexion.php">Se déconnecter</a>
        </div>
</body>
</html>