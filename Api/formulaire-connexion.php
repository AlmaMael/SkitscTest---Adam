<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courriel = trim($_POST['email'] ?? '');
    $mdp = trim($_POST['password'] ?? '');

    if (!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
        echo "Le Courriel est invalide!";
        exit;
    }

    try {
        $sql = "SELECT * FROM utilisateur WHERE courriel = :courriel";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':courriel', $courriel, PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur) {
            $hashed_password = $utilisateur['motpasse'];

            if (password_verify($mdp, $hashed_password)) {
                $_SESSION['courriel'] = $courriel;
                $_SESSION['prenom'] = $utilisateur['prenom'];
                $_SESSION['nom'] = $utilisateur['nom'];

                header('Location: ../dashboard.php');
                echo "success";
                exit;
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "No user found";
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
} else {
    echo "Méthode de requête invalide!";
}

?>
