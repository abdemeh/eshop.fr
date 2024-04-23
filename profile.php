<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'php/bddData.php';
include_once 'php/main.php';

$metiers = getMetiers($conn);
$userData = getUserData($_SESSION['user_id'], $conn);

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
                            <div id="error-message"></div>
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
                                <form id="edit-image-form" method="POST" enctype="multipart/form-data">
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
                                    <input id="input-nom" name="nom" class="form-control input-only-text" type="text" value="<?php echo $userData['nom'] ?? ''; ?>">
                                </div>
                                <div class="text-danger" id="error-nom"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="has-validation">
                                    <h6 class="text-muted">Prenom</h6>
                                    <input id="input-prenom" name="prenom" class="form-control input-only-text" type="text" value="<?php echo $userData['prenom'] ?? ''; ?>">
                                </div>
                                <div class="text-danger" id="error-prenom"></div>
                            </div>
                            <div class="form-group col-md-7">
                                <div class="has-validation">
                                    <h6 class="text-muted">E-mail</h6>
                                    <input id="input-email" name="email" class="form-control" type="email" value="<?php echo $userData['email'] ?? ''; ?>">
                                </div>
                                <div class="text-danger" id="error-email"></div>
                            </div>
                            <div class="form-group col-md-5">
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
                        <button type="button" id="submit-profile" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php include 'php/footer.php'; ?>
<script>
    $(document).ready(function() {
        $('#submit-profile').click(function(e) {
            e.preventDefault();

            if (!validateFormInputs()) {
                return;
            }
        
            $.ajax({
                type: "POST",
                url: "php/update_profile.php",
                data: $("#profile-form").serialize(),
                success: function(response) {
                    $('#error-message').html('<div class="alert alert-success alert-dismissible" role="alert">Données utilisateur enregistrés avec succès.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                },
                error: function(xhr, status, error) {
                    $('#error-message').html('<div class="alert alert-danger alert-dismissible" role="alert">Erreur dans l\'enregistrement des données.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
            });
        });
        $('#edit-image-form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: 'php/upload_image.php',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json', 
                success: function(response) {
                    var img = $('#profile-pic');
                    var img_user = $('#small-icon-user-image');
                    var src = img.attr('src');
                    img.attr('src', src + '?' + new Date().getTime());
                    img_user.attr('src', src + '?' + new Date().getTime());
                    if(response.success){
                        $('#error-message').html('<div class="alert alert-success alert-dismissible" role="alert">'+response.message+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
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

    function validateFormInputs() {
        var isValid = true;

        var fields = [
            { inputId: '#input-metier', errorId: '#error-metier', errorMessage: 'Veuillez choisir une option.' },
            { inputId: '#input-nom', errorId: '#error-nom', errorMessage: 'Veuillez entrer un nom.' },
            { inputId: '#input-prenom', errorId: '#error-prenom', errorMessage: 'Veuillez entrer un prénom.' },
            { inputId: '#input-email', errorId: '#error-email', errorMessage: 'Veuillez entrer un email.' },
            { inputId: '#input-mdp', errorId: '#error-mdp', errorMessage: 'Veuillez entrer un mot de passe.' },
            { inputId: '#input-date_naissance', errorId: '#error-date_naissance', errorMessage: 'Veuillez entrer une date.' },
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
