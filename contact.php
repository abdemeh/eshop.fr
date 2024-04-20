<?php

include "php/mail_send.php";

include "php/main.php";
include "php/header.php";
include 'php/bddData.php';
require "vendor/autoload.php";

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
                                    <div id="error-message"><?php if (
                                        isset($_GET["error"])
                                    ) {
                                        echo '<div class="alert alert-danger" role="alert">' .
                                            htmlspecialchars($_GET["error"]) .
                                            "</div>";
                                    } elseif (isset($_GET["success"])) {
                                        echo '<div class="alert alert-success" role="alert">' .
                                            htmlspecialchars($_GET["success"]) .
                                            "</div>";
                                    } ?>
                                </div>
                                    <?php if (
                                        $_SERVER["REQUEST_METHOD"] == "POST"
                                    ) {
                                        // Récupérer les données du formulaire
                                        $nom = $_POST["nom"];
                                        $prenom = $_POST["prenom"];
                                        $email = $_POST["email"];
                                        $genre = isset($_POST["genre"])
                                            ? $_POST["genre"]
                                            : "";
                                        $date_naissance = $_POST["date_naissance"];
                                        $metier = $_POST["metier"];
                                        $sujet = $_POST["sujet"];
                                        $message = $_POST["message"];

                                        $errors = [];
                                        if (empty($nom)) {
                                            $errors["nom"] =
                                                "Veuillez entrer un nom!";
                                        }

                                        if (empty($prenom)) {
                                            $errors["prenom"] =
                                                "Veuillez entrer un prénom!";
                                        }

                                        if (empty($email)) {
                                            $errors["email"] =
                                                "Veuillez entrer un email!";
                                        } elseif (
                                            !filter_var(
                                                $email,
                                                FILTER_VALIDATE_EMAIL
                                            )
                                        ) {
                                            $errors["email"] =
                                                "Veuillez entrer un email valide!";
                                        }

                                        if (empty($sujet)) {
                                            $errors["sujet"] =
                                                "Veuillez entrer un sujet!";
                                        }

                                        if (empty($message)) {
                                            $errors["message"] =
                                                "Veuillez entrer un message!";
                                        }

                                        if (empty($date_naissance)) {
                                            $errors["date_naissance"] =
                                                "Veuillez entrer une date!";
                                        }

                                        if (empty($genre)) {
                                            $errors["genre"] =
                                                "Veuillez sélectionner un genre!";
                                        }

                                        if ($metier == "Sélectionner") {
                                            $errors["metier"] =
                                                "Veuillez choisir un métier!";
                                        }
                                        if (!empty($errors)) {
                                            echo "<script>";
                                            echo "function displayErrors() {";
                                            foreach ($errors as $field => $error) {
                                                echo '$("#error-' .
                                                    $field .
                                                    '").html("' .
                                                    $error .
                                                    '");';
                                                echo '$("#input-' .
                                                    $field .
                                                    '").addClass("is-invalid");';
                                            }
                                            echo "}";
                                            echo "</script>";
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

                                            $email_body =
                                                '
                                                    <h1>Nouveau message de contact</h1>
                                                    <p><strong>Nom:</strong> ' .
                                                $nom .
                                                '</p>
                                                    <p><strong>Pr&eacute;nom:</strong> ' .
                                                $prenom .
                                                '</p>
                                                    <p><strong>Email:</strong> ' .
                                                $email .
                                                '</p>
                                                    <p><strong>Genre:</strong> ' .
                                                $genre .
                                                '</p>
                                                    <p><strong>Date de naissance:</strong> ' .
                                                $date_naissance .
                                                '</p>
                                                    <p><strong>M&eacute;tier:</strong> ' .
                                                $metier .
                                                '</p>
                                                    <p><strong>Sujet:</strong> ' .
                                                $sujet .
                                                '</p>
                                                    <p><strong>Message:</strong> ' .
                                                $message .
                                                '</p>
                                                ';
                                            $resultSendCustomEmail = array(false,"");
                                            $resultSendCustomEmail = sendCustomEmail('elmahdaouia@gmail.com', 'Nouveau message de contact de ' . $nom . ' ' . $prenom, $email_body);
                                            
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
                                <div class="form-group col-md-6">
                                    <div class="input-group has-validation">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="input-nom" name="nom" placeholder="Nom" aria-label="Nom" aria-describedby="basic-addon1" value="<?php echo isset(
                                            $_POST["nom"]
                                        )
                                            ? $_POST["nom"]
                                            : ""; ?>">
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
                                        <input type="text" class="form-control" id="input-prenom" name="prenom" placeholder="Prénom" aria-label="Prénom" aria-describedby="basic-addon1" value="<?php echo isset(
                                            $_POST["prenom"]
                                        )
                                            ? $_POST["prenom"]
                                            : ""; ?>">
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
                                        <input type="email" class="form-control" id="input-email" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="<?php echo isset(
                                            $_POST["email"]
                                        )
                                            ? $_POST["email"]
                                            : ""; ?>">
                                    </div>
                                    <div class="text-danger" id="error-email"></div>
                                </div>
                                <div class="form-group col-md-12" style="margin-bottom: -15px;">
                                    <fieldset class="form-group">
                                        <label>Genre:</label>
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
                                        <input id="input-date_naissance" name="date_naissance" class="form-control" type="date" value="<?php echo isset(
                                            $_POST["date_naissance"]
                                        )
                                            ? $_POST["date_naissance"]
                                            : ""; ?>" />
                                    </div>
                                    <div class="text-danger" id="error-date_naissance"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Métier:</label>
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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="sujet" id="input-sujet" placeholder="Sujet" aria-label="Sujet" aria-describedby="basic-addon1" value="<?php echo isset(
                                            $_POST["sujet"]
                                        )
                                            ? $_POST["sujet"]
                                            : ""; ?>">
                                    </div>
                                    <div class="text-danger" id="error-sujet"></div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-message"></i>
                                            </span>
                                        </div>
                                        <textarea class="form-control" id="input-message" name="message" placeholder="Message" rows="4"><?php echo isset(
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
