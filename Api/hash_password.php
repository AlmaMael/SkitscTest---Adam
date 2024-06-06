<?php
include 'db.php';

try {
    $plain_password = 'testtest';
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
    $courriel = 'testAdam@gmail.com';

    $update_sql = "UPDATE utilisateur SET motpasse = :motpasse WHERE courriel = :courriel";
    $update_stmt = $connexion->prepare($update_sql);
    $update_stmt->bindParam(':motpasse', $hashed_password, PDO::PARAM_STR);
    $update_stmt->bindParam(':courriel', $courriel, PDO::PARAM_STR);
    $update_stmt->execute();

    echo "Password for $courriel has been updated to a hashed password.";
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>