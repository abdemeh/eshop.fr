<?php
session_start();
include 'bddData.php';
include "mail_send.php";
include_once 'main.php';
require "../vendor/autoload.php";

$settings = getSettings('settings.json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"]; 
    $montant_tt = $_POST["montant_tt"];
    $mode_paiement = $_POST["mode_paiement"];
    $user_email ="contact@eshop.fr";

    $sql = "UPDATE commande SET order_state = 'paid' WHERE user_id = $user_id";
    $sql_insert = "INSERT INTO payment (user_id, payment_date, montant, mode_paiement) VALUES ($user_id, NOW(), $montant_tt, '$mode_paiement')";

    $sql_get_email = "SELECT email FROM users WHERE id = $user_id";
    $result = $conn->query($sql_get_email);
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_email = $row['email'];
        }
    }

    if ($conn->query($sql) === TRUE && $conn->query($sql_insert) === TRUE) {
        $conn->close();

        $email_body ='
                    <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Merci pour votre commande</title>
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
                                <div class="col-10 col-md-8 col-lg-6 text-center mb-4">
                                    <center><h1 class="mb-4"><img src="https://i.ibb.co/8gWprM7/logo.png" height="40" alt=""></h1></center>
                                    <center><h2><b>Merci pour votre commande</b></h2></center>
                                    <center><p>Votre commande de '.$montant_tt.' '.htmlspecialchars($settings['devise'], ENT_QUOTES, 'UTF-8').' est en v&eacute;rification.
                                    Un e-mail sera vous envoy&eacute; quand votre commande sera v&eacute;rifi&eacute;.</p></center>
                                </div>
                            </div>
                        </div>
                    </div>
                    </body>
                    </html>  
                    ';
        $resultSendCustomEmail = array(false,"");
        $resultSendCustomEmail = sendCustomEmail($user_email, 'Merci pour votre commande', $email_body);
        
        if($resultSendCustomEmail[0]==true){
            echo "<script>window.location.href='contact.php?success=Messsage envoyé avec succès';</script>";
        }

        header('Location: ../panier.php?success=Merci pour votre commande. Vous recevrez bientôt un e-mail contenant tous les détails de votre commande.');
    } else {
        $conn->close();
        header('Location: ../panier.php?error=Erreur lors du paiement: '.$conn->error);
    }
}
?>