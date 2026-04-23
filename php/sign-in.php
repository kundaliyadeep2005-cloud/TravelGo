<?php
ob_start();
session_start();
include 'db.php';

$error = ""; // Variable to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT id, fullname, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $fullname, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["fullname"] = $fullname;
            $_SESSION["email"] = $email;
            
            // Debugging Step 1: Check if the script reaches here
            echo "Redirecting..."; 
            
            // Ensure no output before redirection
            ob_clean();
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid password! Please try again.";
        }
    } else {
        $error = "Email not found! Please check your email or sign up.";
    }

    $stmt->close();
}

$conn->close();
ob_end_flush();
?>



<?php 
$page_title = 'Sign In - TravelGo';
$custom_css = '../css/sign-in.css';
include '../includes/header.php'; 
?>

    <!-- Centered Form -->
    <main class="tg-content">
        <div class="tg-signin-container">
        <form id="sign-in.php" action="sign-in.php" method="POST">
        <center><h2>Sign In</h2></center><br>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="tg-form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control">
        <div id="emailError" style="color: red; display: none;"></div> <!-- Error message container -->
    </div>

    <div class="tg-form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control">
        <div id="passwordError" style="color: red; display: none;"></div> <!-- Error message container -->
    </div>

    <button type="submit" class="tg-btn-primary btn btn-primary w-100">Sign In</button>

    <div class="text-center mt-3">
        Don't have an account? 
        <a href="sign-up.php" class="tg-signup-link">Sign Up</a> / 
        <a href="http://localhost/sem-6/admin/login.php" class="tg-signup-link">Admin</a>
    </div>

    <div class="text-center mt-3">
        <p>Forgot password? <a href="forget.php" class="tg-signup-link">Reset here</a></p>
    </div>
</form>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/sign-in.js"></script>

</body>
<?php include '../includes/footer.php'; ?>
<script src="js/sign-in.js"></script>
