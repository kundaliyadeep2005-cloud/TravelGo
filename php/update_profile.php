<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: sign-in.php");
    exit();
}
include 'db.php';

$user_id = $_SESSION["user_id"];

// Fetch current user details
$stmt = $conn->prepare("SELECT fullname, email, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$fullname = $user["fullname"];
$email = $user["email"];
$profile_image = $user["profile_image"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_fullname = !empty(trim($_POST["fullname"])) ? trim($_POST["fullname"]) : $fullname;
    $new_email = !empty(trim($_POST["email"])) ? trim($_POST["email"]) : $email;
    $password = trim($_POST["password"]);
    $new_profile_image = $profile_image;

    // Fetch current password
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($current_password);
    $stmt->fetch();
    $stmt->close();

    // Handle profile picture update
    if (isset($_FILES["profilePicture"]) && $_FILES["profilePicture"]["error"] === 0) {
        $upload_dir = "../uploads/profile_pictures/"; // Filesystem path for saving
        $web_path   = "uploads/profile_pictures/"; // Web-accessible path stored in DB

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_ext = strtolower(pathinfo($_FILES["profilePicture"]["name"], PATHINFO_EXTENSION));
        $allowed_exts = ["jpg", "jpeg", "png", "gif"];

        if (in_array($file_ext, $allowed_exts)) {
            $new_file_name = "profile_" . $user_id . "_" . time() . "." . $file_ext;
            $target_path   = $upload_dir . $new_file_name; // Used for move_uploaded_file

            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_path)) {
                $new_profile_image = $web_path . $new_file_name; // Store web path in DB
            }
        }
    }

    // Update password only if entered
    $hashed_password = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : $current_password;

    $update_query = "UPDATE users SET fullname=?, email=?, password=?, profile_image=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssi", $new_fullname, $new_email, $hashed_password, $new_profile_image, $user_id);

    if ($stmt->execute()) {
        $_SESSION["fullname"] = $new_fullname;
        $_SESSION["email"] = $new_email;
        $_SESSION["profile_image"] = $new_profile_image;
        $_SESSION["success_message"] = "Profile updated successfully!";
    } else {
        $_SESSION["error_message"] = "Error updating profile!";
    }

    $stmt->close();
    $conn->close();

    // Redirect to profile.php
    header("Location: profile.php");
    exit();
}
?>


<?php 
$page_title = 'Update Profile | TravelGo';
$custom_css = '../css/update_profile.css';
include '../includes/header.php'; 
?>

<!-- Profile Update Form -->
<main class="tg-content" style="padding-top: 100px;">
    <div class="tg-profile-container">
        <form id="profileForm" class="tg-profile-form" method="POST" action="update_profile.php" enctype="multipart/form-data">
            <h2 class="text-center mb-4">Update Profile</h2>

            <div class="tg-form-group mb-3">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" class="form-control" placeholder="Enter your full name">
            </div>

            <div class="tg-form-group mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control" placeholder="Enter your email">
            </div>

            <div class="tg-form-group mb-3">
                <label for="password">New Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password" placeholder="Enter new password" class="form-control">
            </div>

            <div class="tg-form-group mb-4">
                <label for="profilePicture">Profile Picture</label>
                <input type="file" id="profilePicture" name="profilePicture" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            <a href="profile.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
        </form>
    </div>
</main>

<footer class="footer mt-5">
    <div class="container text-center">
        <p>&copy; 2025 TravelGo | All Rights Reserved</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
