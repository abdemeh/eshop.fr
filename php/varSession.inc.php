<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chemin vers le fichier JSON
$jsonFilePath = __DIR__ . '/../json/categories.json';

// Vérifier si le fichier JSON existe
if (file_exists($jsonFilePath)) {
    // Lire le contenu du fichier JSON
    $jsonContents = file_get_contents($jsonFilePath);

    // Convertir le contenu JSON en tableau PHP
    $categories = json_decode($jsonContents, true);

    // Vérifier si le décodage JSON a réussi
    if ($categories === null) {
        echo "Erreur : Impossible de décoder le contenu JSON.";
        exit;
    }
} else {
    echo "Erreur : Le fichier JSON n'existe pas.";
    exit;
}

// Stocker les catégories dans la session
$_SESSION['categories'] = $categories;
?>
