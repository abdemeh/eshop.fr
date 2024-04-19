<?php
include 'bddData.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST["product_id"];
    $reference = $_POST["reference"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $stock = $_POST["stock"];
    $categorieId = $_POST["categorie"];

    $sql = "UPDATE produits SET reference = '$reference', description = '$description', prix = $prix, stock = $stock, categorie_id = $categorieId WHERE id = $product_id";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ../produits_edit.php?success=Toutes les modifications ont été enregistrées.');
    } else {
        $conn->close();
        header('Location: ../produits_edit.php?error=Erreur lors de la mise à jour du produit: '.$conn->error);
    }
}
?>
