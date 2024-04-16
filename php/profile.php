<?php
session_start();
include 'header.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

?>
    <div class="container">
        <h1 class="text-center font-weight-bold">Mon Profile</h1>
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="../img/profile.svg" height="200px" class="p-4" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                        <form id="contact-form" method="post">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div id="contact-message"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group has-validation">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="input-nom" name="nom" placeholder="Nom" value="<?php echo $nom;?>" aria-label="Nom" aria-describedby="basic-addon1">
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
                                    <input type="text" class="form-control" id="input-prenom" name="prenom" placeholder="Prénom" value="<?php echo $prenom;?>" aria-label="Prénom" aria-describedby="basic-addon1">
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
                                    <input type="email" class="form-control" id="input-email" name="email" placeholder="Email" value="<?php echo $email;?>" aria-label="Email" aria-describedby="basic-addon1">
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
                                    <input type="password" class="form-control" id="input-mdp" name="mdp" placeholder="Mot de passe" value="<?php echo $mdp;?>" aria-label="Mot de passe" aria-describedby="basic-addon1">
                                </div>
                                <div class="text-danger" id="error-mdp"></div>
                            </div>
                            <div class="form-group col-md-12" style="margin-bottom: -15px;">
                                <fieldset class="form-group">
                                    <label>Genre:</label>
                                    <div class="form-check inline">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input <?php if($genre=="M"){echo "checked";}?> type="radio" id="customRadioInline1" name="genre" value="masculin" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline1">Masculin</label>
                                        </div>
                                    </div>
                                    <div class="form-check inline">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input <?php if($genre=="F"){echo "checked";}?> type="radio" id="customRadioInline2" name="genre" value="feminin" class="custom-control-input">
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
                                    <input id="input-date_naissance" name="date_naissance" class="form-control" type="date" value="<?php echo $date_naissance;?>" />
                                </div>
                                <div class="text-danger" id="error-date_naissance"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Métier:</label>
                                <select id="input-metier" class="form-select" name="metier" aria-label="Métier">
                                    <option hidden value="Sélectionner">Sélectionner</option>
                                    <option <?php if($metier==1){echo "selected";}?> value="etudiant">Étudiant(e)</option>
                                    <option <?php if($metier==2){echo "selected";}?> value="enseignant">Enseignant(e)</option>
                                    <option <?php if($metier==3){echo "selected";}?> value="ingenieur">Ingénieur(e)</option>
                                    <option <?php if($metier==4){echo "selected";}?> value="autre">Autre</option>
                                </select>
                                <div class="text-danger" id="error-metier"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
<?php include 'footer.php'; ?>