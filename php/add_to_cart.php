<?php
session_start();
include 'bddData.php';

if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    $userId = $_SESSION['user_id'];
    
    $count_panier=0;

    $query = "INSERT INTO commande (user_id, product_id, quantity, order_state, order_date) VALUES ($userId, $productId, $quantity, 'in_cart', NOW())";
    
    if ($conn->query($query) === TRUE) {
        $updateQuery = "UPDATE produits SET stock = stock - $quantity WHERE id = $productId";
        $conn->query($updateQuery);
        
        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            $sql_count = "SELECT COUNT(*) AS count_panier FROM commande WHERE user_id = $user_id AND order_state='in_cart'";
            $result = $conn->query($sql_count);
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $count_panier = $row["count_panier"];
            }
        }

        echo json_encode([
            'success' => 1,
            'message' => 'Product added to cart successfully.',
            'quantity'=> $quantity,
            'cart_nb_products' => $count_panier,
        ]);
    } else {
        echo json_encode([
            'success' => 0,
            'message' => 'Failed to add product to cart.',
            'quantity'=> 0,
            'cart_nb_products' => 0,
        ]);
    }

    $conn->close();
} else {
    echo json_encode([
        'success' => 0,
        'message' => 'Invalid request.',
        'quantity'=> 0,
        'cart_nb_products' => 0,
    ]);
}
?>
