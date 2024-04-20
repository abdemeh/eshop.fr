<?php
include 'php/header.php';
include 'php/varSession.inc.php';
include 'php/bddData.php';
include 'php/main.php';

$settings = getSettings();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    header('Location: ../login.php'); // Redirect to login page if user is not logged in
    exit();
}
?>

<div class="container">
    <div class="row">
        <div id="error-message"><?php if (isset($_GET["error"])){
                            echo '<div class="alert alert-danger alert-dismissible" role="alert">'.htmlspecialchars($_GET["error"]).
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        }elseif(isset($_GET["success"])){
                            echo '<div class="alert alert-success alert-dismissible" role="alert">'.htmlspecialchars($_GET["success"]).
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        } 
                        ?>
        </div>
        <div class="col-8">
            <h1 class="font-weight-bold mb-4">Mon Panier</h1>
            <table class="table table-hover" id="paymentTable">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Photo</th>
                        <th class="text-center" scope="col">Référence</th>
                        <th class="text-center" scope="col">Description</th>
                        <th class="text-center" scope="col">Prix</th>
                        <th class="text-center table-stock" scope="col">Quantité</th>
                        <th class="text-center" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Retrieve cart items from the database
                    $sql = "SELECT produits.id AS product_id, produits.*, SUM(commande.quantity) AS total_quantity
                            FROM produits
                            INNER JOIN commande ON produits.id = commande.product_id
                            WHERE commande.user_id = $user_id AND order_state='in_cart'
                            GROUP BY produits.id";

                    $result = $conn->query($sql);
                    $est_vide=true;
                    if ($result->num_rows > 0) {
                        // Display cart items
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Display product details
                            // Adjust the column names based on your database schema
                            echo "<td class='align-middle text-center'><div class='h-10'><img class='zoomable-image' src='img/produits/".$row['product_id'].".jpg' height='100px' alt=''></div></td>";
                            echo "<td class='align-middle text-center'>" . $row['reference'] . "</td>";
                            echo "<td class='align-middle text-center'>" . $row['description'] . "</td>";
                            echo "<td class='align-middle text-center'>" . $row['prix'] . " ".$settings["devise"]."</td>";
                            echo "<td class='align-middle text-center table-stock'>" . $row['total_quantity'] . "</td>";
                            // Add a form to remove the item from the cart
                            echo "<td class='align-middle text-center'><form method='post' action='php/remove_from_cart.php'><input type='hidden' name='product_id' value='" . $row['product_id'] . "'><button type='submit' class='btn btn-primary btn-trash'><i class='fa fa-trash'></i></button></form></td>";
                            echo "</tr>";
                            $est_vide=false;
                        }
                    } else {
                        $est_vide=true;
                        echo "<tr>";
                        echo "<td colspan='6' class='text-center'>Votre panier est vide.</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation" id="pagination_paymentTable">
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
        </div>
        <div class="col-4">
            <h1 class="font-weight-bold mb-4">Somme</h1>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>Total des articles:</td>
                        <td>
                            <?php
                            // Calculate the total quantity of items in the cart
                            $sql_total_quantity = "SELECT SUM(quantity) AS total_quantity FROM commande WHERE user_id = $user_id AND order_state='in_cart'";
                            $result_total_quantity = $conn->query($sql_total_quantity);
                            if ($result_total_quantity !== false) {
                                $total_quantity_row = $result_total_quantity->fetch_assoc();
                                $total_quantity = $total_quantity_row['total_quantity'];
                            } else {
                                $total_quantity = 0; // Set total price to 0 if no rows are found
                            }
                            if($est_vide){$total_quantity=0;}
                            echo $total_quantity;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Frais de livraison:</td>
                        <td><?php 
                            echo $settings['livraison'] . " ".$settings['devise'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>TVA:</td>
                        <td><?php 
                            echo $settings['tva'] . " %";
                            ?></td>
                    </tr>
                    <tr>
                        <td>Sous Total:</td>
                        <td>
                            <?php
                                // Calculate the total price of items in the cart
                                $sql_total_price = "SELECT SUM(p.prix * uc.quantity) AS total_price 
                                FROM commande uc 
                                INNER JOIN produits p ON uc.product_id = p.id 
                                WHERE uc.user_id = $user_id 
                                AND uc.order_state = 'in_cart'";
                                $result_total_price = $conn->query($sql_total_price);
                                if ($result_total_price !== false) {
                                    $total_price_row = $result_total_price->fetch_assoc();
                                    $total_price = $total_price_row['total_price'];
                                } else {
                                    $total_price = 0; // Set total price to 0 if no rows are found
                                }
                                if($est_vide){$total_price=0;}
                                echo $total_price . " ".$settings["devise"];
                                $conn->close();
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><h4><b>Total:</b></h4></td>
                        <td>
                            <h4><b id="montant-totale">
                            <?php
                                $montant_tt=0;
                                if($est_vide){
                                    echo "0 ".$settings["devise"];
                                }else{
                                    $montant_tt=(number_format((float)(($total_price+$settings['livraison'])+$total_price*$settings['tva']/100), 2, '.', ''));
                                    echo $montant_tt . " ".$settings["devise"];}
                            ?>
                            </b></h4>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-grid gap-2 form-group">
                <button class="btn btn-primary" <?php if($est_vide){echo "disabled";}?> id="button-payer" type="button" data-bs-toggle="modal" data-bs-target="#modalPayment"><i class="fa-solid fa-credit-card"></i> Procéder au paiement</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Modal Paiement -->
<div id="modalPayment" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="">
						<div class="card bg-transparent">
							<div class="card-header bg-transparent border-0">
								<div class="bg-white">
									<ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
										<li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active"><i class="fa-solid fa-credit-card"></i> Carte de crédit</a> </li>
										<li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "><i class="fa-brands fa-paypal"></i> Paypal</a> </li>
									</ul>
								</div>
								<div class="tab-content">
									<div id="credit-card" class="tab-pane fade show active pt-3">
										<form role="form" onsubmit="event.preventDefault()">
											<div class="form-group">
												<input type="text" name="username" placeholder="Nom du titulaire de la carte" required class="form-control "> 
											</div>
											<div class="form-group">
												<div class="input-group">
													<input type="text" name="cardNumber" maxlength="19" placeholder="Numéro de carte valide" class="form-control input-card-number" required>
													<div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fa-brands fa-cc-visa ml-1"></i><i class="fa-brands fa-cc-mastercard ml-1"></i><i class="fa-brands fa-cc-stripe ml-1"></i></span> </div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-8">
													<div class="form-group">
														<label>
															<span class="hidden-xs">
																<h6>Date d'expiration</h6>
															</span>
														</label>
														<div class="input-group"> <input maxlength="2" type="text" placeholder="MM" name="" class="form-control input-only-numbers" required> <input type="text" maxlength="2" placeholder="YY" name="" class="form-control input-only-numbers" required> </div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group mb-4">
														<label data-toggle="tooltip" title="Code CVV à trois chiffres au dos de votre carte">
															<h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
														</label>
														<input type="text" required maxlength="3" class="form-control input-only-numbers"> 
													</div>
												</div>
											</div>
										</form>
									</div>
									<div id="paypal" class="tab-pane fade pt-3">
										<h6 class="pb-2">Sélectionnez le type de compte Paypal</h6>
										<div class="form-group "> 
                                            <div class="form-check inline">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input checked type="radio" id="customRadioInline1" name="National" value="National" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline1">National</label>
                                                </div>
                                            </div>
                                            <div class="form-check inline">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline2" name="National" value="International" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline2">International</label>
                                                </div>
                                            </div>
                                            </div>
										<p><button type="button" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Se connecter à mon Paypal</button> </p>
										<p class="text-muted"><i class="fa-solid fa-circle-info"></i> Vous serez redirigé vers une passerelle sécurisée pour le paiement, puis de retour sur notre site pour consulter les détails de votre commande.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <form method="post" action="php/payement.php">
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-100">Payer <?php
                                                                    if($est_vide){
                                                                        echo "0 ".$settings["devise"];
                                                                    }else{
                                                                        echo (number_format((float)(($total_price+$settings['livraison'])+$total_price*$settings['tva']/100), 2, '.', '')) . " ".$settings["devise"];}
                                                                ?>
                    </button>
                    <input type="text" name="montant_tt" value="<?php echo $montant_tt;?>" hidden></input>
                </div>
            </form>
		</div>
	</div>
</div>

<?php include 'php/footer.php'; ?>
