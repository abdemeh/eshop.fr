<?php
session_start();
include 'bddData.php';

if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];


    $userId = $_SESSION['user_id'];

    $query = "INSERT INTO user_cart (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";

    if ($conn->query($query) === TRUE) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $conn->close();
} else {
    echo "Invalid request!";
}
?>
