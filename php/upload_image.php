<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['destination_folder']) && isset($_POST['original_page']) && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = $_SESSION['user_id'] . '.jpg';
    if(isset($_POST['product_id'])){
        $fileName = $_POST['product_id'] . '.jpg';
    }
    $original_page = $_POST["original_page"];
    $destination_folder = $_POST["destination_folder"];
    $destination = $destination_folder . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        echo json_encode([
            'success' => 1,
            'message' => 'Fichier téléchargé avec succès.'
        ]);
    } else {
        echo json_encode([
            'success' => 0,
            'message' => 'Échec du téléchargement du fichier.'
        ]);
    }
} else {
    echo json_encode([
        'success' => 0,
        'message' => 'Erreur du téléchargement du fichier.'
    ]);
}
?>
