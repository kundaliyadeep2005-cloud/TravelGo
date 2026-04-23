<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'database.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $image_name = '';

    if (empty($name) || empty($price) || empty($description)) {
        $error = "Please fill in all required fields.";
    } else {
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $file_info = pathinfo($_FILES['image']['name']);
            $file_ext = strtolower($file_info['extension']);
            
            if (in_array($file_ext, $allowed_ext)) {
                $new_filename = 'package_' . time() . '.' . $file_ext;
                $upload_path = '../images/packages/' . $new_filename;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    $image_name = $new_filename; // Save just the filename to match the DB convention
                } else {
                    $error = "Failed to upload image. Please check directory permissions.";
                }
            } else {
                $error = "Invalid image format. Only JPG, PNG, GIF, and WEBP are allowed.";
            }
        } else {
            $error = "Please select an image for the package.";
        }

        // Insert into database if no errors
        if (empty($error)) {
            $sql = "INSERT INTO packages (name, price, description, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sdss", $name, $price, $description, $image_name);
                if ($stmt->execute()) {
                    $success = "Package added successfully!";
                    echo "<script>setTimeout(function(){ window.location.href = 'manage_packages.php'; }, 1500);</script>";
                } else {
                    $error = "Database error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Database error: " . $conn->error;
            }
        }
    }
}
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-plus-circle text-primary me-2"></i> Add New Package</h2>
        <a href="manage_packages.php" class="btn btn-secondary rounded-pill shadow-sm"><i class="fas fa-arrow-left"></i> Back to Packages</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="add_package.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Package Name / Destination <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="e.g., Paris Getaway" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold">Price per Person (₹) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">₹</span>
                                <input type="number" step="0.01" class="form-control form-control-lg" id="price" name="price" placeholder="e.g., 15000" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the wonderful experience..." required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Package Cover Image <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                            <div class="form-text">For best results, use a high-quality landscape image.</div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm"><i class="fas fa-save"></i> Save Package</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
