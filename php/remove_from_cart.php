<?php
session_start();

include 'bddData.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Assurez-vous de récupérer l'ID de l'utilisateur

    // Utilisation des variables directement dans la requête
    $query = "DELETE FROM user_cart WHERE product_id = $product_id AND user_id = $user_id";

    if ($conn->query($query) === TRUE) {
        header('Location: ../panier.php');
        exit();
    } else {
        header('Location: ../panier.php');
        exit();
    }

    $conn->close();
} else {
    header('Location: ../panier.php');
    exit();
}
?>
