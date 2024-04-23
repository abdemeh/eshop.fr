<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'php/header.php';
include 'php/bddData.php';

    $sql = "SELECT * FROM categorie";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $categories = array();
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    } else {
        $categories = array();
    }

    $est_vide=false;

    $sql = "SELECT produits.*, categorie.libelle AS categorie
    FROM produits 
    INNER JOIN categorie ON produits.categorie_id = categorie.id ORDER BY categorie.id, description;";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $est_vide = true;
    }

    $sql = "SELECT MAX(id) AS max_id FROM produits";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $max_id = $result->fetch_assoc();
        $max_id_produit_value = $max_id['max_id']+1;
    }else{
        $max_id_produit_value=1;
    }

    $sql = "SELECT MAX(id) AS max_id FROM categorie";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $max_id = $result->fetch_assoc();
        $max_id_categorie_value = $max_id['max_id']+1;
    }else{
        $max_id_categorie_value=1;
    }

    $conn->close();
?>
                <div class="container">
                    <div class="row">
                    <h1 class="text-center font-weight-bold">Produits & Catégories</h1>
                        <div class="card p-4 mt-2">
                            <div class="row mb-3 justify-content-center">
                            <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <!-- <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="searchInput" placeholder="Rechercher..."> -->
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalCategories"><i class="fa-solid fa-layer-group"></i> Catégories</button>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="btn btn-primary" type="button" id="btn-ajouter-produit"><i class="fa-regular fa-plus"></i> Ajouter produit</button>
                                                </div>
                                                <div class="col-auto">
                                                    <form id="input-products-csv-form" method="post" action="php/importer_produits.php" enctype="multipart/form-data">
                                                        <div>
                                                            <input type="file" id="input-products-csv" class="form-control" name="csv_file" accept=".csv" style="display: none;">
                                                            <button id="button-products-csv" class="btn btn-success" type="button"><i class="fa-regular fa-file-excel"></i> Importer Produits</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-auto">
                                                    <form id="" method="post" action="php/download_produits.php" enctype="multipart/form-data">
                                                        <div>
                                                            <button id="" class="btn btn-dark" type="submit"><i class="fa-solid fa-download"></i> Télécharger csv</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="error-message">
                                <?php if (isset($_GET["error"])){
                                            echo '<div class="alert alert-danger alert-dismissible" role="alert">'.htmlspecialchars($_GET["error"]).
                                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                        }elseif(isset($_GET["success"])){
                                            echo '<div class="alert alert-success alert-dismissible" role="alert">'.htmlspecialchars($_GET["success"]).
                                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                        } 
                                ?>
                            </div>
                            <table class="table table-hover table-sm" id="productsTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col"></th>
                                        <th class="text-center" scope="col">Référence</th>
                                        <th class="text-center" scope="col">Description</th>
                                        <th class="text-center" scope="col">Prix</th>
                                        <th class="text-center table-stock" scope="col">Stock</th>
                                        <th class="text-center" scope="col">Catégorie</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="tr-ajouter-produit" hidden>
                                        <th class="align-middle text-center">
                                            <div class="h-10 image-container">
                                                <form class="edit-image-form" action="php/upload_image.php" method="POST" enctype="multipart/form-data">
                                                    <img src="img/product.jpg" height="100px" alt="">
                                                    <div class="edit-image" style="display: inline;">
                                                        <i class="fa fa-add edit-icon product-edit-icon"></i>
                                                    </div>
                                                    <input type="file" name="file" class="edit-image-input" accept=".jpg" hidden>
                                                    <input type="hidden" name="destination_folder" value="../img/produits/">
                                                    <input type="hidden" name="original_page" value="../produits_edit.php">
                                                    <input type="hidden" name="product_id" value="<?php echo $max_id_produit_value; ?>" accept=".jpg" hidden>
                                                </form>
                                            </div>
                                        </th>
                                        <form method="post" id="form-ajouter-produit" action="php/ajouter_produit.php">
                                            <td class="align-middle text-center"><input name="reference" class="form-control" style="width: 100px;" type="text" value=""></td>
                                            <td class="align-middle text-center"><input name="description" class="form-control" type="text" value=""></td>
                                            <td class="align-middle text-center"><input name="prix" class="form-control" style="width: 100px;" type="number" step=".01" value=""></td>
                                            <td class="align-middle text-center table-stock"><input name="stock" class="form-control input-only-numbers" style="width: 60px;" type="text" value=""></td>
                                            <td class="align-middle text-center table-stock"><select name="categorie" class="form-select" style="width: 180px;">
                                                                                                <?php foreach ($categories as $category) : ?>
                                                                                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['libelle']; ?></option>
                                                                                                <?php endforeach; ?>
                                                                                            </select></td>
                                            <td class="align-middle text-center">
                                                <form method="post" action="php/ajouter_produit.php">
                                                    <input type="hidden" name="product_id" value="<?php echo $max_id_produit_value; ?>">
                                                    <button class="btn btn-primary btn-add-to-cart" type="submit"><i class="fa-solid fa-plus"></i></button>
                                                </form>
                                                <button id="btn-hide-produit" type="submit" class="btn btn-trash btn-primary"><i class="fa fa-close"></i></button>
                                            </td>
                                        </form>
                                    </tr>
                                    <?php
                                    if($est_vide){
                                            echo "<tr>";
                                            echo "<td colspan='6' class='text-center'>Désolé, mais pour l'instant, aucun produit n'est disponible.</td>";
                                            echo "</tr>";}
                                    foreach ($products as $product) : ?>
                                        <tr>
                                            <th class="align-middle text-center">
                                                <div class="h-10 image-container">
                                                    <form class="edit-image-form" action="php/upload_image.php" method="POST" enctype="multipart/form-data">
                                                        <img src="img/produits/<?php echo $product['id']; ?>.jpg" height="100px" onerror="this.onerror=null; this.src='img/product.jpg';" alt="">
                                                        <div class="edit-image" style="display: inline;">
                                                            <i class="fa fa-edit edit-icon product-edit-icon"></i>
                                                        </div>
                                                        <input type="file" name="file" class="edit-image-input" accept=".jpg" hidden>
                                                        <input type="hidden" name="destination_folder" value="../img/produits/">
                                                        <input type="hidden" name="original_page" value="../produits_edit.php">
                                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" accept=".jpg" hidden>
                                                    </form>
                                                </div>
                                            </th>
                                            <form method="post" action="php/update_product.php">
                                                <td class="align-middle text-center"><input name="reference" class="form-control" style="width: 100px;" type="text" value="<?php echo $product['reference']; ?>"></td>
                                                <td class="align-middle text-center"><input name="description" class="form-control" type="text" value="<?php echo $product['description']; ?>"></td>
                                                <td class="align-middle text-center"><input name="prix" class="form-control" style="width: 100px;" type="number" step=".01" value="<?php echo $product['prix']; ?>"></td>
                                                <td class="align-middle text-center table-stock"><input name="stock" class="form-control input-only-numbers" style="width: 60px;" type="text" value="<?php echo $product['stock']; ?>"></td>
                                                <td class="align-middle text-center table-stock"><select name="categorie" class="form-select" style="width: 180px;">
                                                                                                    <?php foreach ($categories as $category) : ?>
                                                                                                        <option <?php if ($category['id'] == $product['categorie_id']) { echo "selected"; } ?> value="<?php echo $category['id']; ?>"><?php echo $category['libelle']; ?></option>
                                                                                                    <?php endforeach; ?>
                                                                                                </select></td>
                                                <td class="align-middle text-center">
                                                    <form method="post" action="php/update_product.php">
                                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                                        <button class="btn btn-primary btn-add-to-cart" type="submit"><i class="fa-solid fa-floppy-disk"></i></button>
                                                    </form>
                                                    <form method="post" action="php/remove_product.php" style="display: inline;">
                                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                                        <button type="submit" class="btn btn-trash btn-primary"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </form>
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
</div>
</div>
</div>
            <!-- Modal Categories -->
            <div id="modalCategories" class="modal fade" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="btn btn-primary ml-1" type="button" id="btn-ajouter-categorie">Ajouter catégorie</button>
                        </div>
                        <div class=container>
                            <table class="table table-hover" id="productTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Catégorie</th>
                                        <th class="text-center" scope="col">Icon</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr id="tr-ajouter-categorie" hidden>
                                    <?php
                                        $categories_icons = [
                                            "-- Icône par défaut --" => "fa-solid fa-tags",
                                            "Audio" => "fa-solid fa-headphones",
                                            "Caméras" => "fa-solid fa-camera",
                                            "Composantes" => "fa-solid fa-microchip",
                                            "Imprimantes et scanners" => "fa-solid fa-print",
                                            "Jeux vidéo" => "fa-solid fa-gamepad",
                                            "Montres" => "fa-solid fa-clock",
                                            "Ordinateurs" => "fa-solid fa-laptop",
                                            "Réseaux" => "fa-solid fa-wifi",
                                            "Robots" => "fa-solid fa-robot",
                                            "Sécurité" => "fa-solid fa-shield-halved",
                                            "Téléphones" => "fa-solid fa-mobile-screen-button",
                                            "Télévisions" => "fa-solid fa-tv",
                                        ]; 
                                    ?>
                                    <form method="post" action="php/ajouter_categorie.php">
                                        <td class="align-middle text-center"><input name="categorie_libelle" class="form-control" type="text" value=""></td>
                                        <td class="align-middle text-center">
                                            <select name="select_categorie_icon" class="form-select">
                                                <?php 
                                                    foreach ($categories_icons as $label => $value) {
                                                        echo '<option value="' . $value . '">' . $label . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="align-middle text-center">
                                            <form method="post" action="php/update_categorie.php">
                                                <input type="hidden" name="categorie_id" value="<?php echo $max_id_categorie_value; ?>">
                                                <button class="btn btn-primary btn-add-to-cart" type="submit"><i class="fa fa-add"></i></button>
                                            </form>                                     
                                            <button id="btn-hide-categorie" type="submit" class="btn btn-trash btn-primary"><i class="fa fa-close"></i></button>
                                        </td>
                                    </form>
                                </tr>
                                <?php
                                if($est_vide){
                                        echo "<tr>";
                                        echo "<td colspan='6' class='text-center'>Désolé, mais pour l'instant, aucune catégorie n'est disponible.</td>";
                                        echo "</tr>";}
                                foreach ($categories as $category) : ?>
                                    <tr>
                                        <form method="post" action="php/update_categorie.php">
                                            <td class="align-middle text-center"><input name="categorie_libelle" class="form-control" type="text" value="<?php echo $category["libelle"];?>"></td>
                                            <td class="align-middle text-center">
                                                <select name="select_categorie_icon" class="form-select">
                                                    <?php 
                                                    foreach ($categories_icons as $label => $value) {
                                                        $selected = ($category["icon"] == $value) ? "selected" : "";
                                                        echo '<option ' . $selected . ' value="' . $value . '">' . $label . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">
                                                <form method="post" action="php/update_categorie.php">
                                                    <input type="hidden" name="categorie_id" value="<?php echo $category['id']; ?>">
                                                    <button class="btn btn-primary btn-add-to-cart" type="submit"><i class="fa-solid fa-floppy-disk"></i></button>
                                                </form>
                                                <form method="post" action="php/remove_categorie.php" style="display: inline;">
                                                    <input type="hidden" name="categorie_id" value="<?php echo $category['id']; ?>">
                                                    <button type="submit" class="btn btn-trash btn-primary"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </form>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
<?php include 'php/footer.php'; ?>
<script>
    $(document).ready(function() {
    // Trigger file input click when the image is clicked
    $('#product-image').click(function() {
        $('#image-file').click();
    });

    // Preview the selected image
    $('#image-file').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#product-image').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Submit the form via AJAX
    $('.edit-image-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var img = $(this).find('img');
        var src = img.attr('src');
        $.ajax({
                type: 'POST',
                url: 'php/upload_image.php',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json', 
                success: function(response) {
                    if(response.success){
                        $('#error-message').html('<div class="alert alert-success alert-dismissible" role="alert">'+response.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        img.attr('src', src + '?' + new Date().getTime());
                    }else{
                        $('#error-message').html('<div class="alert alert-danger alert-dismissible" role="alert">'+response.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#error-message').html('<div class="alert alert-danger alert-dismissible" role="alert">'+response.message+' '+error+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
            });
    });
});

</script>