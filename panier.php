<?php
session_start();
include 'php/header.php';
include 'php/varSession.inc.php';
include 'php/bddData.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    header('Location: ../login.php'); // Redirect to login page if user is not logged in
    exit();
}


?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="font-weight-bold mb-4">Mon Panier</h1>
            <table class="table table-hover" id="productTable">
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
                    $sql = "SELECT produits.id AS product_id, produits.*, SUM(user_cart.quantity) AS total_quantity
                            FROM produits
                            INNER JOIN user_cart ON produits.id = user_cart.product_id
                            WHERE user_cart.user_id = $user_id
                            GROUP BY produits.id";

                    $result = $conn->query($sql);
                    $est_vide=true;
                    if ($result->num_rows > 0) {
                        // Display cart items
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Display product details
                            // Adjust the column names based on your database schema
                            echo "<td class='align-middle text-center'><div class='h-10'><img class='zoomable-image' src='" . $row['photo'] . "' height='100px' alt=''></div></td>";
                            echo "<td class='align-middle text-center'>" . $row['reference'] . "</td>";
                            echo "<td class='align-middle text-center'>" . $row['description'] . "</td>";
                            echo "<td class='align-middle text-center'>" . $row['prix'] . "</td>";
                            echo "<td class='align-middle text-center table-stock'>" . $row['total_quantity'] . "</td>";
                            // Add a form to remove the item from the cart
                            echo "<td class='align-middle text-center'><form method='post' action='php/remove_from_cart.php'><input type='hidden' name='product_id' value='" . $row['product_id'] . "'><button type='submit' class='btn btn-trash'><i class='fa fa-trash'></i></button></form></td>";
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
                            $sql_total_quantity = "SELECT SUM(quantity) AS total_quantity FROM user_cart WHERE user_id = $user_id";
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
                            $frais_livraison=19.99;
                            echo $frais_livraison . " €";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>TVA:</td>
                        <td><?php 
                            $tva=20;
                            echo $tva . " %";
                            ?></td>
                    </tr>
                    <tr>
                        <td>Sous Total:</td>
                        <td>
                            <?php
                                // Calculate the total price of items in the cart
                                $sql_total_price = "SELECT SUM(prix * quantity) AS total_price FROM user_cart uc INNER JOIN produits p ON uc.product_id = p.id WHERE uc.user_id = $user_id";
                                $result_total_price = $conn->query($sql_total_price);
                                if ($result_total_price !== false) {
                                    $total_price_row = $result_total_price->fetch_assoc();
                                    $total_price = $total_price_row['total_price'];
                                } else {
                                    $total_price = 0; // Set total price to 0 if no rows are found
                                }
                                if($est_vide){$total_price=0;}
                                echo $total_price . " €";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><h4><b>Total:</b></h4></td>
                        <td>
                            <h4><b>
                            <?php
                                if($est_vide){
                                    echo "0 €";
                                }else{
                                    echo (number_format((float)(($total_price+$frais_livraison)+$total_price*$tva/100), 2, '.', '')) . " €";}
                                
                            ?>
                            
                            </b></h4>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-grid gap-2 form-group">
                <button type="submit" class="btn">Procéder au paiement</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php include 'php/footer.php'; ?>

<?php
// Close the database connection
$conn->close();
?>
