<?php
function verifierConnexion($login, $mot_de_passe) {
    $utilisateurs = file("utilisateurs.txt", FILE_IGNORE_NEW_LINES);
    foreach ($utilisateurs as $utilisateur) {
        list($id, $nom, $prenom, $email, $mdp, $genre, $date_naissance, $metier, $role) = explode(":", $utilisateur);
        if ($email === $login && $mdp === $mot_de_passe) {
            session_start();
            $_SESSION['user'] = $nom;
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            return true;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $mot_de_passe = $_POST["mot_de_passe"];
    if (verifierConnexion($login, $mot_de_passe)) {
        header("Location: index.php");
        exit;
    } else {
        $messageErreur = "Login ou mot de passe incorrect.";
        echo $messageErreur;
    }
}
?>
