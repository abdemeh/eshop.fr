<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'php/bddData.php';
include_once 'php/main.php';

$metiers = getMetiers($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $genre = isset($_POST["genre"])? $_POST["genre"]: "";
    $date_naissance = $_POST["date_naissance"];
    $metier = $_POST["metier"];
    $errors = [];

    if (empty($nom)) {$errors["nom"] ="Veuillez entrer un nom!";}
    if (empty($prenom)) {$errors["prenom"] ="Veuillez entrer un prénom!";}
    if (empty($email)) {$errors["email"] ="Veuillez entrer un email!";} elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {$errors["email"] ="Veuillez entrer un email valide!";}
    if (empty($mdp)) {$errors["mdp"] ="Veuillez entrer un mot de passe!";}
    if (empty($date_naissance)) {$errors["date_naissance"] ="Veuillez entrer une date!";}
    if (empty($genre)) {$errors["genre"] ="Veuillez sélectionner un genre!";}
    if ($metier == "Sélectionner") {$errors["metier"] ="Veuillez choisir un métier!";
    }
    if (!empty($errors)) {
        echo "<script>";
        echo "function displayErrors() {";
        foreach ($errors as $field => $error) {
            echo '$("#error-'.$field.'").html("'.$error.'");';
            echo '$("#input-' .$field.'").addClass("is-invalid");';
        }
        echo "}</script>";
    }else{
        $sql = "UPDATE users SET nom='$nom', prenom='$prenom', email='$email', mdp='".md5($mdp)."', genre='$genre', date_naissance='$date_naissance', metier_id=$metier WHERE id={$_SESSION['user_id']}";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header('Location: profile.php?success=Données utilisateur mises à jour avec succès.');
        } else {
            header('Location: profile.php?error=Erreur lors de la mise à jour des données utilisateur.');
        }
        exit();
    }
}

$userData = getUserData($_SESSION['user_id'], $conn);

$conn->close();

include 'php/header.php';
?>
    <div class="container">
        <h1 class="text-center font-weight-bold">Mon Profile</h1>
        <div class="container">
            <div class="">
                
                
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 card p-4 mt-2">
                        <div class="row">
                            <div class="col-12">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3"></div>
                                <div class="col-md-6 d-flex justify-content-center">
                                    <div class="position-relative">
                                        <img id="profile-pic" class="logo rounded-circle p-3 mb-2" src="<?php
                                        if(isset($_SESSION['user_id'])){
                                            $userImagePath = "img/users/{$_SESSION['user_id']}.jpg";
                                            if (file_exists($userImagePath)) {
                                                echo $userImagePath;
                                            } else {
                                                echo "img/profile.svg";
                                            }
                                        } else {
                                            echo "img/profile.svg";
                                        }
                                        ?>" height="200px" width="200px" class="p-4" alt="">
                                        <div id="edit-image" class="position-absolute top-0 end-0">
                                            <i class="fa fa-edit edit-icon"></i>
                                        </div>
                                        <form id="edit-image-form" action="php/upload_image.php" method="POST" enctype="multipart/form-data">
                                            <input type="file" name="file" id="edit-image-input" accept=".jpg" hidden>
                                            <input type="hidden" name="destination_folder" value="../img/users/">
                                            <input type="hidden" name="original_page" value="../profile.php">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <form id="profile-form" class="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Nom</h6>
                                        <input id="input-nom" name="nom" class="form-control" type="text" value="<?php echo $userData['nom'] ?? ''; ?>">
                                    </div>
                                    <div class="text-danger" id="error-nom"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Prenom</h6>
                                        <input id="input-prenom" name="prenom" class="form-control" type="text" value="<?php echo $userData['prenom'] ?? ''; ?>">
                                    </div>
                                    <div class="text-danger" id="error-prenom"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="has-validation">
                                        <h6 class="text-muted">E-mail</h6>
                                        <input id="input-email" name="email" class="form-control" type="email" value="<?php echo $userData['email'] ?? ''; ?>">
                                    </div>
                                    <div class="text-danger" id="error-email"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Mot de passe</h6>
                                        <input id="input-mdp" name="mdp" class="form-control" type="password" value="<?php echo $userData['mdp'] ?? ''; ?>">
                                    </div>
                                    <div class="text-danger" id="error-mdp"></div>
                                </div>
                                <div class="form-group col-12">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Genre</h6>
                                        <div class="form-check inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input <?php if($userData['genre']=="M"){echo "checked";}?> type="radio" id="customRadioInline1" name="genre" value="M" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Masculin</label>
                                            </div>
                                        </div>
                                        <div class="form-check inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input <?php if($userData['genre']=="F"){echo "checked";}?> type="radio" id="customRadioInline2" name="genre" value="F" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">Féminin</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-danger" id="error-genre"></div>  
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Date de naissance</h6>
                                        <input id="input-date_naissance" type="date"  name="date_naissance" class="form-control" 
                                        min="<?php echo date('Y-m-d', strtotime('-90 years')); ?>" 
                                        max="<?php echo date('Y-m-d', strtotime('-16 years')); ?>" 
                                        value="<?php echo $userData['date_naissance'] ?? ''; ?>"  />
                                    </div>
                                    <div class="text-danger" id="error-date_naissance"></div>  
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <h6 class="text-muted">Métier</h6>
                                    <select id="input-metier" class="form-select" name="metier" aria-label="Métier">
                                        <option hidden value="Sélectionner">Sélectionner</option>
                                        <?php
                                        foreach ($metiers as $metier) {
                                            $selected = ($userData['metier_id'] == $metier['id']) ? "selected" : "";
                                            echo '<option ' . $selected . ' value="' . $metier['id'] . '">' . $metier['libelle'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <div class="text-danger" id="error-metier"></div>
                                </div>                       
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
<?php include 'php/footer.php'; ?>
<script>
// Call the displayErrors function after the page has loaded
document.addEventListener('DOMContentLoaded', function() {
    displayErrors();
});
</script>