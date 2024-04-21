<?php

// Start session and perform header-related logic first
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_role'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_role'] = $_COOKIE['user_role'];
}

include "php/varSession.inc.php";

$current_page = basename($_SERVER["PHP_SELF"]);
if (
    !isset($_SESSION["user_id"]) &&
    $current_page !== "login.php" &&
    $current_page !== "index.php" &&
    $current_page !== "contact.php" &&
    $current_page !== "sign_up.php"
) {
    header("Location: login.php");
    exit();
}
if (
    isset($_SESSION["user_role"]) &&
    $_SESSION["user_role"] == "admin" &&
    $current_page !== "admin.php" &&
    $current_page !== "settings.php" &&
    $current_page !== "produits_edit.php" &&
    $current_page !== "commandes.php" &&
    $current_page !== "profile.php" 
) {
    header("Location: admin.php");
    exit();
}

if (
    isset($_SESSION["user_role"]) &&
    $_SESSION["user_role"] != "admin" &&
    (
    $current_page == "admin.php" ||
    $current_page == "produits_edit.php" ||
    $current_page == "settings.php"
    )
) {
    header("Location: index.php");
    exit();
}

include "php/bddData.php";

// Récupération des informations de l'utilisateur depuis la base de données
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nom = $row["nom"];
        $prenom = $row["prenom"];
        $email = $row["email"];
        $mdp = $row["mdp"];
        $genre = $row["genre"];
        $date_naissance = $row["date_naissance"];
        $metier = $row["metier_id"];
    }
}

// Récupération des catégories de produits depuis la base de données
$categories = [];
$sql_categories = "SELECT * FROM categorie";
$result_categories = $conn->query($sql_categories);

if ($result_categories->num_rows > 0) {
    while ($row_category = $result_categories->fetch_assoc()) {
        $category_id = $row_category["id"];
        $category_libelle = $row_category["libelle"];
        $category_icon = $row_category["icon"];

        // You can add more category information as needed
        $categories[$category_id] = array(
            "libelle" => $category_libelle,
            "icon" => $category_icon,
            // Add more fields if necessary
        );
    }
}

$count_panier=0;
// Récupération des produits de panier
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT COUNT(*) AS count_panier FROM commande WHERE user_id = $user_id AND order_state='in_cart'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count_panier = $row["count_panier"];
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>eShop.fr</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="robots" content="noindex, follow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    
<div id="preloader">
  <div class="spinner-grow text-primary" role="status">
  </div>
</div>

<script>
window.addEventListener('load', function () {
  const preloader = document.getElementById('preloader');
  setTimeout(function () {
    preloader.style.opacity = '0';
    setTimeout(function () {
      preloader.style.display = 'none';
    }, 500);
  }, 500);
});
</script>

