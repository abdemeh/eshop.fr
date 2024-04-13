<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'php/varSession.inc.php';
?>
<!doctype html>
<html lang="en">

<head>
    <title>eShop.fr - Contactez-nous</title>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active">
            <div class="p-4 pt-5">
                <a href="index.php" class="img logo rounded-circle mb-5" style="background-image: url(img/profile.svg);"></a>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a href="téléphones.php">Téléphones</a>
                    </li>
                    <li>
                        <a href="#">Ordinateurs</a>
                    </li>
                    <li>
                        <a href="#">Montres connectées</a>
                    </li>
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
                        <img src="img/logo.png" class="ml-2" height="30" alt="">
                    </a>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="téléphones.php">Téléphones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Ordinateurs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Montres connectées</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link nav-link-icon" href="#"><i class="fa fa-user-circle"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-icon" href="#"><i class="fa fa-cart-shopping"></i></a>
                        </li>  
                    </ul>
                </div>
            </nav>
            <div class="container">
                <div class="container">
                    <h1 class="text-center font-weight-bold mb-4">Se connecter</h1>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-4">
                            <form id="login-form">
                                <div class="d-flex">
                                    <img src="img/login.svg" class="img-fluid mb-4" alt="">
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div id="login-error"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input id="input-login-email" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="text-danger" id="error-login-email"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                            </div>
                                            <input id="input-login-password" type="password" class="form-control" placeholder="Mot de passe" aria-label="Mot de passe" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="text-danger" id="error-login-password"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-check d-flex justify-content-between align-items-center">
                                            <div>
                                                <input type="checkbox" checked class="form-check-input" id="Se_Souvenir">
                                                <label class="form-check-label" for="Se_Souvenir">Se souvenir de moi</label>
                                            </div>
                                            <div class="ml-auto">
                                                <a class="" href="">Créer un compte</a>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="d-grid gap-2 form-group col-md-12">
                                        <button type="button" class="btn" onclick="validerLogin()">Se connecter</button>
                                    </div>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5">
                <div class="col text-center pb-4 mt-5">
                    <img class="mb-2" src="img/logo-light.png" height="32" alt="">
                    <p class="text-muted text-left">Découvrez notre sélection de smartphones, ordinateurs portables, montres connectées et plus encore! Parcourez notre catalogue dès maintenant pour trouver les produits qui vous conviennent.</p>
                </div>
                <div class="col mt-5">
                    <h5 class="text-white"><b>Plan de site</b></h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Accueil</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Contact</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Se connecter</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Mot de passe oublié</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                    </ul>
                </div>
                <div class="col mt-5">
                    <h5 class="text-white"><b>Catégories</b></h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Toutes les produits</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Téléphones</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Ordinateurs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Montres connectées</a></li>
                    </ul>
                </div>
                <div class="col mt-5">
                    <h5 class="text-white"><b>Contactez-nous</b></h5>
                    <p class="text-muted text-left">N'hésitez pas à nous contacter pour toute questions, suivez-nous sur nos réseaux sociaux:</p>
                    <p>
                        <a href="#" class="social-icon mr-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-icon mr-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon mr-2"><i class="fab fa-x-twitter"></i></a>
                    </p>
                </div>
            </div>
            <div class="col text-center pb-4 mt-4">
                <img class="mb-2" src="img/logo-light.png" height="32" alt="">
                <p class="text-muted">Tous les droits sont réservés © eshop.fr | 2023-2024</p>
            </div>
        </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"86e9bc02babed38b","version":"2024.3.0","token":"cd0b4b3a733644fc843ef0b185f98241"}' crossorigin="anonymous"></script>
</body>

</html>