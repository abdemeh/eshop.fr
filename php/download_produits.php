<?php
include 'bddData.php';

$sql = "SELECT p.reference, p.description, p.prix, p.stock, c.libelle AS categorie_libelle 
        FROM produits AS p 
        INNER JOIN categorie AS c ON p.categorie_id = c.id";

$result = $conn->query($sql);

$filename = "produits.csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

fwrite($output, "\xEF\xBB\xBF");

fputcsv($output, array('Reference', 'Description', 'Prix', 'Stock', 'Categorie Libelle'));

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_walk($row, function(&$value, $key) {
            $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        });
        fputcsv($output, $row);
    }
} else {
    fputcsv($output, array('', '', '', '', ''));
}

fclose($output);

$conn->close();
?>
