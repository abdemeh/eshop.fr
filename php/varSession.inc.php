<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définition des catégories avec les identifiants pour chaque produit
$categories = array(
    "Téléphones" => array(
        array(
            "id" => "1",
            "Photo" => "../img/produits/1.jpg",
            "Référence" => "T01_I15P",
            "Description" => "iPhone 15 Pro Max",
            "Prix" => 1184.99,
            "Stock" => 5
        ),
        array(
            "id" => "2",
            "Photo" => "../img/produits/2.jpg",
            "Référence" => "T02_SGS24",
            "Description" => "Samsung Galaxy S24 Ultra",
            "Prix" => 1084.99,
            "Stock" => 3
        ),
        array(
            "id" => "3",
            "Photo" => "../img/produits/3.jpg",
            "Référence" => "T03_X13T",
            "Description" => "Xiaomi 13T",
            "Prix" => 649.99,
            "Stock" => 7
        ),
        array(
            "id" => "4",
            "Photo" => "../img/produits/4.jpg",
            "Référence" => "T04_HP60P",
            "Description" => "Huawei P60 Pro",
            "Prix" => 999.99,
            "Stock" => 7
        ),
        array(
            "id" => "5",
            "Photo" => "../img/produits/5.jpg",
            "Référence" => "T05_SGZF4",
            "Description" => "Samsung Galaxy Z Flip 5",
            "Prix" => 1049.99,
            "Stock" => 7
        )
    ),
    "Ordinateurs" => array(
        array(
            "id" => "6",
            "Photo" => "../img/produits/6.jpg",
            "Référence" => "O01_MBP16",
            "Description" => "MacBook Pro 16",
            "Prix" => 2399.99,
            "Stock" => 5
        ),
        array(
            "id" => "7",
            "Photo" => "../img/produits/7.jpg",
            "Référence" => "O02_MBA13",
            "Description" => "MacBook Air 13",
            "Prix" => 1799.99,
            "Stock" => 3
        ),
        array(
            "id" => "8",
            "Photo" => "../img/produits/8.jpg",
            "Référence" => "O03_SURFPRO8",
            "Description" => "Microsoft Surface Pro 8",
            "Prix" => 1299.99,
            "Stock" => 7
        ),
        array(
            "id" => "9",
            "Photo" => "../img/produits/9.jpg",
            "Référence" => "O04_DELLXPS",
            "Description" => "Dell XPS 15",
            "Prix" => 1799.99,
            "Stock" => 5
        ),
        array(
            "id" => "10",
            "Photo" => "../img/produits/10.jpg",
            "Référence" => "O05_HPOMEN",
            "Description" => "HP Omen 15",
            "Prix" => 1099.99,
            "Stock" => 7
        )
    ),
    "Montres connectées" => array(
        array(
            "id" => "11",
            "Photo" => "../img/produits/11.jpg",
            "Référence" => "M01_APSE6",
            "Description" => "Apple Watch SE 6",
            "Prix" => 349.99,
            "Stock" => 5
        ),
        array(
            "id" => "12",
            "Photo" => "../img/produits/12.jpg",
            "Référence" => "M02_SWGA2",
            "Description" => "Samsung Galaxy Active 2",
            "Prix" => 100.99,
            "Stock" => 3
        ),
        array(
            "id" => "13",
            "Photo" => "../img/produits/13.jpg",
            "Référence" => "M03_FITV4",
            "Description" => "Fitbit Versa 4",
            "Prix" => 199.99,
            "Stock" => 7
        ),
        array(
            "id" => "14",
            "Photo" => "../img/produits/14.jpg",
            "Référence" => "M04_GARMINVIVO",
            "Description" => "Garmin Vivoactive 4",
            "Prix" => 249.99,
            "Stock" => 5
        ),
        array(
            "id" => "15",
            "Photo" => "../img/produits/15.jpg",
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
