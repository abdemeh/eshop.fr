<?php
session_start();

// Check if productId and quantity are sent via POST request
if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    // Retrieve productId and quantity from the form data
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    // Check if 'panier' session exists, if not, create it
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Add the product to 'panier' session
    $_SESSION['panier'][$productId] = $quantity;

    // Redirect back to the page after adding to cart
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Handle error if productId and quantity are not provided
    echo "Invalid request!";
}
?>
