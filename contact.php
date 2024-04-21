<?php

include "php/mail_send.php";

include "php/main.php";
include "php/header.php";
include 'php/bddData.php';
require "vendor/autoload.php";

$settings = getSettings();
$metiers = getMetiers($conn);

$conn->close();
?>
    <div class="container">
        <h1 class="text-center font-weight-bold mb-4">Contactez-nous!</h1>
        <div class="container">
            <div class="card p-4 mt-2">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 d-flex p-4">
                        <img src="img/contact.svg" class="img-fluid p-4" alt="">
                    </div>
                    <div class="col-5">
                        <form id="contact-form" method="post">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div id="error-message-main"><?php if (isset($_GET["error"])){
                                                                    echo '<div class="alert alert-danger alert-dismissible" role="alert">'.htmlspecialchars($_GET["error"]).
                                                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                                                }elseif(isset($_GET["success"])){
                                                                    echo '<div class="alert alert-success alert-dismissible" role="alert">'.htmlspecialchars($_GET["success"]).
                                                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                                                } 
                                                                ?>
                                    </div>
                                    <?php if (
                                        $_SERVER["REQUEST_METHOD"] == "POST"
                                    ) {
                                        $nom = $_POST["nom"];
                                        $prenom = $_POST["prenom"];
                                        $email = $_POST["email"];
                                        $genre = isset($_POST["genre"])? $_POST["genre"]: "";
                                        $date_naissance = $_POST["date_naissance"];
                                        $metier = $_POST["metier"];
                                        $sujet = $_POST["sujet"];
                                        $message = $_POST["message"];

                                        $errors = [];
                                        if (empty($nom)) {$errors["nom"] ="Veuillez entrer un nom!";}
                                        if (empty($prenom)) {$errors["prenom"] ="Veuillez entrer un prénom!";}
                                        if (empty($email)) {$errors["email"] ="Veuillez entrer un email!";} elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {$errors["email"] ="Veuillez entrer un email valide!";}
                                        if (empty($sujet)) {$errors["sujet"] ="Veuillez entrer un sujet!";}
                                        if (empty($message)) {$errors["message"] ="Veuillez entrer un message!";}
                                        if (empty($date_naissance)) {$errors["date_naissance"] ="Veuillez entrer une date!";}
                                        if (empty($genre)) {$errors["genre"] ="Veuillez sélectionner un genre!";}
                                        if ($metier == "Sélectionner") {$errors["metier"] ="Veuillez choisir un métier!";
                                        }
                                        if (!empty($errors)) {
                                            echo "<script>";
                                            echo "function displayErrors() {";
                                            foreach ($errors as $field => $error) {
                                                echo '$("#error-'.$field.'").html("'.$error.'");';
                                                echo '$("#input-'.$field.'").addClass("is-invalid");';
                                            }
                                            echo "}</script>";
                                        } else {
                                            if ($metier == "etudiant") {
                                                if ($genre == "M") {
                                                    $metier = "&Eacute;tudiant";
                                                } elseif ($genre == "F") {
                                                    $metier = "&Eacute;tudiante";
                                                }
                                            } elseif ($metier == "enseignant") {
                                                if ($genre == "M") {
                                                    $metier = "Enseignant";
                                                } elseif ($genre == "F") {
                                                    $metier = "Enseignante";
                                                }
                                            } elseif ($metier == "ingenieur") {
                                                if ($genre == "M") {
                                                    $metier = "Ingenieur";
                                                } elseif ($genre == "F") {
                                                    $metier = "Ingenieure";
                                                }
                                            } else {
                                                $metier = "Autre";
                                            }

                                            if ($genre == "M") {
                                                $genre = "Masculin";
                                            } elseif ($genre == "F") {
                                                $genre = "F&eacute;minin";
                                            }
                                            
                                            $email_body ='
                                                            <!DOCTYPE html>
                                                            <html lang="fr">
                                                            <head>
                                                                <meta charset="UTF-8">
                                                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                                <title>Nouveau message de contact</title>
                                                                <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
                                                                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                                                                <style>
                                                                    body {
                                                                        font-family: "Poppins", sans-serif !important;
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
                                                                                <center><h2><b>Nouveau message de contact</b></h2></center>
                                                                                <center><p><strong>Nom: </strong> '.$nom.'</p></center>
                                                                                <center><p><strong>Pr&eacute;nom: </strong>'.$prenom.'</p></center>
                                                                                <center><p><strong>Email: </strong>'.$email.'</p></center>
                                                                                <center><p><strong>Genre: </strong>'.$genre.'</p></center>
                                                                                <center><p><strong>Date de naissance: </strong>'.$date_naissance.'</p></center>
                                                                                <center><p><strong>M&eacute;tier: </strong>'.$metier.'</p></center>
                                                                                <center><p><strong>Sujet: </strong>'.$sujet.'</p></center>
                                                                                <center><p><strong>Message: </strong>'.$message.'</p></center>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </body>
                                                            </html>  
                                                            ';
                                            $resultSendCustomEmail = array(false,"");
                                            $resultSendCustomEmail = sendCustomEmail($settings['admin_contact_email'], 'Nouveau message de contact de ' . $nom . ' ' . $prenom, $email_body);
                                            
                                            if($resultSendCustomEmail[0]==true){
                                                echo "<script>window.location.href='contact.php?success=Messsage envoyé avec succès';</script>";
                                            }else{
                                                echo "<script>window.location.href='contact.php?error=Erreur: ".$resultSendCustomEmail[0]."';</script>";
                                            }
                                            // header('Location: contact.php'.$resultSendCustomEmail);
                                            // header(
                                            //     "Location: contact.php?success=Email envoyé avec succès"
                                            // );
                                            // echo "<script>window.location.href='contact.php".$resultSendCustomEmail."';</script>";
                                        }
                                    } ?> 
                                </div>
                                <div class="form-group col-6">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Nom</h6>
                                        <input id="input-nom" name="nom" class="form-control input-only-text" type="text" value="<?php echo isset(
                                            $_POST["nom"])? $_POST["nom"]: ""; ?>">
                                    </div>
                                    <div class="text-danger" id="error-nom"></div>
                                </div>
                                <div class="form-group col-6">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Prénom</h6>
                                        <input id="input-prenom" name="prenom" class="form-control input-only-text" type="text" value="<?php echo isset(
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
                                        <h6 class="text-muted">Genre</h6>
                                        <div class="form-check inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input checked type="radio" id="customRadioInline1" name="genre" value="M" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Masculin</label>
                                            </div>
                                        </div>
                                        <div class="form-check inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="genre" value="F" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">Féminin</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-danger" id="error-genre"></div>  
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Date de naissance</h6>
                                        <input id="input-date_naissance" name="date_naissance" class="form-control" type="date" 
                                        min="<?php echo date('Y-m-d', strtotime('-90 years')); ?>" 
                                        max="<?php echo date('Y-m-d', strtotime('-16 years')); ?>" 
                                        value="<?php echo isset(
                                            $_POST["date_naissance"]
                                        )
                                            ? $_POST["date_naissance"]
                                            : ""; ?>" />
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
                                <div class="form-group col-md-12">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Sujet</h6>
                                        <input id="input-sujet" name="sujet" class="form-control" type="text" value="<?php echo isset(
                                            $_POST["sujet"])? $_POST["sujet"]: ""; ?>">
                                    </div>
                                    <div class="text-danger" id="error-sujet"></div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="has-validation">
                                        <h6 class="text-muted">Message</h6>
                                        <textarea class="form-control" id="input-message" name="message" rows="4"><?php echo isset(
                                            $_POST["message"]
                                        )
                                            ? $_POST["message"]
                                            : ""; ?></textarea>
                                    </div>
                                    <div class="text-danger" id="error-message"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
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
