<?php
require 'db.php'; // Your database connection file

if (!isset($_GET['token'])) {
    die("❌ Invalid request!");
}

$token = $_GET['token'];

// Check if token is valid
$stmt = $conn->prepare("SELECT email FROM users WHERE reset_token = ? AND reset_expiry > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($email);
    $stmt->fetch();
} else {
    die("❌ Invalid or expired token.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form action="update-password.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <label>New Password:</label>
        <input type="password" name="new_password" required>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>
