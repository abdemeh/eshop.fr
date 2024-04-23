<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'php/header.php';
include 'php/bddData.php';
include_once 'php/main.php';

$settings = getSettings('settings.json');

$nb_clients=0;
$nb_commandes=0;
$revenues=0;
$nb_produits=0;
$percentage_new_clients=0;
$percentage_new_commandes=0;
$percentage_revenue=0;

$sql = "SELECT COUNT(*) as nb_produits FROM produits";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $nb_produits = $row['nb_produits'];
}

$sql = "SELECT COUNT(*) as nb_clients FROM users WHERE role = 'user' AND WEEK(verification_date) = WEEK(NOW())";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $nb_clients = $row['nb_clients'];
}else{
    $nb_clients = 0;
}


$sql = "SELECT COUNT(*) as nb_commandes FROM commande WHERE order_state != 'in_cart' AND WEEK(order_date) = WEEK(NOW())";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $nb_commandes = $row['nb_commandes'];
}else{
    $nb_commandes = 0;
}

$sql = "SELECT SUM(montant) AS revenues FROM payment WHERE WEEK(payment_date) = WEEK(NOW())";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $revenues = $row['revenues'];
}else{
    $revenues = 0;
}

$sql = "SELECT 
        ((COUNT(CASE WHEN WEEK(verification_date) = WEEK(NOW()) THEN 1 END) - 
        COUNT(CASE WHEN WEEK(verification_date) = WEEK(NOW()) - 1 THEN 1 END)) / 
        COUNT(*)) * 100 AS percentage_new_clients
        FROM users WHERE role = 'user'";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $percentage_new_clients = $row['percentage_new_clients'];
    $percentage_new_clients=number_format((float)$percentage_new_clients, 2, '.', '');
}

$sql = "SELECT 
        ((COUNT(CASE WHEN WEEK(order_date) = WEEK(NOW()) THEN 1 END) - 
        COUNT(CASE WHEN WEEK(order_date) = WEEK(NOW()) - 1 THEN 1 END)) / 
        COUNT(*)) * 100 AS percentage_new_commandes
        FROM commande WHERE order_state = 'paid'";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $percentage_new_commandes = $row['percentage_new_commandes'];
    $percentage_new_commandes=number_format((float)$percentage_new_commandes, 2, '.', '');
}

$sql = "SELECT 
        ((COUNT(CASE WHEN WEEK(payment_date) = WEEK(NOW()) THEN 1 END) - 
        COUNT(CASE WHEN WEEK(payment_date) = WEEK(NOW()) - 1 THEN 1 END)) / 
        COUNT(*)) * 100 AS percentage_revenue
        FROM payment";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $percentage_revenue = $row['percentage_revenue'];
    $percentage_revenue=number_format((float)$percentage_revenue, 2, '.', '');
}

$sql = "SELECT 
    (COUNT(CASE WHEN genre = 'F' THEN 1 END) / COUNT(*)) * 100 AS percentage_female_users,
    (COUNT(CASE WHEN genre = 'M' THEN 1 END) / COUNT(*)) * 100 AS percentage_male_users
    FROM users
    WHERE users.role = 'user'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $percentage_female_users = number_format((float)$row['percentage_female_users'], 2, '.', '');
    $percentage_male_users = number_format((float)$row['percentage_male_users'], 2, '.', '');
}

$sql = "SELECT m.libelle AS metier, COUNT(u.id) AS total_users
        FROM metier m
        LEFT JOIN users u ON m.id = u.metier_id
        WHERE u.role = 'user'
        GROUP BY m.id
        ORDER BY COUNT(u.id) DESC";
$result = $conn->query($sql);

$total_users = 0;
$profession_percentages = [];

while ($row = $result->fetch_assoc()) {
    $total_users += $row['total_users'];
    $profession_percentages[$row['metier']] = $row['total_users'];
}

foreach ($profession_percentages as $metier => $count) {
    $percentage = ($count / $total_users) * 100;
    $percentage = number_format($percentage, 2);
    $profession_percentages[$metier] = $percentage;
}

$sql = "SELECT c.*, p.description, p.reference, p.prix, p.stock 
        FROM commande c 
        INNER JOIN produits p ON c.product_id = p.id 
        WHERE c.order_state = 'paid'
        ORDER BY c.order_date DESC
        LIMIT 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $orders = [];
}

