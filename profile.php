<?php
session_start();

function getUserData($userId) {
    $userData = [];

    // Read the contents of the file
    $lines = file("txt/utilisateurs.txt");

    // Iterate through each line
    foreach ($lines as $line) {
        // Check if the line starts with the user ID
        if (strpos($line, "{$userId}:") === 0) {
            // Split the line into individual fields
            $fields = explode(':', $line);

            // Extract relevant data
            $userData['nom'] = $fields[1];
            $userData['prenom'] = $fields[2];
            $userData['email'] = $fields[3];
            $userData['mdp'] = $fields[4];
            $userData['genre'] = $fields[5];
            $userData['date_naissance'] = $fields[6];
            $userData['metier'] = $fields[7];

            break;
        }
    }

    return $userData;
}
$userData = getUserData($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['mdp'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $date_naissance = $_POST['date_naissance'] ?? '';
    $metier = $_POST['metier'] ?? '';

    if (empty($nom) || empty($prenom) || empty($email) || empty($mdp) || empty($genre) || empty($date_naissance) || empty($metier)) {
        header('Location: profile.php?error=Tous les champs sont requis.');
        exit();
    }

    $userData = "{$_SESSION['user_id']}:{$nom}:{$prenom}:{$email}:{$mdp}:{$genre}:{$date_naissance}:{$metier}:user";

    // Read the contents of the file
    $lines = file("txt/utilisateurs.txt");

    // Iterate through each line
    foreach ($lines as $index => $line) {
        // Check if the line starts with the user ID
        if (strpos($line, "{$_SESSION['user_id']}:") === 0) {
            // Replace the line with the new user data
            $lines[$index] = $userData . PHP_EOL;
            break;
        }
    }

    // Write the updated contents back to the file
    file_put_contents("txt/utilisateurs.txt", implode('', $lines));

    header('Location: profile.php?success=Données utilisateur mises à jour avec succès.');
    exit();
}

include 'php/header.php';
?>
    <div class="container">
        <h1 class="text-center font-weight-bold">Mon Profile</h1>
        <div class="container">
            <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div id="error-message"><?php
                                            if (isset($_GET['error'])){
                                                echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_GET['error']) . '</div>';
                                            }elseif (isset($_GET['success'])){
                                                echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_GET['success']) . '</div>';
                                            }
                                            ?>
                </div>
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
                            <form id="edit-image-form" action="php/upload_image.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="file" id="edit-image-input" accept=".jpg" hidden>
                            </form>
                        </div>
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
                                    <input type="text" class="form-control" id="input-nom" name="nom" placeholder="Nom" value="<?php echo $userData['nom'] ?? ''; ?>" aria-label="Nom" aria-describedby="basic-addon1">
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
                                    <input type="text" class="form-control" id="input-prenom" name="prenom" placeholder="Prénom" value="<?php echo $userData['prenom'] ?? ''; ?>" aria-label="Prénom" aria-describedby="basic-addon1">
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
                                    <input type="email" class="form-control" id="input-email" name="email" placeholder="Email" value="<?php echo $userData['email'] ?? ''; ?>" aria-label="Email" aria-describedby="basic-addon1">
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
                                    <input type="password" class="form-control" id="input-mdp" name="mdp" placeholder="Mot de passe" value="<?php echo $userData['mdp'] ?? ''; ?>" aria-label="Mot de passe" aria-describedby="basic-addon1">
                                </div>
                                <div class="text-danger" id="error-mdp"></div>
                            </div>
                            <div class="form-group col-md-12" style="margin-bottom: -15px;">
                                <fieldset class="form-group">
                                    <label>Genre:</label>
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
                                    <input id="input-date_naissance" name="date_naissance" class="form-control" type="date" value="<?php echo $userData['date_naissance'] ?? ''; ?>" />
                                </div>
                                <div class="text-danger" id="error-date_naissance"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Métier:</label>
                                <select id="input-metier" class="form-select" name="metier" aria-label="Métier">
                                    <option hidden value="Sélectionner">Sélectionner</option>
                                    <option <?php if($userData['metier']==1){echo "selected";}?> value="1">Étudiant(e)</option>
                                    <option <?php if($userData['metier']==2){echo "selected";}?> value="2">Enseignant(e)</option>
                                    <option <?php if($userData['metier']==3){echo "selected";}?> value="3">Ingénieur(e)</option>
                                    <option <?php if($userData['metier']==4){echo "selected";}?> value="4">Autre</option>
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
<?php include 'php/footer.php'; ?>