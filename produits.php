<?php
include 'php/header.php';
include 'php/bddData.php';
include_once 'php/main.php';

$settings = getSettings('settings.json');

if(isset($_GET['cat'])) {
    $est_vide=false;
    $category = urldecode($_GET['cat']);
    $sql = "SELECT * FROM produits WHERE categorie_id IN (SELECT id FROM categorie WHERE libelle = ?) AND stock > 0 ORDER BY description";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $products = array();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        $products = [];
        $est_vide=true; 
    }
} else {
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

?>

<div class="container">
    <h1 class="text-center font-weight-bold mb-2"><?php echo $category; ?></h1>
    <div class="card p-4 mt-2">
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
            <table class="table table-hover table-sm" id="productsTable">
                <thead>
                    <tr>
                        <th class="text-center" scope="col"></th>
                        <th class="text-center" scope="col">Référence</th>
                        <th class="text-center" scope="col">Description</th>
                        <th class="text-center" scope="col">Prix</th>
                        <th class="text-center table-stock" scope="col" hidden="hidden">Stock</th>
                        <th class="text-center" scope="col">Commande</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($est_vide){
                            echo "<tr>";
                            echo "<td colspan='6' class='text-center'>Malheureusement, tous les produits de cette catégorie sont actuellement en rupture de stock.</td>";
                            echo "</tr>";}
                    foreach ($products as $product) : ?>
                        <tr>
                            <th class="align-middle text-center">
                                <div class="h-10"><img class="zoomable-image" src="img/produits/<?php echo $product['id']; ?>.jpg" height="100px" onerror="this.onerror=null; this.src='img/product.jpg';" alt=""></div>
                            </th>
                            <td class="align-middle text-center"><?php echo $product['reference']; ?></td>
                            <td class="align-middle text-center"><?php echo $product['description']; ?></td>
                            <td class="align-middle text-center"><?php echo $product['prix']." ".$settings["devise"]; ?></td>
                            <td class="align-middle text-center table-stock" id="stock_<?php echo $product['id']; ?>" hidden="hidden"><?php echo $product['stock']; ?></td>
                            <td class="align-middle text-center">
                                <div class="input-group-wrapper">
                                    <div class="input-group inline-group">
                                        <div class="input-group-prepend">
                                            <button disabled type="button" id="btn_minus_<?php echo $product['id'];?>" class="btn btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input class="form-control quantity text-center input-only-numbers" id="input_quantity_<?php echo $product['id']; ?>" min="0" name="quantity_<?php echo $product['id']; ?>" value="0" type="number" style="height: auto;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button disabled class="btn btn-primary btn-add-to-cart mt-2" id="add_to_cart_<?php echo $product['id']; ?>" onclick="addToCart(<?php echo $product['id']; ?>)">Ajouter au panier</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="btn-cacher-stock" hidden class="btn-primary btn mt-2">Afficher stock</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<?php include 'php/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    function addToCart(productId) {
        var quantity = document.querySelector(`input[name="quantity_${productId}"]`).value;
        $.ajax({
            type: 'POST',
            url: 'php/add_to_cart.php',
            data: {
                productId: productId,
                quantity: quantity
            },
            success: function(response) {
                var responseData = JSON.parse(response);
                if (responseData.success == 1) {
                    var quantity = parseInt(responseData.quantity);
                    var old_stock = parseInt($(`#stock_${productId}`).text());
                    var cart_nb_products = parseInt($(`#stock_${productId}`).text());
                    $(`#stock_${productId}`).text(old_stock - quantity);
                    $(`#input_quantity_${productId}`).val('0');
                    $(`#icon-panier-value`).html(responseData.cart_nb_products);
                    $(`#btn_minus_${productId}`).prop('disabled', true); 
                    $(`#add_to_cart_${productId}`).prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
