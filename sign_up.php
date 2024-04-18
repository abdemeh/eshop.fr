<?php

include "php/header.php";
include "php/mail_send.php";
include "php/main.php";
include "php/bddData.php";
require "vendor/autoload.php";

$metiers = getMetiers($conn);

$conn->close();
?>

<div class="container">
    <h1 class="text-center font-weight-bold mb-4">Créer un compte</h1>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-5 d-flex p-4">
                <img src="img/sign-up.svg" class="img-fluid p-4" alt="">
            </div>
            <div class="col-5">
                <form id="contact-form" method="post">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div id="error-message">
                                <?php if (isset($_GET["error"])) {
                                    echo '<div class="alert alert-danger" role="alert">' .
                                        htmlspecialchars($_GET["error"]) .
                                        "</div>";
                                } elseif (isset($_GET["success"])) {
                                    echo '<div class="alert alert-success" role="alert">' .
                                        htmlspecialchars($_GET["success"]) .
                                        "</div>";
                                } ?>
                            </div>
                            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Récupérer les données du formulaire
                                $nom = $_POST["nom"];
                                $prenom = $_POST["prenom"];
                                $email = $_POST["email"];
                                $mdp = $_POST["mdp"];
                                $genre = isset($_POST["genre"]) ? $_POST["genre"] : "";
                                $date_naissance = $_POST["date_naissance"];
                                $metier = $_POST["metier"];

                                $errors = [];
                                if (empty($nom)) {
                                    $errors["nom"] = "Veuillez entrer un nom!";
                                }

                                if (empty($prenom)) {
                                    $errors["prenom"] = "Veuillez entrer un prénom!";
                                }

                                if (empty($email)) {
                                    $errors["email"] = "Veuillez entrer un email!";
                                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $errors["email"] = "Veuillez entrer un email valide!";
                                }

                                if (empty($mdp)) {
                                    $errors["mdp"] = "Veuillez entrer un mot de passe!";
                                }

                                if (empty($date_naissance)) {
                                    $errors["date_naissance"] = "Veuillez entrer une date!";
                                }

                                if (empty($genre)) {
                                    $errors["genre"] = "Veuillez sélectionner un genre!";
                                }

                                if ($metier == "Sélectionner") {
                                    $errors["metier"] = "Veuillez choisir un métier!";
                                }
                                if (!empty($errors)) {
                                    echo "<script>";
                                    echo "function displayErrors() {";
                                    foreach ($errors as $field => $error) {
                                        echo '$("#error-' . $field . '").html("' . $error . '");';
                                        echo '$("#input-' . $field . '").addClass("is-invalid");';
                                    }
                                    echo "}";
                                    echo "</script>";
                                } else {
                                    $token = md5(uniqid(mt_rand(), true));

                                    include "php/bddData.php";
                                    $sql = "INSERT INTO users (nom, prenom, email, mdp, genre, date_naissance, metier_id, role, verification_token) 
                                            VALUES ('$nom', '$prenom', '$email', '".md5($mdp)."', '$genre', '$date_naissance', $metier, 'user', '$token')";
                                    try {
                                        if ($conn->query($sql) === TRUE) {
                                            echo "<script>window.location.href='sign_up.php?success=Un email de vérification viens de vous être envoyé.';</script>";
                                            $email_body = '
                                                            <center>
                                                                <h1>Finaliser votre inscription</h1>
                                                                <p>Pour v&eacute;rifier votre compte, veuillez cliquer sur le bouton ci-dessous :</p>
                                                                <a href="http://localhost/php/eShop/php/verify_email.php?token='.$token.'" class="button">V&eacute;rifier le compte</a>
                                                            </center>
                                                        ';
                                            $resultSendVerificationEmail = sendCustomEmail($email, 'V&eacute;rification de cr&eacute;ation de compte &agrave; eshop.fr', $email_body);
                                            if($resultSendVerificationEmail[0]==true){
                                                echo "<script>window.location.href='sign_up.php?success=Email envoyé avec succès';</script>";
                                            }else{
                                                echo "<script>window.location.href='sign_up.php?error=Erreur: ".$resultSendVerificationEmail[0]."';</script>";
                                            }
                                        }
                                    }
                                    catch (mysqli_sql_exception $e) {
                                        if ($e->getCode() == 1062) {
                                            echo "<script>window.location.href='sign_up.php?error=Un autre utilisateur avec cet email existe déjà. Veuillez choisir une autre adresse email.';</script>";
                                        } else {
                                            echo "<script>window.location.href='sign_up.php?error=Erreur: ".$e->getMessage()."';</script>";
                                        }
                                    }
                                    $conn->close();
                                }
                            } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group has-validation">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="input-nom" name="nom" placeholder="Nom" aria-label="Nom" aria-describedby="basic-addon1" value="<?php echo isset($_POST["nom"]) ? $_POST["nom"] : ""; ?>">
                            </div>
                            <div class="text-danger" id="error-nom"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="input-prenom" name="prenom" placeholder="Prénom" aria-label="Prénom" aria-describedby="basic-addon1" value="<?php echo isset($_POST["prenom"]) ? $_POST["prenom"] : ""; ?>">
                            </div>
                            <div class="text-danger" id="error-prenom"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" id="input-email" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
                            </div>
                            <div class="text-danger" id="error-email"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" id="input-mdp" name="mdp" placeholder="Mot de passe" aria-label="Mot de passe" aria-describedby="basic-addon1" value="<?php echo isset($_POST["mdp"]) ? $_POST["mdp"] : ""; ?>">
                            </div>
                            <div class="text-danger" id="error-mdp"></div>
                        </div>
                        <div class="form-group col-md-12" style="margin-bottom: -15px;">
                            <fieldset class="form-group">
                                <label>Genre:</label>
                                <div class="form-check inline">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input <?php echo isset($_POST["genre"]) && $_POST["genre"] == "M" ? "checked" : ""; ?> type="radio" id="customRadioInline1" name="genre" value="M" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline1">Masculin</label>
                                    </div>
                                </div>
                                <div class="form-check inline">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input <?php echo isset($_POST["genre"]) && $_POST["genre"] == "F" ? "checked" : ""; ?> type="radio" id="customRadioInline2" name="genre" value="F" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline2">Féminin</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Date de naissance:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-calendar-days"></i>
                                    </span>
                                </div>
                                <input id="input-date_naissance" name="date_naissance" class="form-control" type="date" value="<?php echo isset($_POST["date_naissance"]) ? $_POST["date_naissance"] : ""; ?>" />
                            </div>
                            <div class="text-danger" id="error-date_naissance"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Métier:</label>
                            <select id="input-metier" class="form-select" name="metier" aria-label="Métier">
                                <option hidden value="Sélectionner">Sélectionner</option>
                                <?php foreach ($metiers as $metier) {
                                    $selected = isset($_POST["metier"]) && $_POST["metier"] == $metier["id"] ? "selected" : "";
                                    echo "<option " . $selected . ' value="' . $metier["id"] . '">' . $metier["libelle"] . "</option>";
                                } ?>
                            </select>
                            <div class="text-danger" id="error-metier"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block">Créer un compte</button>
                        </div>
                        <div class="col-12 text-center">
                            <a href="login.php">Se connecter</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include "php/footer.php"; ?>

<script>
    // Call the displayErrors function after the page has loaded
    document.addEventListener('DOMContentLoaded', function() {
        displayErrors();
    });
</script>
