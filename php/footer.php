<?php 
include_once("php/main.php");

$settings = getSettings();

// Récupération des catégories de produits depuis la base de données
$conn = new mysqli($host, $username, $password, $database);
$categories = [];
$sql_categories = "SELECT * FROM categorie";
$result_categories = $conn->query($sql_categories);

if ($result_categories->num_rows > 0) {
    while ($row_category = $result_categories->fetch_assoc()) {
        $category_id = $row_category["id"];
        $category_libelle = $row_category["libelle"];
        $category_icon = $row_category["icon"];

        // You can add more category information as needed
        $categories[$category_id] = array(
            "libelle" => $category_libelle,
            "icon" => $category_icon,
            // Add more fields if necessary
        );
    }
}
$conn->close();
?>

<footer class="border-top">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5">
            <div class="col text-center pb-4 mt-5">
                <img class="mb-2" src="img/logo.png" height="32" alt="">
                <p class="text-muted text-left">Découvrez notre sélection de smartphones, ordinateurs portables, montres connectées et plus encore! Parcourez notre catalogue dès maintenant pour trouver les produits qui vous conviennent.</p>
            </div>
            <div class="col mt-5">
                <h5 class="text-dark"><b>Plan de site</b></h5>
                <?php 
                    if((isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                        echo '<ul class="nav flex-column">';
                        echo '<li class="nav-item mb-2"><a href="admin.php" class="nav-link p-0 text-muted">Accueil</a></li>';
                        echo '<li class="nav-item mb-2"><a href="produits_edit.php" class="nav-link p-0 text-muted">Produits & Catégories</a></li>';
                        echo '<li class="nav-item mb-2"><a href="settings.php" class="nav-link p-0 text-muted">Paramètres</a></li>';
                        echo '<li class="nav-item mb-2"><a href="profile.php" class="nav-link p-0 text-muted">Mon Compte</a></li>';
                        echo '</ul>';
                    }else{
                        echo '<ul class="nav flex-column">';
                        echo '<li class="nav-item mb-2"><a href="index.php" class="nav-link p-0 text-muted">Accueil</a></li>';
                        echo '<li class="nav-item mb-2"><a href="contact.php" class="nav-link p-0 text-muted">Contact</a></li>';
                        echo '<li class="nav-item mb-2"><a href="profile.php" class="nav-link p-0 text-muted">Mon Compte</a></li>';
                        echo '<li class="nav-item mb-2"><a href="panier.php" class="nav-link p-0 text-muted">Mon Panier</a></li>';
                        echo '</ul>';
                    }
                ?>
            </div>
            <div class="col mt-5">
                <h5 class="text-dark"><b>Catégories</b></h5>
                <?php 
                if((isset($_SESSION["user_role"]) && $_SESSION['user_role'] == "admin")){
                    echo '<ul class="nav flex-column">';  
                    echo '<li class="nav-item mb-2"><a href="produits_edit.php" class="nav-link p-0 text-muted">Produits & Catégories</a></li>';
                }else{
                    echo '<ul class="nav flex-column">';  
                    foreach ($categories as $category_id => $category) {
                        $encodedCategory = urlencode($category["libelle"]);
                        echo "<li class='nav-item mb-2'>";
                        echo "<a href='produits.php?cat=".$encodedCategory."' class='nav-link p-0 text-muted'>";
                        echo $category["libelle"]; // Output category name
                        echo "</a>";
                        echo "</li>";
                    }
                }   
                    ?>
                </ul>
            </div>
            <div class="col mt-5">
                <h5 class="text-dark"><b>Contactez-nous</b></h5>
                <p class="text-muted text-left">N'hésitez pas à nous contacter pour toute questions, suivez-nous sur nos réseaux sociaux:</p>
                <p>
                    <a href="<?php echo $settings['facebook_url']?>" class="social-icon mr-2"><i class="fab fa-facebook"></i></a>
                    <a href="<?php echo $settings['instagram_url']?>" class="social-icon mr-2"><i class="fab fa-instagram"></i></a>
                    <a href="<?php echo $settings['x_url']?>" class="social-icon mr-2"><i class="fab fa-x-twitter"></i></a>
                </p>
            </div>
        </div>
        <div class="col text-center pb-4 mt-4">
            <img class="mb-2" src="img/logo.png" height="32" alt="">
            <p class="text-muted">Tous les droits sont réservés © eshop.fr | 2023-2024</p>
        </div>
    </div>
</footer>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"86e9bc02babed38b","version":"2024.3.0","token":"cd0b4b3a733644fc843ef0b185f98241"}' crossorigin="anonymous"></script>
</body>
</html>
