<?php
// Include PHPMailer autoload file
require 'vendor/autoload.php';

include_once 'php/main.php';
$settings = getSettings('settings.json');

// Create a new PHPMailer instance
$mail = new PHPMailer\PHPMailer\PHPMailer();

// Set mailer to use SMTP
$mail->isSMTP();

// Specify SMTP settings
$mail->isSMTP();
$mail->Host = $settings['host'];
$mail->Port = (int)$settings['port'];
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = $settings['smtp_email'];
$mail->Password = $settings['smtp_password'];


// $mail->isSMTP();
// $mail->Host = 'smtp-mail.outlook.com';
// $mail->Port = 587;
// $mail->SMTPSecure = 'tls';
// $mail->SMTPAuth = true;
// $mail->Username = 'eshop.fr@outlook.com';
// $mail->Password = '{WLCEtuM6]=U(6t';

// Set sender and recipient
$mail->setFrom('eshop.fr@outlook.com', 'Your Name');
$mail->addAddress('eshop.fr@outlook.com', 'Recipient Name');

// Add a subject
$mail->Subject = 'Test Email using PHPMailer';

// Add email body
$mail->Body    = 'This is a test email sent using PHPMailer.';

// Send the email
if(!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent successfully';
}
?>
