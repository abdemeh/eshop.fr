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

            header('Location: ../panier.php');
            exit();
        } else {
            header('Location: ../panier.php');
            exit();
        }
    } else {
        // Le produit n'est pas trouvé dans le panier de l'utilisateur
        header('Location: ../panier.php');
        exit();
    }

    $conn->close();
} else {
    header('Location: ../panier.php');
    exit();
}
?>
