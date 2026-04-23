<?php 
$page = 'settings'; // Define page name for specific CSS
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
?>

<!-- Main Content Area -->
<div class="main-content">
    <div class="container mt-4">
        <div class="settings-header">
            <h2>Profile Settings</h2>
        </div>

        <!-- Profile Settings Form (Vertical Layout) -->
        <div class="row mt-4">
            <!-- Username Field -->
            <div class="col-md-12 mb-3">
                <div class="card p-3 shadow">
                    <h5>Change Username</h5>
                    <input type="text" class="form-control" placeholder="New Username" value="Admin John">
                </div>
            </div>

            <!-- Email Field -->
            <div class="col-md-12 mb-3">
                <div class="card p-3 shadow">
                    <h5>Email Address</h5>
                    <input type="email" class="form-control" placeholder="New Email Address" value="admin@example.com">
                </div>
            </div>

            <!-- Password Field -->
            <div class="col-md-12 mb-3">
                <div class="card p-3 shadow">
                    <h5>Change Password</h5>
                    <input type="password" class="form-control" placeholder="New Password">
                </div>
            </div>
        </div>

        <!-- Save Changes Button -->
        <button class="btn btn-primary">Save Changes</button>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
