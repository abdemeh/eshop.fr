<?php 
include 'bddData.php';

if(isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];
    $handle = fopen($file, "r");

    fgetcsv($handle);

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $reference = $data[0];
        $description = $data[1];
        $prix = $data[2];
        $stock = $data[3];
        $categorie_libelle = $data[4];

        $query = "SELECT id FROM categorie WHERE libelle = '$categorie_libelle'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $categorie_id = $row['id'];
        } else {
            $insert_query = "INSERT INTO categorie (libelle) VALUES ('$categorie_libelle')";
            if ($conn->query($insert_query) === TRUE) {
                $categorie_id = $conn->insert_id;
            } else {
                header("Location: ../produits_edit.php?error=Erreur lors de l'insertion de la catégorie: ".$conn->error);
                continue;
            }
        }

        $sql = "INSERT INTO produits (reference, description, prix, stock, categorie_id) VALUES ('$reference', '$description', $prix, $stock, $categorie_id)";

        if ($conn->query($sql) !== TRUE) {
            header("Location: ../produits_edit.php?error=Erreur lors de l'insertion de product: ".$conn->error);
        }
    }

    fclose($handle);
    header("Location: ../produits_edit.php?success=Produits et catégories importés avec succès.");
}

$conn->close();


?>