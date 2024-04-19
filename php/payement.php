<?php
session_start();
include 'bddData.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"]; 

    $sql = "UPDATE commande SET order_date = NOW(), order_state = 'paid' WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ../panier.php?success=Merci pour votre commande. Vous recevrez bientôt un e-mail contenant tous les détails de votre commande.');
    } else {
        $conn->close();
        header('Location: ../panier.php?error=Erreur lors du paiement: '.$conn->error);
    }
}
?>