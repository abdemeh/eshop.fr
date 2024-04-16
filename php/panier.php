<?php
session_start();

include 'header.php';

// Include the products from varSession.inc.php
include 'varSession.inc.php';

?>

<div class="container">
    <div class="row">
        <div class="col-9">
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
                    // Loop through the products in the session
                    if(isset($_SESSION['panier'])) {
                        foreach ($_SESSION['panier'] as $productId => $quantity) {
                            // Find the product details using the product ID
                            foreach ($categories as $category) {
                                foreach ($category as $product) {
                                    if ($product['id'] == $productId) {
                                        // Display the product in the table
                                        echo "<tr>";
                                        echo "<td class='align-middle text-center'><div class='h-10'><img class='zoomable-image' src='" . $product['Photo'] . "' height='100px' alt=''></div></td>";
                                        echo "<td class='align-middle text-center'>" . $product['Référence'] . "</td>";
                                        echo "<td class='align-middle text-center'>" . $product['Description'] . "</td>";
                                        echo "<td class='align-middle text-center'>" . $product['Prix'] . "</td>";
                                        echo "<td class='align-middle text-center table-stock'>" . $quantity . "</td>"; // Display the quantity from the cart
                                        echo "<td class='align-middle text-center'><form method='post' action='remove_from_cart.php'><input type='hidden' name='productId' value='" . $product['id'] . "'><button type='submit' class='btn btn-trash'><i class='fa fa-trash'></i></button></form></td>";
                                        echo "</tr>";
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='6' class='text-center'>Votre panier est vide.</td>"; // Display a message if the cart is empty
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
        <div class="col-3">
            <h1 class="font-weight-bold mb-4">Somme</h1>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Total des articles:</td>
                        <td>
                            <?php
                                $total = 0;
                                if(isset($_SESSION['panier'])) {
                                    foreach ($_SESSION['panier'] as $productId => $quantity) {
                                        foreach ($categories as $category) {
                                            foreach ($category as $product) {
                                                if ($product['id'] == $productId) {
                                                    $subtotal = $quantity;
                                                    $total += $subtotal;
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }
                                echo $total;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Frais de livraison:</td>
                        <td>19.99 €</td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td>
                            <?php
                                $total = 0;
                                if(isset($_SESSION['panier'])) {
                                    foreach ($_SESSION['panier'] as $productId => $quantity) {
                                        foreach ($categories as $category) {
                                            foreach ($category as $product) {
                                                if ($product['id'] == $productId) {
                                                    $subtotal = $product['Prix'] * $quantity;
                                                    $total += $subtotal;
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }
                                echo $total." €";
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<?php include 'footer.php'; ?>
