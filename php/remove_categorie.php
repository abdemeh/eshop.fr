<?php
include 'bddData.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categorie_id'])) {
    $categorie_id = $_POST["categorie_id"];

    echo $categorie_id;

    $sql = "DELETE FROM categorie WHERE id = $categorie_id";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ../produits_edit.php?success=La catégorie a été supprimée avec succès.');
    } else {
        header('Location: ../produits_edit.php?error=Erreur lors de la suppression du catégorie: ' . $conn->error);
    }
}
?>
