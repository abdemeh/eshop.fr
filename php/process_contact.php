<?php
include "mail_send.php";
include "main.php";
include "bddData.php";
require "../vendor/autoload.php";

$response = [];
$settings = getSettings('../settings.json');

$get_metiers = getMetiers($conn);

$conn->close();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $genre = isset($_POST["genre"]) ? $_POST["genre"] : "";
    $date_naissance = $_POST["date_naissance"];
    $metier = $_POST["metier"];
    $sujet = $_POST["sujet"];
    $message = $_POST["message"];

    $errors = [];
    if (empty($nom)) {$errors["nom"] ="Veuillez entrer un nom!";}
    if (empty($prenom)) {$errors["prenom"] ="Veuillez entrer un prénom!";}
    if (empty($email)) {$errors["email"] ="Veuillez entrer un email!";} elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {$errors["email"] ="Veuillez entrer un email valide!";}
    if (empty($sujet)) {$errors["sujet"] ="Veuillez entrer un sujet!";}
    if (empty($message)) {$errors["message"] ="Veuillez entrer un message!";}
    if (empty($date_naissance)) {$errors["date_naissance"] ="Veuillez entrer une date!";}
    if (empty($genre)) {$errors["genre"] ="Veuillez sélectionner un genre!";}
    if ($metier == "Sélectionner") {$errors["metier"] ="Veuillez choisir un métier!";}
    
    if (empty($errors)) {
            foreach ($get_metiers as $get_metier) {
                if($metier==$get_metier['id']){
                    $metier = $get_metier['libelle'];
                    break;
                }
            
        }

        if ($genre == "M") {
            $genre = "Masculin";
        } elseif ($genre == "F") {
            $genre = "F&eacute;minin";
        }

        $email_body ='
                    <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Nouveau message de contact</title>
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                        <style>
                            body {
                                font-family: "Poppins", sans-serif !important;
                            }
                            .card {
                                position: relative;
                                display: -webkit-box;
                                display: -ms-flexbox;
                                display: flex;
                                -webkit-box-orient: vertical;
                                -webkit-box-direction: normal;
                                -ms-flex-direction: column;
                                flex-direction: column;
                                min-width: 0;
                                word-wrap: break-word;
                                background-color: #fff;
                                background-clip: border-box;
                                border: none;
                                border-radius: 1.25rem;
                                box-shadow: rgba(0, 0, 0, 0.06) 7px 7px 20px 0px;
                            } 
                        </style>
                    </head>
                    <body>
                        <div class="container mt-4">
                            <div class="card p-4"> 
                                <div class="row justify-content-center mb-4 mt-4">
                                    <div class="col-10 col-md-8 col-lg-6 text-center">
                                    <center><h1 class="mb-4"><img src="https://i.ibb.co/8gWprM7/logo.png" height="40" alt=""></h1></center>
                                        <center><h2><b>Nouveau message de contact</b></h2></center>
                                        <center><p><strong>Nom: </strong> '.$nom.'</p></center>
                                        <center><p><strong>Pr&eacute;nom: </strong>'.$prenom.'</p></center>
                                        <center><p><strong>Email: </strong>'.$email.'</p></center>
                                        <center><p><strong>Genre: </strong>'.$genre.'</p></center>
                                        <center><p><strong>Date de naissance: </strong>'.$date_naissance.'</p></center>
                                        <center><p><strong>M&eacute;tier: </strong>'.$metier.'</p></center>
                                        <center><p><strong>Sujet: </strong>'.$sujet.'</p></center>
                                        <center><p><strong>Message: </strong>'.$message.'</p></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>  
                    ';

        $resultSendCustomEmail = sendCustomEmail($settings['admin_contact_email'], 'Nouveau message de contact de ' . $nom . ' ' . $prenom, $email_body);
                    
        if($resultSendCustomEmail[0]==true){
            $response = [
                'success' => 1,
                'message' => 'Message envoyé avec succès.'
            ];
        }else{
            $response = [
                'success' => 0,
                'message' => 'Erreur dans l\'envoi de mail.'
            ];
        }
        
    } else {
        $response = [
            'success' => 0,
            'message' => 'Veuillez corriger les erreurs dans le formulaire.',
            'errors' => $errors
        ];
    }

} else {
    $response = [
        'success' => 0,
        'message' => 'Erreur: La méthode de requête n\'est pas autorisée.'
    ];
}

echo json_encode($response);
?>
