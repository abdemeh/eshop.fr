<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'bddData.php';
include_once 'main.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $genre = isset($_POST["genre"]) ? $_POST["genre"] : "";
    $date_naissance = $_POST["date_naissance"];
    $metier = $_POST["metier"];
    $errors = [];

    if (empty($nom)) {
        $errors["nom"] = "Veuillez entrer un nom!";
    }
    if (empty($prenom)) {
        $errors["prenom"] = "Veuillez entrer un prénom!";
    }
    if (empty($email)) {
        $errors["email"] = "Veuillez entrer un email!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Veuillez entrer un email valide!";
    }
    if (empty($mdp)) {
        $errors["mdp"] = "Veuillez entrer un mot de passe!";
    }
    if (empty($date_naissance)) {
        $errors["date_naissance"] = "Veuillez entrer une date!";
    }
    if (empty($genre)) {
        $errors["genre"] = "Veuillez sélectionner un genre!";
    }
    if ($metier == "Sélectionner") {
        $errors["metier"] = "Veuillez choisir un métier!";
    }

    if (!empty($errors)) {
        echo json_encode([
            'success' => 0,
            'message' => 'Validation error',
            'errors' => $errors
        ]);
    } else {
        $sql = "UPDATE users SET nom='$nom', prenom='$prenom', email='$email', mdp='" . md5($mdp) . "', genre='$genre', date_naissance='$date_naissance', metier_id=$metier WHERE id={$_SESSION['user_id']}";

        if ($conn->query($sql) === TRUE) {
            echo json_encode([
                'success' => 1,
                'message' => 'Données utilisateur mises à jour avec succès.'
            ]);
        } else {
            echo json_encode([
                'success' => 0,
                'message' => 'Erreur lors de la mise à jour des données utilisateur.'
            ]);
        }
        $conn->close();
    }
} else {
    echo json_encode([
        'success' => 0,
        'message' => 'Invalid request.'
    ]);
}
?>
