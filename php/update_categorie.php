<?php
include 'bddData.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categorie_id'])) {
    $categorie_id = $_POST["categorie_id"];
    $categorie_libelle = $_POST["categorie_libelle"];
    $categorie_icon = $_POST["select_categorie_icon"];

    $sql = "UPDATE categorie SET libelle = '$categorie_libelle', icon='$categorie_icon' WHERE id = $categorie_id";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header('Location: ../produits_edit.php?success=Toutes les modifications ont été enregistrées.');
    } else {
        $conn->close();
        header('Location: ../produits_edit.php?error=Erreur lors de la mise à jour du catégorie: '.$conn->error);
    }
}
?>
