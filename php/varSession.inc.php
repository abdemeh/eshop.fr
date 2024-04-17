<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'bddData.php';

try {
    // Create connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement to fetch categories and associated products
    $stmt = $conn->prepare("SELECT c.libelle AS categorie, p.* FROM categorie c JOIN produits p ON c.id = p.categorie_id");
    // Execute the query
    $stmt->execute();
    // Fetch all rows
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Group products by category
    $categories = [];
    foreach ($products as $product) {
        $category = $product['categorie'];
        unset($product['categorie']);
        $categories[$category][] = $product;
    }

    // Store categories and products in the session
    $_SESSION['categories'] = $categories;

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
