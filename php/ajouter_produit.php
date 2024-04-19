<?php
include 'bddData.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST["product_id"];
    $reference = $_POST["reference"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $stock = $_POST["stock"];
    $categorie_id = $_POST["categorie"];

    $sql = "INSERT INTO produits (id, reference, description, prix, stock, categorie_id) VALUES ($product_id, '$reference', '$description', $prix, $stock, $categorie_id)";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ../produits_edit.php?success=Le produit a été ajouté avec succès.');
    } else {
        $conn->close();
        header("Location: ../produits_edit.php?error=Erreur lors de l'ajout du produit: ".$conn->error);
    }
}
?>
