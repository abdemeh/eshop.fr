<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'php/header.php';
include 'php/bddData.php';

$nb_clients=0;
$nb_commandes=0;
$nb_revenues=0;
$nb_produits=0;

$sql = "SELECT COUNT(*) as nb_produits FROM produits";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $nb_produits = $row['nb_produits'];
}

$sql = "SELECT COUNT(*) as nb_clients FROM users WHERE role = 'user'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $nb_clients = $row['nb_clients'];
}


$conn->close();
?>
<div class="container">
    <h1 class="text-center font-weight-bold">Tableau de bord</h1>
    <div class="row">
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-3 mb-2">
                    <div class="card widget-flat p-1">
                        <div class="card-body">
                            <div class="float-end">
                                <span class="text-success"><i class="fa-solid fa-arrow-up"></i> 5.27%</span>
                            </div>
                            <h5 class="text-muted fw-normal mt-0"><i class="fa-solid fa-users"></i> Clients</h5>
                            <h3 class="font-weight-bold"><?php echo $nb_clients;?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-2">
                    <div class="card widget-flat p-1">
                        <div class="card-body">
                            <div class="float-end">
                                <span class="text-success"><i class="fa-solid fa-arrow-up"></i> 5.27%</span>
                            </div>
                            <h5 class="text-muted fw-normal mt-0"><i class="fa-solid fa-cart-shopping"></i> Commandes</h5>
                            <h3 class="font-weight-bold"><?php echo $nb_commandes;?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-2">
                    <div class="card widget-flat p-1">
                        <div class="card-body">
                            <div class="float-end">
                                <span class="text-success"><i class="fa-solid fa-arrow-up"></i> 24.2%</span>
                            </div>
                            <h5 class="text-muted fw-normal mt-0"><i class="fa-solid fa-hand-holding-dollar"></i> Revenus</h5>
                            <h3 class="font-weight-bold"><?php echo $nb_revenues;?> €</h3>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-2">
                    <div class="card widget-flat p-1">
                        <div class="card-body">
                            <!-- <div class="float-end">
                                <span class="text-danger"><i class="fa-solid fa-arrow-down"></i> 0.27%</span>
                            </div> -->
                            <h5 class="text-muted fw-normal mt-0"><i class="fa-solid fa-shop"></i> Produits en totale</h5>
                            <h3 class="font-weight-bold"><?php echo $nb_produits;?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<?php include 'php/footer.php'; ?>
