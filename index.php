<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'php/varSession.inc.php';
?>
<!doctype html>
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
	</head>
	<body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<div class="p-4 pt-5">
					<a href="index.php" class="img logo rounded-circle mb-5" style="background-image: url(img/profile.svg);"></a>
					<ul class="list-unstyled components mb-5">
						<li class="active">
							<a href="#">Accueil</a>
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
								<li class="nav-item active">
									<a class="nav-link" href="#">Accueil</a>
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
							<li class="nav-item">
								<a class="nav-link nav-link-icon" href="login.php"><i class="fa fa-user-circle"></i></a>
							</li>
							<li class="nav-item">
								<a class="nav-link nav-link-icon" href="#"><i class="fa fa-cart-shopping"></i></a>
							</li>
						</ul>
					</div>
				</nav>
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