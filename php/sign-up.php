<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hashing Password

    // Default Profile Image
    $profile_image = "../images/profile/default.jpg"; 

    // Handling File Upload (Profile Photo)
    if (isset($_FILES["profilePhoto"]) && $_FILES["profilePhoto"]["error"] === 0) {
        $upload_dir = "uploads/profile_pictures/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_ext = strtolower(pathinfo($_FILES["profilePhoto"]["name"], PATHINFO_EXTENSION));
        $allowed_exts = ["jpg", "jpeg", "png", "gif"];

        if (in_array($file_ext, $allowed_exts)) {
            $new_file_name = "profile_" . time() . "." . $file_ext;
            $target_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $target_path)) {
                $profile_image = $target_path; // Store the image path in the database
            }
        }
    }

    // Check if the email already exists in the database
    $sql_check = "SELECT * FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // If email already exists, show an error message
        echo "<script>alert('Error: Email already exists!');</script>";
    } else {
        // Insert Data into Database (Fixed column name from `profile_photo` to `profile_image`)
        $sql = "INSERT INTO users (fullname, email, password, profile_image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $email, $password, $profile_image);

        if ($stmt->execute()) {
            // Redirect to sign-in page directly
            header("Location: sign-in.php");
            exit(); // Ensure script stops execution after redirection
        } else {
            echo "<script>alert('Error: Issue in registration!');</script>";
        }
        

        $stmt->close();
    }

    $stmt_check->close();
}
$conn->close();
?>


<?php 
$page_title = 'Sign Up - TravelGo';
$custom_css = '../css/sign-up.css';
include '../includes/header.php'; 
?>
<main class="tg-content">
    <div class="tg-signup-container">
    <form id="sign-up.php" action="sign-up.php" method="POST" enctype="multipart/form-data">
    <center><h2>Sign Up</h2></center><br>

    <div class="tg-form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your full name">
        <span id="fullnameError" class="text-danger" style="display: none;"></span>
    </div>

    <div class="tg-form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
        <span id="emailError" class="text-danger" style="display: none;"></span>
    </div>

    <div class="tg-form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
        <span id="passwordError" class="text-danger" style="display: none;"></span>
    </div>

    <div class="tg-form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your password">
        <span id="confirmPasswordError" class="text-danger" style="display: none;"></span>
    </div>

    <div class="tg-form-group">
        <label for="profilePhoto">Choose Profile Photo</label>
        <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" class="form-control" placeholder="Upload your profile photo">
        <span id="profilePhotoError" class="text-danger" style="display: none;"></span>
    </div>

    <button type="submit" class="tg-btn-primary btn btn-primary w-100">Sign Up</button><br><br>

    <!-- Sign In Button -->
    <a href="sign-in.php" class="tg-btn-secondary btn btn-outline-primary w-100">Already have an account? Sign In</a>
</form>

    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

<?php include '../includes/footer.php'; ?>
<script src="js/sign-up.js"></script>
