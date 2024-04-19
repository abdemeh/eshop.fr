<?php
session_start();
include "../php/bddData.php";

if(isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE verification_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $token = $conn->real_escape_string($token);
        $update_stmt = $conn->prepare("UPDATE users SET verification_date =  NOW() WHERE verification_token = '$token'");
        $update_stmt->execute();
        header('Location: ../login.php?success=Votre adresse e-mail a été vérifiée. Vous pouvez maintenant accéder à votre compte.');
    } else {
        header('Location: ../login.php?error=Erreur, le token est invalide.');
    }
} else {
    header('Location: ../login.php?error=Erreur, le token est invalide.');
}
?>
