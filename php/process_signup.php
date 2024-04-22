<?php
// Include necessary files
include "mail_send.php";
require "../vendor/autoload.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $genre = isset($_POST["genre"]) ? $_POST["genre"] : "";
    $date_naissance = $_POST["date_naissance"];
    $metier = $_POST["metier"];

    // Initialize an array to store any errors
    $errors = [];

    // Validate form data
    if (empty($nom)) {
        $errors["nom"] = "Veuillez entrer un nom!";
    }

    // Repeat validation for other fields...

    // If there are no errors, proceed with database insertion and email sending
    if (empty($errors)) {
        // Generate a unique verification token
        $token = md5(uniqid(mt_rand(), true));

        // Include the database connection file
        include "bddData.php";

        // Hash the password for security
        $hashedPassword = md5($mdp);

        // SQL query to insert data into the database
        $sql = "INSERT INTO users (nom, prenom, email, mdp, genre, date_naissance, metier_id, role, verification_token) 
                VALUES ('$nom', '$prenom', '$email', '$hashedPassword', '$genre', '$date_naissance', $metier, 'user', '$token')";

        try {
            // Execute the SQL query
            if ($conn->query($sql) === TRUE) {
                // Construct the verification email body
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                $host = $_SERVER['HTTP_HOST'];
                $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $verificationLink = $protocol . '://' . $host . $path . '/verify_email.php?token=' . $token;
                $email_body = '
                    <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Finaliser votre inscription</title>
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                        <style>
                        body {
                            font-family: "Poppins", sans-serif !important;
                        }
                        .btn{
                            background: #f8b739;
                            border-color: #f8b739;
                            color: #fff;
                            cursor: pointer;
                            border-radius: 25px;
                            padding: 10px 30px 10px 30px;
                            font-weight: 500;
                        }
                        .btn:hover{
                            background: #ebb03a;
                            border-color: #ebb03a;
                            color: #fff;
                            cursor: pointer;
                        }
                        .icon{
                            background: #f8b739;
                            border-color: #f8b739;
                            color: #fff;
                            cursor: pointer;
                            border-radius: 100px;
                            padding: 15px;
                            font-weight: 500;  
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
                                        <center><h2><b>Veuillez vérifier votre compte</b></h2></center>
                                        <center><p>Vous êtes sur le point d\'obtenir votre compte.<br>Pour vérifier votre compte, veuillez cliquer sur le bouton ci-dessous :</p></center>
                                        <center><a href="' . $verificationLink . '" class="btn btn-primary">Vérifier votre compte</a></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>';

                // Send the verification email
                $resultSendVerificationEmail = sendCustomEmail($email, 'Vérification de création de compte sur eshop.fr', $email_body, $settings);

                // Check if the email was sent successfully
                if ($resultSendVerificationEmail[0] == true) {
                    // Redirect to the signup page with success message
                    $response = [
                        'success' => 1,
                        'message' => 'Compte créé avec succès. Un email de vérification a été envoyé à '.$email
                    ];
                } else {
                    // Redirect to the signup page with error message
                    $response = [
                        'success' => 0,
                        'message' => 'Erreur lors de l\'envoi de l\'email de vérification. Veuillez réessayer.'
                    ];
                }
            }
        } catch (mysqli_sql_exception $e) {
            // Handle database errors
            if ($e->getCode() == 1062) {
                $response = [
                    'success' => 0,
                    'message' => 'Un autre utilisateur avec cet email existe déjà. Veuillez choisir une autre adresse email.'
                ];
            } else {
                $response = [
                    'success' => 0,
                    'message' => 'Erreur: ' . $e->getMessage()
                ];
            }
        }

        // Close the database connection
        $conn->close();
    } else {
        // If there are validation errors, construct an error response
        $response = [
            'success' => 0,
            'message' => 'Veuillez corriger les erreurs dans le formulaire.',
            'errors' => $errors
        ];
    }

    // Send JSON response back to the AJAX request
    echo json_encode($response);
} else {
    $response = [
        'success' => 0,
        'message' => 'Erreur: La méthode de requête n\'est pas autorisée.'
    ];
    echo json_encode($response);
}
?>
