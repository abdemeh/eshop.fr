<?php
session_start();
include 'bddData.php';
include 'main.php';

$settings=getSettings('../settings.json');

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$count_panier=0;

if (!$user_id) {
    exit();
}

$sql = "SELECT produits.id AS product_id, produits.*, SUM(commande.quantity) AS total_quantity
        FROM produits
        INNER JOIN commande ON produits.id = commande.product_id
        WHERE commande.user_id = $user_id AND order_state='in_cart'
        GROUP BY produits.id";

$result = $conn->query($sql);

$cart_items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }
}

// Get total items in cart
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $sql_count = "SELECT COUNT(*) AS count_panier FROM commande WHERE user_id = $user_id AND order_state='in_cart'";
    $result = $conn->query($sql_count);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count_panier = $row["count_panier"];
    }
}

// Calculate the total quantity of items in the cart
$total_quantity = 0;
$sql_total_quantity = "SELECT SUM(quantity) AS total_quantity FROM commande WHERE user_id = $user_id AND order_state='in_cart'";
$result_total_quantity = $conn->query($sql_total_quantity);
if ($result_total_quantity !== false) {
    $total_quantity_row = $result_total_quantity->fetch_assoc();
    $total_quantity = $total_quantity_row['total_quantity'];
} else {
    $total_quantity = 0;
}
if($total_quantity==null){$total_quantity=0;}

// Calculate the total price of items in the cart
$total_price = 0;
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
    $total_price = 0;
}
if($total_price==null){$total_price=0;}

$total_price_string = $total_price . " " . $settings["devise"];

$montant_totale=0;

if($total_price>0) {
    $montant_totale=number_format((float)(($total_price+($total_price*$settings['tva']/100))+$settings['livraison']), 2, '.', '');
}


$response = [
    'cart_items' => $cart_items,
    'total_quantity' => $total_quantity,
    'total_price' => $total_price_string,
    'montant_totale' => $montant_totale,
    'cart_nb_products' => $count_panier
];

echo json_encode($response);

$conn->close();
?>
