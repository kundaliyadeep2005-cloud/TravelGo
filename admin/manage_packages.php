<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'database.php';

// Handle package deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM packages WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('Package deleted successfully.'); window.location.href='manage_packages.php';</script>";
    }
    $stmt->close();
}

// Fetch Packages
$sql = "SELECT * FROM packages ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-box-open text-primary me-2"></i> Manage Packages</h2>
        <a href="add_package.php" class="btn btn-primary rounded-pill shadow-sm"><i class="fas fa-plus"></i> Add New Package</a>
    </div>

    <!-- Packages Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Package Name</th>
                            <th>Price</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?php echo $row['id']; ?></td>
                                    <td class="fw-bold text-dark"><?php echo htmlspecialchars($row['name'] ?? $row['title'] ?? 'Unknown Package'); ?></td>
                                    <td><span class="badge bg-success text-white rounded-pill px-3 py-2">$<?php echo number_format($row['price'] ?? 0, 2); ?></span></td>
                                    <td class="text-end pe-4">
                                        <a href="manage_packages.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this package?');"><i class="fas fa-trash-alt"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">No packages found in the database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
