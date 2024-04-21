<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require '../vendor/phpmailer/phpmailer/src/SMTP.php';

function sendCustomEmail($receiverEmail, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'eshop.fr@outlook.com';
        $mail->Password = '{WLCEtuM6]=U(6t';

        $mail->setFrom('eshop.fr@outlook.com', 'eshop.fr');
        $mail->addAddress($receiverEmail);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->CharSet = "UTF-8";

        $mail->send();

        return array(true, "");
    } catch (Exception $e) {
        return array(false, $e->getMessage());
    }
}
?>
