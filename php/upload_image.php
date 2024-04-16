<?php
session_start();

// Check if file is uploaded
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = $_SESSION['user_id'] . '.jpg';
    $destination = '../img/users/' . $fileName;

    // Move the uploaded file to the destination folder
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        header('Location: ../profile.php?success=Fichier téléchargé avec succès.');
    } else {
        header('Location: ../profile.php?error=Échec du téléchargement du fichier.');
    }
} else {
    header('Location: ../profile.php?error=Aucun fichier téléchargé.');
}
?>
