<?php
session_start();

// Check if file is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['destination_folder']) && isset($_POST['original_page']) && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = $_SESSION['user_id'] . '.jpg';
    if(isset($_POST['product_id'])){
        $fileName = $_POST['product_id'] . '.jpg';
    }
    $original_page=$_POST["original_page"];
    $destination_folder=$_POST["destination_folder"];
    $destination = $destination_folder . $fileName;
    // Move the uploaded file to the destination folder
    echo $original_page;
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        header('Location: '.$original_page.'?success=Fichier téléchargé avec succès.');
    } else {
        header('Location: '.$original_page.'?error=Échec du téléchargement du fichier.');
    }
} else {
    header('Location: ../profile.php?error=Erreur...');
}
?>
