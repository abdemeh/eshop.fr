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
						<li>
							<a href="index.php">Accueil</a>
						</li>
						<li class="active">
							<a href="#">Téléphones</a>
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
									<a class="nav-link active" href="#">Téléphones</a>
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
					<h1 class="text-center font-weight-bold mb-2">Téléphones</h1>
					<div class="row mb-3 justify-content-end">
						<div class="col-md-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-search"></i></span>
								</div>
								<input type="text" class="form-control" id="searchInput" placeholder="Rechercher...">
							</div>
						</div>
					</div>
					<div>
						<table class="table table-hover" id="productTable">
							<thead>
								<tr>
									<th class="text-center" scope="col">Photo</th>
									<th class="text-center" scope="col">Référence</th>
									<th class="text-center" scope="col">Description</th>
									<th class="text-center" scope="col">Prix</th>
									<th class="text-center table-stock" scope="col">Stock</th>
									<th class="text-center" scope="col">Commande</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T01_I15P.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T01_I15P</td>
									<td class="align-middle text-center">iPhone 15 Pro Max</td>
									<td class="align-middle text-center">1184.99€</td>
									<td class="align-middle text-center table-stock">5</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T02_SGS24.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T02_SGS24</td>
									<td class="align-middle text-center">Samsung Galaxy S24 Ultra</td>
									<td class="align-middle text-center">1084.99€</td>
									<td class="align-middle text-center table-stock">3</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T03_X13T.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T03_X13T</td>
									<td class="align-middle text-center">Xiaomi 13T</td>
									<td class="align-middle text-center">649.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T04_HP60P.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T04_HP60</td>
									<td class="align-middle text-center">Huawei P60 Pro</td>
									<td class="align-middle text-center">999.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T05_SGZF4.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T05_SGZF4</td>
									<td class="align-middle text-center">Samsung Galaxy Z Flip 5</td>
									<td class="align-middle text-center">1049.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T05_SGZF4.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T05_SGZF4</td>
									<td class="align-middle text-center">Samsung Galaxy Z Flip 5</td>
									<td class="align-middle text-center">1049.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T05_SGZF4.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T05_SGZF4</td>
									<td class="align-middle text-center">Samsung Galaxy Z Flip 5</td>
									<td class="align-middle text-center">1049.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T05_SGZF4.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T05_SGZF4</td>
									<td class="align-middle text-center">Samsung Galaxy Z Flip 5</td>
									<td class="align-middle text-center">1049.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T05_SGZF4.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T05_SGZF4</td>
									<td class="align-middle text-center">Samsung Galaxy Z Flip 5</td>
									<td class="align-middle text-center">1049.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T05_SGZF4.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T05_SGZF4</td>
									<td class="align-middle text-center">Samsung Galaxy Z Flip 5</td>
									<td class="align-middle text-center">1049.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
								<tr>
									<th class="align-middle text-center">
										<div class="h-10" ><img class="zoomable-image" src="img/products/tele/T05_SGZF4.jpg" height="100px" alt=""></div>
									</th>
									<td class="align-middle text-center">T05_SGZF4</td>
									<td class="align-middle text-center">Samsung Galaxy Z Flip 5</td>
									<td class="align-middle text-center">1049.99€</td>
									<td class="align-middle text-center table-stock">7</td>
									<td class="align-middle text-center">
										<div class="input-group-wrapper">
											<div class="input-group inline-group">
												<div class="input-group-prepend">
													<button disabled class="btn btn-minus">
													<i class="fa fa-minus"></i>
													</button>
												</div>
												<input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
												<div class="input-group-append">
													<button class="btn btn-plus">
													<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
											<button disabled class="btn btn-add-to-cart mt-2">Ajouter au panier</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<nav aria-label="Page navigation" id="pagination">
							<ul class="pagination justify-content-center">
								<li class="page-item disabled">
									<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
								</li>
								<li class="page-item active"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item">
									<a class="page-link" href="#">Suivant</a>
								</li>
							</ul>
						</nav>
						<div class="container">
							<div class="row">
								<div class="col-md-12 bg-light text-right">
									<button id="btn-cacher-stock" class="btn mt-2">Cacher stock</button>
								</div>
							</div>
						</div>
					</div>
					<div>
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