<div class="wrapper d-flex align-items-stretch">
<nav class="sidebar_new close border-right">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="img/logo.png" alt="">
                </span>
                <div class="text logo-text">
                    <span class="name">eshop.fr</span>
                    <span class="profession">Site ecommerce</span>
                </div>
            </div>
            <i class="fa-solid fa-angle-right toggle"></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <?php
                        if((isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                            echo '<li class="nav-link"><a href="admin.php"><i class="fa-solid fa-chart-line icon"></i><span class="text nav-text">Tableau de bord</span></a></li>';
                            echo '<li class="nav-link"><a href="produits_edit.php"><i class="fa-solid fa-tags icon"></i><span class="text nav-text">Produits/Catégories</span></a></li>';
                            echo '<li class="nav-link"><a href="commandes.php"><i class="fa-solid fa-bag-shopping icon"></i><span class="text nav-text">Commandes</span></a></li>';
                        }
                        else{
                            echo '<li class="nav-link"><a href="index.php"><i class="fa-solid fa-house icon"></i><span class="text nav-text">Accueil</span></a></li>';
                            foreach ($categories as $category_id => $category) {
                                $encodedCategory = urlencode($category["libelle"]);
                                echo '<li class="nav-link"><a href="produits.php?cat='.$encodedCategory.'"><i class="'.$category["icon"].' icon"></i><span class="text nav-text">'.$category["libelle"].'</span></a></li>';
                            }
                        }
                    ?> 
                </ul>
            </div>
            <div class="bottom-content">
            <?php
                        if((isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                            echo '<li class="nav-link"><a href="settings.php"><i class="fa-solid fa-gear icon"></i><span class="text nav-text">Paramètres</span></a></li>';
                            if (isset($_SESSION["user_id"])) {
                                $userImagePath = "img/users/{$_SESSION["user_id"]}.jpg";
                                if (file_exists($userImagePath)) {
                                    echo '<li class="nav-link"><a href="profile.php"><img id="small-icon-user-image" class="logo rounded-circle ml-3" src="'.$userImagePath.'" height="30px" width="30px" alt=""><span class="text nav-text ml-3">Profil</span></a></li>';
                                } else {
                                    echo '<li class="nav-link"><a href="profile.php"><i class="fa-solid fa-user icon"></i><span class="text nav-text">Contact</span></a></li>';
                                }
                            } else {
                                echo '<li class="nav-link"><a href="profile.php"><i class="fa-solid fa-user icon"></i><span class="text nav-text">Contact</span></a></li>';
                            }
                        }
                        else{
                            echo '<li class="nav-link"><a href="contact.php"><i class="fa-solid fa-pen-to-square icon"></i><span class="text nav-text">Contact</span></a></li>';
                            if (isset($_SESSION["user_id"])) {
                                $userImagePath = "img/users/{$_SESSION["user_id"]}.jpg";
                                if (file_exists($userImagePath)) {
                                    echo '<li class="nav-link"><a href="profile.php"><img id="small-icon-user-image" class="logo rounded-circle ml-3" src="'.$userImagePath.'" height="30px" width="30px" alt=""><span class="text nav-text ml-3">Profil</span></a></li>';
                                } else {
                                    echo '<li class="nav-link"><a href="profile.php"><i class="fa-solid fa-user icon"></i><span class="text nav-text">Contact</span></a></li>';
                                }
                            } else {
                                echo '<li class="nav-link"><a href="profile.php"><i class="fa-solid fa-user icon"></i><span class="text nav-text">Profil</span></a></li>';
                            }
                            if (isset($_SESSION["user_id"])) {
                                echo '<li class="nav-link"><a href="panier.php"><i class="fa-solid fa-cart-shopping icon" id="icon-panier"><span id="icon-panier-value" class="badge badge-pill badge-primary">'.$count_panier.'</span></i><span class="text nav-text">Panier</span></a></li>';
                        }
                            }
                        if (isset($_SESSION["user_id"])){
                            echo '<li onclick="confirmLogout()" class="nav-link"><a href="#"><i class="fa-solid fa-right-from-bracket icon"></i><span class="text nav-text">Se déconnecter</span></a></li>';
                        }
                    ?>              
            </div>
        </div>
    </nav>
    <div id="content" class="p-4 p-md-5">
        <div class="navbar-brand d-flex justify-content-center">
            <a href="index.php">
                <img src="img/logo.png" class="ml-2" height="30" alt="">
            </a>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars-staggered"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="nav navbar-nav">

                        <?php
                        if((isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                            echo "<a class='nav-link' href='admin.php'>Tableau de bord</a>";
                            echo "<a class='nav-link' href='produits_edit.php'>Produits & Catégories</a>";
                            echo "<a class='nav-link' href='commandes.php'>Commandes</a>";
                            echo "<a class='nav-link' href='profile.php'>Mon profil</a>";
                        }
                        else{
                            echo "<a class='nav-link' href='index.php'>Accueil</a>";
                            foreach ($categories as $category_id => $category) {
                                $encodedCategory = urlencode($category["libelle"]); // Encode the category name
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" href="produits.php?cat=' . $encodedCategory . '">';
                                echo '<span class="text nav-text">' . $category["libelle"] . '</span>';
                                echo '</a>';
                                echo '</li>';
                            }                            
                            echo "<li class='nav-item'><a class='nav-link' href='contact.php'>Contact</a></li>";
                        }
                        ?> 
                    </ul>
                </div>
            </div>
    
            <!-- Modal Logout -->
            <div id="confirmLogoutModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h6 class="text-dark">Êtes-vous sûr de vouloir vous déconnecter?</h6>    
                        </div>
                        <div class="modal-footer">
                            <a href="php/logout.php" class="btn btn-primary">Oui</a>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Non</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
<script>
    function confirmLogout() {
        $('#confirmLogoutModal').modal('show');
    }
</script>
