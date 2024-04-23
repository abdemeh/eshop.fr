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
            'success' => true,
            'message' => 'Image téléchargée avec succès.',
            'image_location'=> $destination
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Échec du téléchargement de l\'image.',
            'image_location'=> $destination
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur du téléchargement de l\'image.',
        'image_location'=> $destination
    ]);
}
?>
