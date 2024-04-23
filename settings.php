<?php
include 'php/header.php';
include_once 'php/main.php';

$settings = getSettings('settings.json');

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="error-message"></div>
        </div>
    </div> 
    <form id="settings-form" method="post" action="php/save_settings.php">
        <div class="row">
            <div class="col-6 mb-2">
                <h4 class="font-weight-bold">Général</h4>
                <div class="card widget-flat p-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <h6 class="text-muted">Devise</h6>
                                <select name="devise" id="input-metier" class="form-select" name="metier" aria-label="Métier">
                                    <option <?php if($settings['devise']=="€"){echo 'selected';}?> value="€">Euro (€)</option>
                                    <option <?php if($settings['devise']=="$"){echo 'selected';}?> value="$">Dollar ($)</option>
                                    <option <?php if($settings['devise']=="£"){echo 'selected';}?> value="£">Livre sterling (£)</option>
                                    <option <?php if($settings['devise']=="¥"){echo 'selected';}?> value="¥">Yen japonais (¥)</option>
                                    <option <?php if($settings['devise']=="₹"){echo 'selected';}?> value="₹">Roupie indienne (₹)</option>
                                    <option <?php if($settings['devise']=="₺"){echo 'selected';}?> value="₺">Livre turque (₺)</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">TVA (%)</h6>
                                <input name="tva" class="form-control input-only-numbers" max="100" min="0" type="number" value="<?php echo $settings['tva'];?>">
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Frais de livraison</h6>
                                <input name="livraison" class="form-control" step=".01" type="number" value="<?php echo $settings['livraison'];?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="text-muted">N° de téléphone</h6>
                                <input name="tel" class="form-control input-tel" type="text" value="<?php echo $settings['phone'];?>">
                            </div>
                            <div class="col-6">
                                <h6 class="text-muted">E-mail de contact</h6>
                                <input name="email_admin" class="form-control" type="email" value="<?php echo $settings['admin_contact_email'];?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <h6 class="text-muted">Lien Facebook</h6>
                                <input name="facebook_url" class="form-control" type="text" value="<?php echo $settings['facebook_url'];?>">
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Lien Instagram</h6>
                                <input name="instagram_url" class="form-control" type="text" value="<?php echo $settings['instagram_url'];?>">
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Lien Twitter/x</h6>
                                <input name="x_url" class="form-control" type="text" value="<?php echo $settings['x_url'];?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        
            <div class="col-6 mb-2">
                <h4 class="font-weight-bold">Paramètres SMTP</h4>
                <div class="card widget-flat p-1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="text-muted">Host</h6>
                                <input name="host" class="form-control" type="text" value="<?php echo $settings['host'];?>">
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Port</h6>
                                <input name="port" class="form-control input-only-numbers" minlength="3" maxlength="3" type="text" value="<?php echo $settings['port'];?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-7">
                                <h6 class="text-muted">SMTP email</h6>
                                <input name="smtp_email" class="form-control" type="text" value="<?php echo $settings['smtp_email'];?>">
                            </div>
                            <div class="col-5">
                                <h6 class="text-muted">SMTP Mot de passe</h6>
                                <input name="smtp_password" class="form-control" type="password" value="<?php echo $settings['smtp_password'];?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                    <h6 class="text-muted">SMTP Nom</h6>
                                    <input name="smtp_name" class="form-control" type="text" value="<?php echo $settings['smtp_name'];?>">
                            </div>
                            <div class="col-6">
                                    <h6 class="text-muted">SMTP Sécutité</h6>
                                    <select name="smtp_secure" class="form-select">
                                        <option <?php if($settings['smtp_secure']=="tls"){echo "selected";}?> value="tls">tls</option>
                                        <option <?php if($settings['smtp_secure']=="ssl"){echo "selected";}?> value="ssl">ssl</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
        <div class="col-4"></div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
<?php include 'php/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("settings-form").addEventListener("submit", function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('php/save_settings.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#error-message').html('<div class="alert alert-success alert-dismissible" role="alert">Toutes les paramètres sont enregistrés.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                $('#error-message').html('<div class="alert alert-success alert-dismissible" role="alert">Erreur dans l\'enregistrement des paramètres.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        })
        .catch(error => {
            $('#error-message').html('<div class="alert alert-success alert-dismissible" role="alert">Erreur dans l\'enregistrement des paramètres.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        });
    });
});
</script>
