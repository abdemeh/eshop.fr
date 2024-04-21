<?php
include "php/mail_send.php";
include "php/main.php";
include "php/header.php";
include 'php/bddData.php';
require "vendor/autoload.php";

$settings = getSettings('settings.json');
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
                    <div id="error-message-main">
                        <?php if (isset($_GET["error"])) {
                            echo '<div class="alert alert-danger alert-dismissible" role="alert">' . htmlspecialchars($_GET["error"]) .
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        } elseif (isset($_GET["success"])) {
                            echo '<div class="alert alert-success alert-dismissible" role="alert">' . htmlspecialchars($_GET["success"]) .
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        }
                        ?>
                    </div>
                    <div id="contact-form-wrapper">
                        <form id="contact-form">
                            <div class="form-row">
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
                                                <input type="radio" id="radio-genre-m" name="genre" value="M" class="custom-control-input">
                                                <label class="custom-control-label" for="radio-genre-m">Masculin</label>
                                            </div>
                                        </div>
                                        <div class="form-check inline">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="radio-genre-f" name="genre" value="F" class="custom-control-input">
                                                <label class="custom-control-label" for="radio-genre-f">Féminin</label>
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
</div>
<?php include "php/footer.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function () {
    $('#contact-form').submit(function (e) {
        e.preventDefault();
        
        if (!validateFormInputs()) {
            return;
        }

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'php/process_contact.php',
            data: formData,
            dataType: 'json', 
            success: function (response) {
                if (response.success == 1) {
                    $('#error-message-main').html('<div class="alert alert-success alert-dismissible" role="alert">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                } else {
                    $('#error-message-main').html('<div class="alert alert-danger alert-dismissible" role="alert">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                $('#error-message-main').html('<div class="alert alert-danger alert-dismissible" role="alert">An error occurred while processing your request. Please try again later.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        });
    });
});
    function validateFormInputs() {
        var isValid = true;

        var fields = [
            { inputId: '#input-metier', errorId: '#error-metier', errorMessage: 'Veuillez choisir une option.' },
            { inputId: '#input-nom', errorId: '#error-nom', errorMessage: 'Veuillez entrer un nom.' },
            { inputId: '#input-prenom', errorId: '#error-prenom', errorMessage: 'Veuillez entrer un prénom.' },
            { inputId: '#input-email', errorId: '#error-email', errorMessage: 'Veuillez entrer un email.' },
            { inputId: '#input-date_naissance', errorId: '#error-date_naissance', errorMessage: 'Veuillez entrer une date.' },
            { inputId: '#input-sujet', errorId: '#error-sujet', errorMessage: 'Veuillez entrer un sujet.' },
            { inputId: '#input-message', errorId: '#error-message', errorMessage: 'Veuillez entrer un message.' }
        ];

        fields.forEach(function(field) {
            var inputValue = $.trim($(field.inputId).val());
            var errorElement = $(field.errorId);

            if (inputValue === '' || inputValue === 'Sélectionner') {
                errorElement.html(field.errorMessage);
                $(field.inputId).addClass('is-invalid');
                isValid = false;
            } else {
                errorElement.html('');
                $(field.inputId).removeClass('is-invalid');
            }
        });

        if ($('input[name="genre"]:checked').length === 0) {
            $('#error-genre').html('Veuillez choisir un genre.');
            $('input[name="genre"]').addClass('is-invalid');
            isValid = false;
        } else {
            $('#error-genre').html('');
            $('input[name="genre"]').removeClass('is-invalid');
        }

        return isValid;
    }
</script>

