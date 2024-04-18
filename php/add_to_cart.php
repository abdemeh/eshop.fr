<?php
session_start();
include 'bddData.php';

if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    $userId = $_SESSION['user_id'];

    // Insert the item into the user's cart
    $query = "INSERT INTO user_cart (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";

    if ($conn->query($query) === TRUE) {
        // Update the stock quantity in the products table
        $updateQuery = "UPDATE produits SET stock = stock - $quantity WHERE id = $productId";
        $conn->query($updateQuery);

        // Redirect back to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // If insertion failed, redirect back to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $conn->close();
} else {
    echo "Invalid request!";
}
?>
