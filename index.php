<?php
include 'php/header.php';
?>
<div class="container">
    <h1 class="text-center font-weight-bold">Bienvenue à <img height="46px" src="img/logo.png" alt=""></h1>
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/home-image-1.png" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h4 class="text-light">iPhone 15</h4>
                    <p class="text-light">Les nouveaux modèles d'iPhone 15 dans notre magasin</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/home-image-2.png" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h4 class="text-light">Macbook Pro M3</h4>
                    <p>Le puissant ordinateur portable et le dernier produit d'Apple</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/home-image-3.png" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h4 class="text-light">Samsung Galaxy S24 Ultra</h4>
                    <p>Les nouveaux modèles de téléphones phares Samsung</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <section class="features-icons bg-light text-center mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex"><i class="fa fa-list m-auto text-primary"></i></div>
                        <p class="h3">Catalogue de produits</p>
                        <p class="lead mb-0">Découvrez notre sélection de produits dans notre catalogue.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex"><i class="fa fa-users m-auto text-primary"></i></div>
                        <p class="h3">Obtenez votre compte</p>
                        <p class="lead mb-0">Créez votre compte pour accéder à nos services.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <div class="features-icons-icon d-flex"><i class="fa fa-phone m-auto text-primary"></i></div>
                        <p class="h3">Appelez-nous</p>
                        <p class="lead mb-0">N'hésitez pas à nous contacter pour toute questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</div>
</div>
<?php include 'php/footer.php'; ?>
