<?php
include 'header.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $date_naissance = $_POST['date_naissance'];
    $metier = $_POST['metier'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    $errors = [];
    if (empty($nom)) {
        $errors['nom'] = "Veuillez entrer un nom!";
    }

    if (empty($prenom)) {
        $errors['prenom'] = "Veuillez entrer un prénom!";
    }

    if (empty($email)) {
        $errors['email'] = "Veuillez entrer un email!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Veuillez entrer un email valide!";
    }

    if (empty($sujet)) {
        $errors['sujet'] = "Veuillez entrer un sujet!";
    }

    if (empty($message)) {
        $errors['message'] = "Veuillez entrer un message!";
    }

    if (empty($date_naissance)) {
        $errors['date_naissance'] = "Veuillez entrer une date!";
    }

    if (empty($genre)) {
        $errors['genre'] = "Veuillez sélectionner un genre!";
    }

    if ($metier == "Sélectionner") {
        $errors['metier'] = "Veuillez choisir un métier!";
    }
    if (!empty($errors)) {
        echo '<script>';
        echo 'function displayErrors() {';
        foreach ($errors as $field => $error) {
            echo '$("#error-'.$field.'").html("'.$error.'");';
            echo '$("#input-'.$field.'").addClass("is-invalid");';
        }
        echo '}';
        echo '</script>';
    } else {
        // Si aucun erreur, procéder à l'envoi de l'email
        // Créer une instance de PHPMailer et envoyer l'email
    

        if($metier =="etudiant"){
            if($genre =="masculin"){
                $metier="&Eacute;tudiant";
            }elseif($genre =="feminin"){
                $metier="&Eacute;tudiante";
            }
        }elseif($metier =="enseignant"){
            if($genre =="masculin"){
                $metier="Enseignant";
            }elseif($genre =="feminin"){
                $metier="Enseignante";
            }
        }elseif($metier =="ingenieur"){
            if($genre =="masculin"){
                $metier="Ingenieur";
            }elseif($genre =="feminin"){
                $metier="Ingenieure";
            }
        }else{
            $metier="Autre";
        }

        if($genre =="masculin"){
            $genre="Masculin";
        }elseif($genre =="feminin"){
            $genre="F&eacute;minin";
        }

        // Créer une instance de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp-mail.outlook.com';  // Nom du serveur SMTP
            $mail->Port = 587;  // Port SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Chiffrement SMTP
            $mail->SMTPAuth = true;  // Authentification SMTP
            $mail->Username = 'eshop.fr@outlook.com';  // Votre adresse e-mail Outlook
            $mail->Password = '{WLCEtuM6]=U(6t';  // Votre mot de passe Outlook

            // Destinataire et expéditeur
            // $mail->setFrom($email, $nom . ' ' . $prenom);
            $mail->addAddress('eshop.fr@outlook.com', 'eshop.fr');  // Adresse e-mail du destinataire
            // $mail->addReplyTo($email, $nom . ' ' . $prenom);

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Nouveau message de contact de ' . $nom . ' ' . $prenom;
            $mail->Body    = '
                <h1>Nouveau message de contact</h1>
                <p><strong>Nom:</strong> ' . $nom . '</p>
                <p><strong>Pr&eacute;nom:</strong> ' . $prenom . '</p>
                <p><strong>Email:</strong> ' . $email . '</p>
                <p><strong>Genre:</strong> ' . $genre . '</p>
                <p><strong>Date de naissance:</strong> ' . $date_naissance . '</p>
                <p><strong>M&eacute;tier:</strong> ' . $metier . '</p>
                <p><strong>Sujet:</strong> ' . $sujet . '</p>
                <p><strong>Message:</strong> ' . $message . '</p>
            ';

            // Envoi de l'e-mail
            $mail->send();
            echo 'Message envoyé avec succès';
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
        }
    }
}
?>
    <div class="container">
        <h1 class="text-center font-weight-bold mb-4">Contactez-nous!</h1>
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-5 d-flex p-4">
                    <img src="../img/contact.svg" class="img-fluid p-4" alt="">
                </div>
                <div class="col-5">
                    <form id="contact-form" method="post">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div id="contact-error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group has-validation">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-signature"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="input-nom" name="nom" placeholder="Nom" aria-label="Nom" aria-describedby="basic-addon1" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ''; ?>">
                                </div>
                                <div class="text-danger" id="error-nom"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-signature"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="input-prenom" name="prenom" placeholder="Prénom" aria-label="Prénom" aria-describedby="basic-addon1" value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : ''; ?>">
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
                                    <input type="email" class="form-control" id="input-email" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                </div>
                                <div class="text-danger" id="error-email"></div>
                            </div>
                            <div class="form-group col-md-12" style="margin-bottom: -15px;">
                                <fieldset class="form-group">
                                    <label>Genre:</label>
                                    <div class="form-check inline">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input checked type="radio" id="customRadioInline1" name="genre" value="masculin" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline1">Masculin</label>
                                        </div>
                                    </div>
                                    <div class="form-check inline">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="genre" value="feminin" class="custom-control-input">
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
                                    <input id="input-date_naissance" name="date_naissance" class="form-control" type="date" value="<?php echo isset($_POST['date_naissance']) ? $_POST['date_naissance'] : ''; ?>" />
                                </div>
                                <div class="text-danger" id="error-date_naissance"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Métier:</label>
                                <select id="input-metier" class="form-select" name="metier" aria-label="Métier">
                                    <option hidden value="Sélectionner">Sélectionner</option>
                                    <option <?php echo isset($_POST['metier']) && $_POST['metier'] == 'etudiant' ? 'selected' : ''; ?> value="etudiant">Étudiant(e)</option>
                                    <option <?php echo isset($_POST['metier']) && $_POST['metier'] == 'enseignant' ? 'selected' : ''; ?> value="enseignant">Enseignant(e)</option>
                                    <option <?php echo isset($_POST['metier']) && $_POST['metier'] == 'ingenieur' ? 'selected' : ''; ?> value="ingenieur">Ingénieur(e)</option>
                                    <option <?php echo isset($_POST['metier']) && $_POST['metier'] == 'autre' ? 'selected' : ''; ?> value="autre">Autre</option>
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
                                    <input type="text" class="form-control" name="sujet" id="input-sujet" placeholder="Sujet" aria-label="Sujet" aria-describedby="basic-addon1" value="<?php echo isset($_POST['sujet']) ? $_POST['sujet'] : ''; ?>">
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
                                    <textarea class="form-control" id="input-message" name="message" placeholder="Message" rows="4"><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
                                </div>
                                <div class="text-danger" id="error-message"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
<?php include 'footer.php'; ?>
<script>
// Call the displayErrors function after the page has loaded
document.addEventListener('DOMContentLoaded', function() {
    displayErrors();
});
</script>
