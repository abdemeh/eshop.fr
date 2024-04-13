<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$categories = array(
    "Téléphones" => array(
        array(
            "Photo" => "../img/produits/Téléphones/T01_I15P",
            "Référence" => "T01_I15P",
            "Description" => "iPhone 15 Pro Max",
            "Prix" => 1184.99,
            "Stock" => 5
        ),
        array(
            "Photo" => "../img/produits/Téléphones/T02_SGS24",
            "Référence" => "T02_SGS24",
            "Description" => "Samsung Galaxy S24 Ultra",
            "Prix" => 1084.99,
            "Stock" => 3
        ),
        array(
            "Photo" => "../img/produits/Téléphones/T03_X13T",
            "Référence" => "T03_X13T",
            "Description" => "Xiaomi 13T",
            "Prix" => 649.99,
            "Stock" => 7
        ),
        array(
            "Photo" => "../img/produits/Téléphones/T04_HP60P",
            "Référence" => "T04_HP60P",
            "Description" => "Huawei P60 Pro",
            "Prix" => 999.99,
            "Stock" => 7
        ),
        array(
            "Photo" => "../img/produits/Téléphones/T05_SGZF4",
            "Référence" => "T05_SGZF4",
            "Description" => "Samsung Galaxy Z Flip 5",
            "Prix" => 1049.99,
            "Stock" => 7
        )
    ),
    "Ordinateurs" => array(
        array(
            "Photo" => "../img/produits/Ordinateurs/O01_MBP16",
            "Référence" => "O01_MBP16",
            "Description" => "MacBook Pro 16",
            "Prix" => 2399.99,
            "Stock" => 5
        ),
        array(
            "Photo" => "../img/produits/Ordinateurs/O02_MAP13",
            "Référence" => "O02_MBA13",
            "Description" => "MacBook Air 13",
            "Prix" => 1799.99,
            "Stock" => 3
        ),
        array(
            "Photo" => "../img/produits/Ordinateurs/O03_SURFPRO8",
            "Référence" => "O03_SURFPRO8",
            "Description" => "Microsoft Surface Pro 8",
            "Prix" => 1299.99,
            "Stock" => 7
        ),
        array(
            "Photo" => "../img/produits/Ordinateurs/O04_DELLXPS",
            "Référence" => "O04_DELLXPS",
            "Description" => "Dell XPS 15",
            "Prix" => 1799.99,
            "Stock" => 5
        ),
        array(
            "Photo" => "../img/produits/Ordinateurs/O05_HPOMEN",
            "Référence" => "O05_HPOMEN",
            "Description" => "HP Omen 15",
            "Prix" => 1099.99,
            "Stock" => 7
        )
    ),
    "Montres connectées" => array(
        array(
            "Photo" => "../img/produits/Montres connectées/M01_APSE6",
            "Référence" => "M01_APSE6",
            "Description" => "Apple Watch SE 6",
            "Prix" => 349.99,
            "Stock" => 5
        ),
        array(
            "Photo" => "../img/produits/Montres connectées/M02_SWGA2",
            "Référence" => "M02_SWGA2",
            "Description" => "Samsung Galaxy Active 2",
            "Prix" => 100.99,
            "Stock" => 3
        ),
        array(
            "Photo" => "../img/produits/Montres connectées/M03_FITV4",
            "Référence" => "M03_FITV4",
            "Description" => "Fitbit Versa 4",
            "Prix" => 199.99,
            "Stock" => 7
        ),
        array(
            "Photo" => "../img/produits/Montres connectées/M04_GARMINVIVO",
            "Référence" => "M04_GARMINVIVO",
            "Description" => "Garmin Vivoactive 4",
            "Prix" => 249.99,
            "Stock" => 5
        ),
        array(
            "Photo" => "../img/produits/Montres connectées/M05_HUAWEIGT",
            "Référence" => "M05_HUAWEIGT",
            "Description" => "Huawei GT 2",
            "Prix" => 179.99,
            "Stock" => 7
        )
    )
);

// Stockez les catégories dans la session
$_SESSION['categories'] = $categories;
?>
