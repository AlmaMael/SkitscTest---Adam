<?php
include 'db.php';


try {
    $select_sql = "SELECT courriel, motpasse FROM utilisateur";
    $select_stmt = $connexion->query($select_sql);
    $utilisateurs = $select_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($utilisateurs as $utilisateur) {
        $hashed_password = password_hash($utilisateur['motpasse'], PASSWORD_DEFAULT);
        
        $update_sql = "UPDATE utilisateur SET motpasse = :motpasse WHERE courriel = :courriel";
        $update_stmt = $connexion->prepare($update_sql);
        $update_stmt->bindParam(':motpasse', $hashed_password, PDO::PARAM_STR);
        $update_stmt->bindParam(':courriel', $utilisateur['courriel'], PDO::PARAM_STR);
        $update_stmt->execute();
        
        echo "Le mot de passe pour {$utilisateur['courriel']} a été effectué.<br>";
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>