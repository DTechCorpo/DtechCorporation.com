<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Collect form data
$name     = $_POST['name'] ?? '';
$email    = $_POST['email'] ?? '';
$phone    = $_POST['phone'] ?? '';
$project  = $_POST['project'] ?? '';
$subject  = $_POST['subject'] ?? '';
$message  = $_POST['message'] ?? '';

// Validate
/*
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "Please fill in all required fields.";
    exit;
}
*/
// Email content
$body = "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Phone: $phone\n";
$body .= "Project: $project\n";
$body .= "Subject: $subject\n\n";
$body .= "Message:\n$message";

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@d-techcorporation.com'; // Your Gmail
    $mail->Password   = 'D-Tech@2501';   // App Password, not Gmail password!
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('info@d-techcorporation.com'); // Where to send the message

    // Content
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
    echo "Message sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
