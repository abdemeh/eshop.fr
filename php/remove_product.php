<?php
include 'bddData.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST["product_id"];
    $product_img_path = "../img/produits/" . $product_id . ".jpg";

    $sql = "DELETE FROM produits WHERE id = $product_id";


    if ($conn->query($sql) === TRUE) {
        if (file_exists($product_img_path)) {
            unlink($product_img_path);
        } else {
            echo "File does not exist.";
        }
        $conn->close();
        header('Location: ../produits_edit.php?success=Le produit a été supprimé avec succès.');
    } else {
        header('Location: ../produits_edit.php?error=Erreur lors de la suppression du produit: ' . $conn->error);
    }
}
?>
