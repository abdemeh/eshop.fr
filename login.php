<?php include 'php/header.php'; ?>
<div class="container">
    <div class="container">
        <h1 class="text-center font-weight-bold mb-4">Se connecter</h1>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-4">
                <div class="card p-4 mt-2">
                    <div id="error-message">
                    </div>
                    <form id="login-form" method="post" action="php/authentification.php">
                        <div class="d-flex">
                            <img src="img/login.svg" class="img-fluid mb-4" alt="">
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div id="login-error"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="has-validation">
                                <h6 class="text-muted">E-mail</h6>
                                    <input name="login" id="input-login-email" name="login" class="form-control" type="email">
                                </div>
                                <div class="text-danger" id="error-login-email"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="has-validation">
                                    <h6 class="text-muted">Mot de passe</h6>
                                    <input name="mot_de_passe" id="input-login-password" name="password" class="form-control" type="password">
                                </div>
                                <div class="text-danger" id="error-login-password"></div>
                            </div>
                            <div class="form-group col-12">
                                <div class="form-check d-flex justify-content-between align-items-center">
                                    <div>
                                        <input type="checkbox" name="se_souvenir" checked class="form-check-input" id="Se_Souvenir">
                                        <label class="form-check-label" for="Se_Souvenir">Se souvenir de moi</label>
                                    </div>
                                    <div class="ml-auto">
                                        <a class="" href="sign_up.php">Créer un compte</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Se connecter</button>
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
<?php include 'php/footer.php'; ?>
<script>
$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault();
        if (!validateFormInputs()) {
            return;
        }
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.success === 1) {
                    if(jsonResponse.role === 'user') {
                        window.location.href = 'index.php';
                    } else if(jsonResponse.role === 'admin') {
                        window.location.href = 'admin.php';
                    }
                } else {
                    $('#error-message').html('<div class="alert alert-danger alert-dismissible" role="alert">' + jsonResponse.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
            },
            error: function(xhr, status, error) {
                $('#error-message').html('<div class="alert alert-danger alert-dismissible" role="alert">' + error + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        });
    });
});
function validateFormInputs() {
    var isValid = true;
    if ($.trim($('#input-login-email').val())=='') {
        $('#error-login-email').html('Veuillez entrer un email.');
        $('#input-login-email').addClass('is-invalid');
        isValid = false;
    } else {
        $('#error-login-email').html('');
        $('input-login-email').removeClass('is-invalid');
    }

    if ($.trim($('#input-login-password').val())=='') {
        $('#error-login-password').html('Veuillez entrer un mot de passe.');
        $('#input-login-password').addClass('is-invalid');
        isValid = false;
    } else {
        $('#error-login-password').html('');
        $('input-login-password').removeClass('is-invalid');
    }
    return isValid;
}

</script>
