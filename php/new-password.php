<?php
include 'db.php'; // Ensure database connection

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        </head>
        <body>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card p-4 shadow-lg">
                <h2 class="text-center mb-3">Reset Your Password</h2>
                <p class="text-center">Enter your new password below.</p>

                <form action="update-password.php" method="POST">
                    <input type="hidden" name="token" value="'.htmlspecialchars($token, ENT_QUOTES, 'UTF-8').'">
                    <div class="mb-3">
                        <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Password</button>
                </form>

                <div class="text-center mt-3">
                    <a href="sign-in.php" class="text-decoration-none">Back to sign-in</a>
                </div>
            </div>
        </div>
        </body>
        </html>';
    } else {
        echo '<p style="color: red; text-align: center;">Invalid or expired token!</p>';
    }

    $stmt->close();
    $conn->close();
} else {
    echo '<p style="color: red; text-align: center;">Invalid Request!</p>';
}
?>
