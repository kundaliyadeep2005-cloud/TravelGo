<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kundaliyadeep2005@gmail.com'; // Your Gmail
    $mail->Password = 'zrbt dwfq ktyg evyg'; // Use App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPDebug = 2; 
    $mail->Debugoutput = 'html'; 

    $mail->setFrom('dkundaliya083@rku.ac.in', 'TravelGo');
    $mail->addAddress('test@example.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email';

    if ($mail->send()) {
        echo "✅ Email sent successfully.";
    } else {
        echo "❌ Error sending email: " . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "❌ Email could not be sent: " . $mail->ErrorInfo . "\n" . $e->getMessage();
}
