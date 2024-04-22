<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '../vendor/phpmailer/phpmailer/src/Exception.php';
// require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require '../vendor/phpmailer/phpmailer/src/SMTP.php';

function sendCustomEmail($receiverEmail, $subject, $body, $settings) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $settings['host'];
        $mail->Port = (int)$settings['port'];
        $mail->SMTPSecure = $settings['smtp_secure'];
        $mail->SMTPAuth = true;
        $mail->Username = $settings['smtp_email'];
        $mail->Password = $settings['smtp_password'];

        $mail->setFrom($settings['smtp_email'], $settings['smtp_name']);
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
