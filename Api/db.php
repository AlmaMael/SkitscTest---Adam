<?php 
$nomserveur = "localhost";
$utilisateur = "root";
$password = "";

try{
    $connexion = new PDO("mysql:host=$nomserveur;dbname=skitsctest", $utilisateur, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connexion;
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return null;
}

?>