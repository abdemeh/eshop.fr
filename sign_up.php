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
    <div class="card p-4 mt-2">
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
                                <?php if (isset($_GET["error"])){
                                    echo '<div class="alert alert-danger alert-dismissible" role="alert">'.htmlspecialchars($_GET["error"]).
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                    }elseif(isset($_GET["success"])){
                                        echo '<div class="alert alert-success alert-dismissible" role="alert">'.htmlspecialchars($_GET["success"]).
                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                    } 
                                ?>
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
                                                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                                                $host = $_SERVER['HTTP_HOST'];
                                                $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                                                $link = $protocol . '://' . $host . $path ;
                                                $email_body ='
                                                            <!DOCTYPE html>
                                                            <html lang="fr">
                                                            <head>
                                                                <meta charset="UTF-8">
                                                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                                <title>Finaliser votre inscription</title>
                                                                <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
                                                                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                                                                <style>
                                                                    body {
                                                                        font-family: "Poppins", sans-serif !important;
                                                                    }
                                                                    .btn{
                                                                        background: #f8b739;
                                                                        border-color: #f8b739;
                                                                        color: #fff;
                                                                        cursor: pointer;
                                                                        border-radius: 25px;
                                                                        padding: 10px 30px 10px 30px;
                                                                        font-weight: 500;
                                                                    }
                                                                    .btn:hover{
                                                                        background: #ebb03a;
                                                                        border-color: #ebb03a;
                                                                        color: #fff;
                                                                        cursor: pointer;
                                                                    }
                                                                    .icon{
                                                                        background: #f8b739;
                                                                        border-color: #f8b739;
                                                                        color: #fff;
                                                                        cursor: pointer;
                                                                        border-radius: 100px;
                                                                        padding: 15px;
                                                                        font-weight: 500;  
                                                                        }
                                                                        .card {
                                                                            position: relative;
                                                                            display: -webkit-box;
                                                                            display: -ms-flexbox;
                                                                            display: flex;
                                                                            -webkit-box-orient: vertical;
                                                                            -webkit-box-direction: normal;
                                                                            -ms-flex-direction: column;
                                                                            flex-direction: column;
                                                                            min-width: 0;
                                                                            word-wrap: break-word;
                                                                            background-color: #fff;
                                                                            background-clip: border-box;
                                                                            border: none;
                                                                            border-radius: 1.25rem;
                                                                            box-shadow: rgba(0, 0, 0, 0.06) 7px 7px 20px 0px;
                                                                        } 
                                                                    
                                                                </style>
                                                            </head>
                                                            <body>
                                                                <div class="container mt-4">
                                                                    <div class="card p-4"> 
                                                                        <div class="row justify-content-center mb-4 mt-4">
                                                                            <div class="col-10 col-md-8 col-lg-6 text-center">
                                                                                <center><h1 class="mb-4"><img src="https://i.ibb.co/8gWprM7/logo.png" height="40" alt=""></h1></center>
                                                                                <center><h2><b>Veuillez v&eacute;rifier votre compte</b></h2></center>
                                                                                <center><p>Vous &ecirc;tes sur le point d&#39;obtenir votre compte.<br>Pour v&eacute;rifier votre compte, veuillez cliquer sur le bouton ci-dessous :</p></center>
                                                                                <center><a href="'.$link.'/php/verify_email.php?token='.$token.'" class="btn btn-primary">V&eacute;rifier votre compte</a></center>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </body>
                                                            </html>  
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
                            <div class="form-group col-6">
                                <div class="has-validation">
                                    <h6 class="text-muted">Nom</h6>
                                    <input id="input-nom" name="nom" class="form-control" type="text" value="<?php echo isset(
                                        $_POST["nom"])? $_POST["nom"]: ""; ?>">
                                </div>
                                <div class="text-danger" id="error-nom"></div>
                            </div>
                            <div class="form-group col-6">
                                <div class="has-validation">
                                    <h6 class="text-muted">Prénom</h6>
                                    <input id="input-prenom" name="prenom" class="form-control" type="text" value="<?php echo isset(
                                        $_POST["prenom"])? $_POST["prenom"]: ""; ?>">
                                </div>
                                <div class="text-danger" id="error-prenom"></div>     
                            </div>
                            <div class="form-group col-12">
                                <div class="has-validation">
                                    <h6 class="text-muted">E-mail</h6>
                                    <input id="input-email" name="email" class="form-control" type="text" value="<?php echo isset(
                                        $_POST["email"])? $_POST["email"]: ""; ?>">
                                </div>
                                <div class="text-danger" id="error-email"></div>  
                            </div>
                            <div class="form-group col-12">
                                <div class="has-validation">
                                    <h6 class="text-muted">Mot de passe</h6>
                                    <input id="input-mdp" name="mdp" class="form-control" type="password" value="<?php echo isset(
                                        $_POST["mdp"])? $_POST["mdp"]: ""; ?>">
                                </div>
                                <div class="text-danger" id="error-mdp"></div>  
                            </div>
                            
                            <div class="form-group col-12">
                                <div class="has-validation">
                                    <h6 class="text-muted">Genre</h6>
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

                                </div>
                                <div class="text-danger" id="error-genre"></div>  
                            </div>
                            <div class="form-group col-md-6">
                                <div class="has-validation">
                                    <h6 class="text-muted">Date de naissance</h6>
                                    <input id="input-date_naissance" type="date"  name="date_naissance" class="form-control" 
                                    min="<?php echo date('Y-m-d', strtotime('-90 years')); ?>" 
                                    max="<?php echo date('Y-m-d', strtotime('-16 years')); ?>" 
                                    value="<?php echo isset($_POST["date_naissance"]) ? $_POST["date_naissance"] : ""; ?>"  />
                                </div>
                                <div class="text-danger" id="error-date_naissance"></div>  
                            </div>
                            <div class="form-group col-md-6">
                                <h6 class="text-muted">Métier</h6>
                                <select id="input-metier" class="form-select" name="metier" aria-label="Métier">
                                    <option hidden value="Sélectionner">Sélectionner</option>
                                    <?php
                                    foreach ($metiers as $metier) {
                                        $selected = isset($_POST["metier"]) && $_POST["metier"] == $metier["id"] ? "selected" : "";
                                        echo "<option " . $selected . ' value="' . $metier["id"] . '">' . $metier["libelle"] . "</option>";
                                    }
                                    ?>
                                </select>
                                <div class="text-danger" id="error-metier"></div>
                            </div> 

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-primary">Créer un compte</button>
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
</div>
<?php include "php/footer.php"; ?>

<script>
    // Call the displayErrors function after the page has loaded
    document.addEventListener('DOMContentLoaded', function() {
        displayErrors();
    });
</script>
