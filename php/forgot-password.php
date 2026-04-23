<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'db.php'; // Your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = $_POST['email'];

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        echo "error";
        exit;
    }

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Generate a reset token
        $resetToken = bin2hex(random_bytes(32));
        $resetExpiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store token in database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $resetToken, $resetExpiry, $userEmail);
        $stmt->execute();

        // Send reset email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kundaliyadeep2005@gmail.com';
            $mail->Password = 'zrbt dwfq ktyg evyg'; // Use App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->SMTPDebug = 0; // Turn off debug output for clean AJAX response
            $mail->Debugoutput = 'html'; 

            $mail->setFrom('dkundaliya083@rku.ac.in', 'TravelGo');
            $mail->addAddress($userEmail);

            $resetLink = "http://localhost/sem-6/reset-password.php?token=" . urlencode($resetToken);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset - TravelGo';
            $mail->Body = "<p>Click the link below to reset your password:</p>
                           <a href='$resetLink'>$resetLink</a>";

            if ($mail->send()) {
                echo "success";
            } else {
                echo "error";
            }
        } catch (Exception $e) {
            echo "error";
        }
    } else {
        // According to the JS, there's a specific message for this
        echo "email_not_found";
    }
    $stmt->close();
    $conn->close();
}
?>
