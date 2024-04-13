<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'varSession.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>eShop.fr</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../img/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="robots" content="noindex, follow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="active">
        <div class="p-4 pt-5">
            <a href="index.php" class="img logo rounded-circle mb-5" style="background-image: url(../img/profile.svg);"></a>
            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="index.php">Accueil</a>
                </li>
                <?php
                // Parcourez les catégories et générez le menu de manière dynamique
                foreach ($categories as $category => $products) {
                    echo '<li>';
                    echo '<a href="#">' . $category . '</a>';
                    echo '</li>';
                }
                ?>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn">
                    <i class="fa fa-bars-staggered"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars-staggered"></i>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="../img/logo.png" class="ml-2" height="30" alt="">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <?php
                        // Parcourez les catégories et générez le menu de manière dynamique
                        foreach ($categories as $category => $products) {
                            $encodedCategory = urlencode($category);
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="produits.php?cat=' . $encodedCategory . '">' . $category . '</a>';
                            echo '</li>';
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="login.php"><i class="fa fa-user-circle"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#"><i class="fa fa-cart-shopping"></i></a>
                    </li>
                </ul>
            </div>
        </nav>