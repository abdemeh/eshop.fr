<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'php/header.php';
include 'php/bddData.php';
include_once 'php/main.php';

$settings = getSettings('settings.json');
    $commandes_est_vide = false;
    $sql = "SELECT u.nom, u.prenom, u.email, p.reference, p.description, c.quantity, c.order_date, c.order_state 
            FROM commande c 
            JOIN users u ON c.user_id = u.id 
            JOIN produits p ON c.product_id = p.id 
            ORDER BY c.order_date DESC;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $commandes = array();
        while ($row = $result->fetch_assoc()) {
            $commandes[] = $row;
        }
    } else {
        $commandes = [];
        $est_vide = true;
    }

    $payments_est_vide = false;
    $sql = "SELECT u.nom, u.prenom, u.email, p.payment_date, p.montant, p.mode_paiement
            FROM payment p 
            JOIN users u ON p.user_id = u.id  
            ORDER BY p.payment_date DESC;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $payments = array();
        while ($row = $result->fetch_assoc()) {
            $payments[] = $row;
        }
    } else {
        $payments = [];
        $est_vide = true;
    }

$conn->close();
?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-2">
        <h1 class="text-center font-weight-bold mt-4">Commandes</h1>
            <div class="col-12 card widget-flat pt-5 mt-2">
                <table class="table table-hover table-sm" id="productsTable">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">Date</th>
                            <th class="text-center" scope="col">Nom</th>
                            <th class="text-center" scope="col">Prénom</th>
                            <th class="text-center" scope="col">Email</th>
                            <th class="text-center" scope="col">Référence</th>
                            <th class="text-center" scope="col">Description</th>
                            <th class="text-center" scope="col">Quantité</th>
                            <th class="text-center" scope="col">État</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($commandes_est_vide){
                                echo "<tr>";
                                echo "<td colspan='6' class='text-center'>Malheureusement, il y'a aucune commande pour le moment.</td>";
                                echo "</tr>";}
                        foreach ($commandes as $commande) : ?>
                            <tr>
                                <td class="align-middle text-center"><?php echo $commande['order_date']; ?></td>
                                <td class="align-middle text-center"><?php echo $commande['nom']; ?></td>
                                <td class="align-middle text-center"><?php echo $commande['prenom']; ?></td>
                                <td class="align-middle text-center"><?php echo $commande['email']; ?></td>
                                <td class="align-middle text-center"><?php echo $commande['reference']; ?></td>
                                <td class="align-middle text-center"><?php echo $commande['description']; ?></td>
                                <td class="align-middle text-center"><?php echo $commande['quantity']; ?></td>
                                <td class="align-middle text-center">
                                    <?php 
                                    if($commande['order_state']=="paid"){
                                        echo '<span class="badge rounded-pill text-bg-success"><i class="fa-solid fa-money-bills"></i> Payé</span>'; 
                                    }elseif($commande['order_state']=="in_cart"){
                                        echo '<span class="badge rounded-pill text-bg-warning"><i class="fa-solid fa-cart-shopping"></i> En panier</span>'; 
                                    }else{
                                        echo '<span class="badge rounded-pill text-bg-danger"><i class="fa-solid fa-ban"></i> Échoué</span>'; 
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation" id="pagination_productsTable">
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
        </div>
        <div class="col-12 mt-2">
        <h1 class="text-center font-weight-bold mt-4">Paiements</h1>
            <div class="col-12 card widget-flat pt-5 mt-2">
                <table class="table table-hover table-sm" id="commandeTable">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">Date</th>
                            <th class="text-center" scope="col">Nom</th>
                            <th class="text-center" scope="col">Prénom</th>
                            <th class="text-center" scope="col">Email</th>
                            <th class="text-center" scope="col">Mode de paiement</th>
                            <th class="text-center" scope="col">Montant</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($payments_est_vide){
                                echo "<tr>";
                                echo "<td colspan='6' class='text-center'>Malheureusement, il y'a aucun paiement pour le moment.</td>";
                                echo "</tr>";}
                        foreach ($payments as $payment) : ?>
                            <tr>
                                <td class="align-middle text-center"><?php echo $payment['payment_date']; ?></td>
                                <td class="align-middle text-center"><?php echo $payment['prenom']; ?></td>
                                <td class="align-middle text-center"><?php echo $payment['nom']; ?></td>
                                <td class="align-middle text-center"><?php echo $payment['email']; ?></td>
                                <td class="align-middle text-center">
                                    <?php 
                                    if($payment['mode_paiement']== 'paypal'){
                                        echo '<span class="badge rounded-pill text-bg-primary"><i class="fa-brands fa-paypal"></i> PayPal</span>';
                                    }elseif($payment['mode_paiement']== 'card'){
                                        echo '<span class="badge rounded-pill text-bg-secondary"><i class="fa-solid fa-credit-card"></i> Carte</span>';
                                    }
                                    ?>
                                </td>
                                <td class="align-middle text-center"><?php echo $payment['montant'].$settings["devise"]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation" id="pagination_commandeTable">
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
        </div>
    </div>
</div>

</div>
</div>
<?php include 'php/footer.php'; ?>
