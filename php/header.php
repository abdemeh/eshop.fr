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
        // Récupérez les autres champs de l'utilisateur de la même manière
    } else {
        echo "Aucun utilisateur trouvé";
    }
}

// Récupération des catégories de produits depuis la base de données
$categories = [];
$sql_categories = "SELECT * FROM categorie";
$result_categories = $conn->query($sql_categories);

if ($result_categories->num_rows > 0) {
    while ($row_category = $result_categories->fetch_assoc()) {
        $category = $row_category["libelle"];
        // Vous pouvez ajouter d'autres informations de catégorie au besoin
        $categories[$category] = []; // Initialisez un tableau vide pour les produits de cette catégorie
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
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
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="active">
        <div class="p-4 pt-5">
            <a href="<?php if (isset($_SESSION["user_id"])) {
                echo "profile.php";
            } else {
                echo "#";
            } ?>" class="img logo rounded-circle mb-2" style="background-image: url(<?php if (isset($_SESSION["user_id"])) {
                                                                                    $userImagePath = "img/users/{$_SESSION["user_id"]}.jpg";
                                                                                    if (file_exists("img/users/{$_SESSION["user_id"]}.jpg")) {
                                                                                        echo "img/users/{$_SESSION["user_id"]}.jpg";
                                                                                    } else {
                                                                                        echo "img/profile.svg";
                                                                                    }
                                                                                } else {
                                                                                    echo "img/profile.svg";
                                                                                } 
            ?>);"></a>
            <div class="text-center">
                <?php if (isset($_SESSION["user_id"])) {
                    echo "<h5 class='mb-0'><a href='profile.php'><b>".$prenom."</b></a></h5>";
                    echo "<h5 class='mb-0'><a href='profile.php'><b>".$nom."</b></a></h5>";
                } ?>
            </div>
            <ul class="list-unstyled components mb-5 mt-5">
                
                <?php
                if(!(isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                        echo"<li><a href='index.php'>Accueil</a></li>";
                    }

                if(!(isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                    foreach ($categories as $category => $products) {
                        $encodedCategory = urlencode($category);
                        echo "<li>";
                        echo '<a href="produits.php?cat=' .
                            $encodedCategory .
                            '">' .
                            $category .
                            "</a>";
                        echo "</li>";
                    }
                }
                ?>
                <?php 
                if(!(isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                    echo "<li><a href='contact.php'>Contact</a></li>";
                    echo "<li><a href='panier.php'>Mon Panier</a></li>";
                }
                ?>
                
                <?php 
                if((isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                    echo '<li><a href="admin.php">Accueil</a></li>';
                    echo '<li><a href="produits_edit.php">Produits & Catégories</a></li>';
                    echo '<li><a href="settings.php">Paramètres</a></li>';

                }
                if (isset($_SESSION["user_id"])) {
                    echo '<li><a href="profile.php">Mon profil</a></li>';
                    echo '<li><a onclick="confirmLogout()" href="#">Se déconnecter</a></li>';
                } 
                ?>
            </ul>
        </div>
    </nav>
    <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars-staggered"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
                <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars-staggered"></i>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="img/logo.png" class="ml-2" height="30" alt="">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="nav navbar-nav">
                        <?php
                        if((isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                            echo "<a class='nav-link' href='admin.php'>Accueil</a>";
                            echo "<a class='nav-link' href='produits_edit.php'>Produits & Catégories</a>";
                            echo "<a class='nav-link' href='profile.php'>Mon profil</a>";
                            // echo "<a class='nav-link' href='settings.php'>Paramètres</a>";
                        }
                        else{
                            echo "<a class='nav-link' href='index.php'>Accueil</a>";
                            foreach ($categories as $category => $products) {
                                $encodedCategory = urlencode($category);
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link" href="produits.php?cat=' .
                                    $encodedCategory .
                                    '">' .
                                    $category .
                                    "</a>";
                                echo "</li>";
                            }
                            echo "<li class='nav-item'><a class='nav-link' href='contact.php'>Contact</a></li>";
                        }
                        ?> 
                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center">
                    <div class="align-middle">
                        <?php if (isset($_SESSION["user_id"])) {
                            echo "<p class='mb-0'> Bienvenue, <a href='profile.php'><b>" .
                                $prenom .
                                "</b></a>!</p>";
                        } ?>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="profile.php">
                            <?php 
                                if (isset($_SESSION["user_id"])) {
                                    $userImagePath = "img/users/{$_SESSION["user_id"]}.jpg";
                                    if (file_exists($userImagePath)) {
                                        echo "<img class='logo rounded-circle' src='$userImagePath' height='30px' width='30px' alt=''>";
                                    } else {
                                        echo "<i class='fa fa-user-circle'></i>";
                                    }
                                } else {
                                    echo "<i class='fa fa-user-circle'></i>";
                                        }
                            ?>
                        </a>
                    </li>
                    <?php 
                        if(!(isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                            echo "<li class='nav-item'><a class='nav-link nav-link-icon' href='panier.php'><i class='fa fa-cart-shopping'></i></a></li>";
                        }
                        if((isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                            // echo "<li class='nav-item'><a class='nav-link nav-link-icon' href='admin.php'><i class='fa-solid fa-chart-simple'></i></a></li>";
                            // echo "<li class='nav-item'><a class='nav-link nav-link-icon' href='produits_edit.php'><i class='fa-solid fa-edit'></i></a></li>";
                            echo "<li class='nav-item'><a class='nav-link nav-link-icon' href='settings.php'><i class='fa-solid fa-gear'></i></a></li>";

                        }
                        if (isset($_SESSION["user_id"])) {
                            echo "<li class='nav-item'><a class='nav-link nav-link-icon' onclick='confirmLogout()' href='#'><i class='fa-solid fa-right-from-bracket'></i></a></li>";
                        }
                    ?>
                </ul>
            </div>
    
            <!-- Modal Logout -->
            <div id="confirmLogoutModal" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <a>Êtes-vous sûr de vouloir vous déconnecter?</a>    
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
