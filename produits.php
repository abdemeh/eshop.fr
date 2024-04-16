<?php
session_start();

include 'php/header.php';

if(isset($_GET['cat'])) {
    $category = urldecode($_GET['cat']);
    if(isset($_SESSION['categories'][$category])) {
        $products = $_SESSION['categories'][$category];
    } else {
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}


// // Check if the 'panier' session exists
// if (isset($_SESSION['panier'])) {
//     echo "<h2>Contenu du panier :</h2>";
//     echo "<ul>";
//     // Iterate over the contents of the 'panier' session
//     foreach ($_SESSION['panier'] as $productId => $quantity) {
//         // Output the product ID and quantity
//         echo "<li>Produit ID: $productId - Quantité: $quantity</li>";
//     }
//     echo "</ul>";
// } else {
//     // If the 'panier' session does not exist or is empty
//     echo "<p>Votre panier est vide.</p>";
// }

?>

<div class="container">
    <h1 class="text-center font-weight-bold mb-2"><?php echo $category; ?></h1>
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
                    <th class="text-center" scope="col"></th>
                    <th class="text-center" scope="col">Référence</th>
                    <th class="text-center" scope="col">Description</th>
                    <th class="text-center" scope="col">Prix</th>
                    <th class="text-center table-stock" scope="col">Stock</th>
                    <th class="text-center" scope="col">Commande</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <th class="align-middle text-center">
                            <div class="h-10"><img class="zoomable-image" src="<?php echo $product['Photo']; ?>" height="100px" alt=""></div>
                        </th>
                        <td class="align-middle text-center"><?php echo $product['Référence']; ?></td>
                        <td class="align-middle text-center"><?php echo $product['Description']; ?></td>
                        <td class="align-middle text-center"><?php echo $product['Prix']." €"; ?></td>
                        <td class="align-middle text-center table-stock"><?php echo $product['Stock']; ?></td>
                        <td class="align-middle text-center">
                            <form method="post" action="php/add_to_cart.php">
                                <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                                <!-- <input type="hidden" name="quantity" value="0"> -->
                                <div class="input-group-wrapper">
                                    <div class="input-group inline-group">
                                        <div class="input-group-prepend">
                                            <button disabled type="button" class="btn btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input class="form-control quantity text-center" min="0" name="quantity" value="0" type="number">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button disabled class="btn btn-add-to-cart mt-2" type="submit">Ajouter au panier</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
</div>
</div>
</div>

<?php include 'php/footer.php'; ?>
