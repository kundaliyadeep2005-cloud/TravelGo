<?php
session_start();
include 'db.php'; 

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: sign-in.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch user details
$query = "SELECT fullname, email, profile_image FROM users WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($fullname, $email, $profile_image);
$stmt->fetch();
$stmt->close();
?>

<?php 
$page_title = 'User Profile | TravelGo';
$custom_css = '../css/profile.css';
include '../includes/header.php'; 
?>

<?php
// Ensure profile image is properly assigned; check if file exists
$profile_image_path = (!empty($profile_image) && file_exists("../" . $profile_image)) ? htmlspecialchars("../" . $profile_image) : '../images/profile/default.jpg';

// Escape user details to prevent XSS attacks
$fullname = isset($fullname) ? htmlspecialchars($fullname) : 'Unknown User';
$email = isset($email) ? htmlspecialchars($email) : 'No Email Provided';
?>

<!-- Profile Section -->
<div class="profile-page-wrapper">
    <div class="container">
        <div class="profile-container" style="margin: 0 auto; max-width: 450px; background: #fff; padding: 50px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.15); text-align: center;">
            <?php 
            $final_image = (!empty($profile_image) && file_exists("../" . $profile_image)) ? "../" . $profile_image : '../images/profile/default.jpg';
            ?>
            <img src="<?php echo htmlspecialchars($final_image); ?>" 
                 alt="Profile Photo" class="profile-photo mx-auto" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin-bottom: 20px; border: 3px solid #f8f9fa;">

            <div class="user-info mt-3">
                <h4 style="font-weight: bold;"><?php echo $fullname; ?></h4>
                <p class="text-muted"><?php echo $email; ?></p>
            </div>

            <div class="d-grid gap-2 mt-4">
                <a href="update_profile.php" class="btn btn-primary" style="border-radius: 20px; background-color: #f76c5e; border: none; padding: 10px;">Update Profile</a>
                <a href="logout.php" class="btn btn-danger" style="border-radius: 20px; padding: 10px;">Logout</a>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
