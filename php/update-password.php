<?php
require 'db.php'; // Your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Update password and remove token
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE email = ?");
    $stmt->bind_param("ss", $newPassword, $email);
    
    if ($stmt->execute()) {
        echo "✅ Password updated successfully!";
    } else {
        echo "❌ Error updating password.";
    }
    $stmt->close();
    $conn->close();
}
?>
