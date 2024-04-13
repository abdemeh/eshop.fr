<?php
include 'header.php';
?>
            <div class="container">
                <div class="container">
                    <h1 class="text-center font-weight-bold mb-4">Se connecter</h1>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-4">
                            <form id="login-form">
                                <div class="d-flex">
                                    <img src="img/login.svg" class="img-fluid mb-4" alt="">
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div id="login-error"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input id="input-login-email" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="text-danger" id="error-login-email"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                            </div>
                                            <input id="input-login-password" type="password" class="form-control" placeholder="Mot de passe" aria-label="Mot de passe" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="text-danger" id="error-login-password"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-check d-flex justify-content-between align-items-center">
                                            <div>
                                                <input type="checkbox" checked class="form-check-input" id="Se_Souvenir">
                                                <label class="form-check-label" for="Se_Souvenir">Se souvenir de moi</label>
                                            </div>
                                            <div class="ml-auto">
                                                <a class="" href="">Créer un compte</a>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="d-grid gap-2 form-group col-md-12">
                                        <button type="button" class="btn" onclick="validerLogin()">Se connecter</button>
                                    </div>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>