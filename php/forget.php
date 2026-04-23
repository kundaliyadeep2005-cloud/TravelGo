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
        echo "❌ Invalid email format!";
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
            $mail->Password = 'qrtu zgol hovi snsa'; // Use App Password
            $mail->Port = 587;
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = 'html';

            $mail->setFrom('dkundaliya083@rku.ac.in', 'TravelGo');
            $mail->addAddress($userEmail);

            $resetLink = "https://yourwebsite.com/reset-password.php?token=" . urlencode($resetToken);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset - TravelGo';
            $mail->Body = "<p>Click the link below to reset your password:</p>
                           <a href='$resetLink'>$resetLink</a>";

            if ($mail->send()) {
                echo "✅ If this email is registered, a reset link has been sent.";
            } else {
                echo "❌ Error sending email: " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "❌ Email could not be sent: " . $mail->ErrorInfo;
        }
    } else {
        echo "✅ If this email is registered, a reset link has been sent.";
    }
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/forget.css">
</head>

<body>

    <!-- Navbar -->
    <header>
        <nav class="tg-navbar navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="tg-navbar-brand navbar-brand" href="#">TravelGo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#tg-navbarNav"
                    aria-controls="tg-navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="tg-navbarNav">
                    <ul class="tg-navbar-nav navbar-nav ms-auto">
                        <li class="tg-nav-item nav-item">
                            <a class="tg-nav-link nav-link" href="home.php">Home</a>
                        </li>
                        <li class="tg-nav-item nav-item">
                            <a class="tg-nav-link nav-link" href="package.php">Packages</a>
                        </li>
                        <li class="tg-nav-item nav-item">
                            <a class="tg-nav-link nav-link" href="booking.php">Book immediately</a>
                        </li>
                        <li class="tg-nav-item nav-item">
                            <a class="tg-nav-link nav-link" href="our-story.php">Our-story</a>
                        </li>
                        <li class="tg-nav-item nav-item">
                            <a class="tg-nav-link nav-link" href="profile.php">Profile</a>
                        </li>
                    </ul>
                    <a href="sign-up.php" class="tg-btn btn btn-outline-light ms-3 btn-sm">Sign-Up/sign-in</a>

                </div>
            </div>
        </nav>
    </header>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center mb-3">Forgot Password</h2>
            <p class="text-center">Enter your email to receive a password reset link.</p>

            <form id="forgotPasswordForm" action="forgot-password.php" method="POST">
                <div class="mb-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                        required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            </form>


            <p id="message" class="mt-3 text-center"></p>

            <div class="text-center mt-3">
                <a href="sign-in.php" class="text-decoration-none">Back to sign-in</a>
            </div>
        </div>
    </div>





    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Explore the world with TravelGo. We curate unique travel experiences that bring joy and adventure
                        to your journeys. Join us on an unforgettable adventure today!</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Destinations</a></li>
                        <li><a href="#">Packages</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@travelgo.com</p>
                    <p>Phone: +123 456 7890</p>
                    <p>Follow Us:
                        <a href="#">Facebook</a> |
                        <a href="#">Instagram</a>
                    </p>
                </div>
            </div>
            <div class="text-center mt-4">
                <hr>
                <p>&copy; 2025 TravelGo | All Rights Reserved</p>
                <hr>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/forget.js"></script>


</body>

</html>