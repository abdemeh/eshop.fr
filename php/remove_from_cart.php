<?php
session_start();
include 'bddData.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    $query = "SELECT sum(quantity) as quantity FROM commande WHERE product_id = $product_id AND user_id = $user_id";
    $result = $conn->query($query);

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity = $row['quantity'];

        $deleteQuery = "DELETE FROM commande WHERE product_id = $product_id AND user_id = $user_id";
        if ($conn->query($deleteQuery) === TRUE) {
            $updateQuery = "UPDATE produits SET stock = stock + $quantity WHERE id = $product_id";
            $conn->query($updateQuery);

            echo json_encode(['success' => true]);
            exit();
        } else {
            echo json_encode(['error' => 'Failed to remove item from cart']);
            exit();
        }
    } else {
        echo json_encode(['error' => 'Product not found in cart']);
        exit();
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'Product ID not provided']);
    exit();
}
?>