$conn->close();
?>
<div class="container">
    <div class="row">
    <h4 class="font-weight-bold">Cette semaine</h4>
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-3 mb-2">
                    <div class="card widget-flat p-1">
                        <div class="card-body">
                            <div class="float-end">
                                <?php 
                                if($percentage_new_clients>0){
                                    echo '<span class="text-success"><i class="fa-solid fa-arrow-up"></i> '.$percentage_new_clients.'%</span>';  
                                }elseif($percentage_new_clients<0){
                                    echo '<span class="text-danger"><i class="fa-solid fa-arrow-down"></i> '.$percentage_new_clients.'%</span>';
                                }else{
                                    echo '<span class="text-warning"><i class="fa-solid fa-minus"></i> '.$percentage_new_clients.'%</span>';
                                }
                                ?>
                                
                            </div>
                            <h5 class="text-muted fw-normal mt-0"><i class="fa-solid fa-users"></i> Clients </h5>
                            <h3 class="font-weight-bold"><?php echo $nb_clients;?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-2">
                    <div class="card widget-flat p-1">
                        <div class="card-body">
                            <div class="float-end">
                            <?php 
                                if($percentage_new_commandes>0){
                                    echo '<span class="text-success"><i class="fa-solid fa-arrow-up"></i> '.$percentage_new_commandes.'%</span>';  
                                }elseif($percentage_new_commandes<0){
                                    echo '<span class="text-danger"><i class="fa-solid fa-arrow-down"></i> '.$percentage_new_commandes.'%</span>';
                                }else{
                                    echo '<span class="text-warning"><i class="fa-solid fa-minus"></i> '.$percentage_new_commandes.'%</span>';
                                }
                                ?>
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
                            <?php 
                                if($percentage_revenue>0){
                                    echo '<span class="text-success"><i class="fa-solid fa-arrow-up"></i> '.$percentage_revenue.'%</span>';  
                                }elseif($percentage_revenue<0){
                                    echo '<span class="text-danger"><i class="fa-solid fa-arrow-down"></i> '.$percentage_revenue.'%</span>';
                                }else{
                                    echo '<span class="text-warning"><i class="fa-solid fa-minus"></i> '.$percentage_revenue.'%</span>';
                                }
                                ?>
                            </div>
                            <h5 class="text-muted fw-normal mt-0"><i class="fa-solid fa-hand-holding-dollar"></i> Revenus</h5>
                            <h3 class="font-weight-bold"><?php echo $revenues.' '.$settings["devise"];?> </h3>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-2">
                    <div class="card widget-flat p-1">
                        <div class="card-body">
                            <h5 class="text-muted fw-normal mt-0"><i class="fa-solid fa-shop"></i> Produits en totale</h5>
                            <h3 class="font-weight-bold"><?php echo $nb_produits;?></h3>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    <div class="row">
        <div class="col-6">
        <h4 class="font-weight-bold mt-2">Statistiques</h4>
            <div class="card widget-flat p-1">
                <div class="card-body">
                    <h6 class="text-muted">Pourcentage de clients féminines</h6>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentage_female_users; ?>%" aria-valuenow="<?php echo $percentage_female_users; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage_female_users; ?>%</div>
                    </div>
                    <h6 class="mt-4 text-muted">Pourcentage de clientes masculins</h6>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $percentage_male_users; ?>%" aria-valuenow="<?php echo $percentage_male_users; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage_male_users; ?>%</div>
                    </div>
                </div>
            </div>
            <div class="card widget-flat mt-3 p-1">
                <div class="card-body">
                    <?php foreach ($profession_percentages as $metier => $percentage): ?>
                        <h6 class="text-muted mt-2">Pourcentage de clients <?php echo $metier; ?></h6>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage; ?>%</div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div> 
        </div>
        <div class="col-6">
            <h4 class="font-weight-bold mt-2">Dernières commandes</h4>
            <div class="card widget-flat p-1">
                <div class="list-group mb-4">
                    <?php if($orders == []){echo "<p class='text-center mt-4'>Malheureusement, il n'y a aucune commande pour le moment.</p>";}else{foreach ($orders as $order): ?>
                        <div class="list-group-item border-0">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo 'img/produits/' . $order['product_id'] . '.jpg'; ?>" class="mr-3" height="100" alt="Product Image">
                                <div>
                                    <h5 class="mb-1"><?php echo $order['description']; ?></h5>
                                    <p class="mb-1"><?php echo $order['reference']; ?></p>
                                    <p class="text-muted">Date de commande: <?php echo date('d/m/Y H:i:s', strtotime($order['order_date'])); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;} ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php include 'php/footer.php'; ?>
