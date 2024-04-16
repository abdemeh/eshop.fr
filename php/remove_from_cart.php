<?php
session_start();

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    if (isset($_SESSION['panier'][$productId])) {
        unset($_SESSION['panier'][$productId]);
    }
}

// Redirect back to the cart page
header('Location: ../panier.php');
exit();
?>