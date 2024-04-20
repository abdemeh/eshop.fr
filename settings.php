<?php

include 'php/header.php';
include 'php/main.php';

$settings = getSettings();

?>
<div class="container">
    <h1 class="text-center font-weight-bold">Paramètres</h1>
    <div class="row">
        <div class="col-2 mb-2"></div>
        <div class="col-8 mb-2">
            <div class="card widget-flat p-1">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="text-muted">Devise <i class="fa-solid fa-money-bill"></i></h6>
                                <select id="input-metier" class="form-select" name="metier" aria-label="Métier">
                                    <option <?php if($settings['devise']=="€"){echo 'selected';}?> value="€">Euro (€)</option>
                                    <option <?php if($settings['devise']=="$"){echo 'selected';}?> value="$">Dollar ($)</option>
                                    <option <?php if($settings['devise']=="£"){echo 'selected';}?> value="£">Livre sterling (£)</option>
                                    <option <?php if($settings['devise']=="¥"){echo 'selected';}?> value="¥">Yen japonais (¥)</option>
                                    <option <?php if($settings['devise']=="₹"){echo 'selected';}?> value="₹">Roupie indienne (₹)</option>
                                    <option <?php if($settings['devise']=="₺"){echo 'selected';}?> value="₺">Livre turque (₺)</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">TVA (%) <i class="fa-solid fa-landmark"></i></h6>
                                <input name="tva" class="form-control input-only-numbers" max="100" min="0" type="number" value="<?php echo $settings['tva'];?>">
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Frais de livraison <i class="fa-solid fa-truck"></i></h6>
                                <input name="livraison" class="form-control" step=".01" type="number" value="<?php echo $settings['livraison'];?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="text-muted">N° de téléphone <i class="fa-solid fa-square-phone"></i></h6>
                                <input name="tel" class="form-control input-tel" type="text" value="<?php echo $settings['phone'];?>">
                            </div>
                            <div class="col-6">
                                <h6 class="text-muted">E-mail de contact <i class="fa-solid fa-envelope"></i></h6>
                                <input name="email_admin" class="form-control" type="email" value="<?php echo $settings['admin_contact_email'];?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <h6 class="text-muted">Lien Facebook <i class="fa-brands fa-facebook"></i></h6>
                                <input name="facebook_url" class="form-control" type="text" value="<?php echo $settings['facebook_url'];?>">
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Lien Instagram <i class="fa-brands fa-instagram"></i></h6>
                                <input name="instagram_url" class="form-control" type="text" value="<?php echo $settings['instagram_url'];?>">
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted">Lien Twitter (X) <i class="fa-brands fa-x-twitter"></i></h6>
                                <input name="x_url" class="form-control" type="text" value="<?php echo $settings['x_url'];?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-25">Enregistrer</button>
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
