<?php
include 'bddData.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categorie_id'])) {
    $categorie_libelle = $_POST["categorie_libelle"];
    $categorie_id = $_POST["categorie_id"];

    $sql = "INSERT INTO categorie (id, libelle) VALUES ($categorie_id, '$categorie_libelle')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ../produits_edit.php?success=La catégorie a été ajoutée avec succès.');
    } else {
        $conn->close();
        header("Location: ../produits_edit.php?error=Erreur lors de l'ajout du catégorie: ".$conn->error);
    }
}
?>
