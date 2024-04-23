<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $devise = $_POST['devise'];
    $tva = $_POST['tva'];
    $livraison = $_POST['livraison'];
    $tel = $_POST['tel'];
    $email_admin = $_POST['email_admin'];
    $facebook_url = $_POST['facebook_url'];
    $instagram_url = $_POST['instagram_url'];
    $x_url = $_POST['x_url'];
    $host = $_POST['host'];
    $port = $_POST['port'];
    $smtp_email = $_POST['smtp_email'];
    $smtp_password = $_POST['smtp_password'];
    $smtp_name = $_POST['smtp_name'];
    $smtp_secure = $_POST['smtp_secure'];

    if(trim($tva)==""){
        $tva=0;
    }
    if(trim($livraison)==""){
        $livraison=0;
    }
    $settingsData = array(
        "devise" => $devise,
        "tva" => $tva,
        "livraison" => $livraison,
        "phone"=> $tel,
        "admin_contact_email"=> $email_admin,
        "facebook_url"=> $facebook_url,
        "instagram_url"=> $instagram_url,
        "x_url"=> $x_url,
        "host"=> $host,
        "port"=> (int)$port,
        "smtp_email"=> $smtp_email,
        "smtp_password"=> $smtp_password,
        "smtp_name"=> $smtp_name,
        "smtp_secure"=> $smtp_secure,
    );
    $jsonData = json_encode($settingsData, JSON_PRETTY_PRINT);

    $filePath = "../settings.json";
    if (file_put_contents($filePath, $jsonData) !== false) {
        header('Location: ../settings.php?success=Paramètres enregistrés.');
        exit;
    } else {
        header('Location: ../settings.php?error=Erreur lors de l\'enregistrement des paramètres.');
        exit;
    }
} else {
    header('Location: ../settings.php');
    exit;
}
?>