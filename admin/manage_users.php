<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'database.php';

// Handle user deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully.'); window.location.href='manage_users.php';</script>";
    }
    $stmt->close();
}

// Fetch Users
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-users text-primary me-2"></i> Manage Users</h2>
    </div>

    <!-- User Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Profile</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?php echo $row['id']; ?></td>
                                    <td>
                                        <?php 
                                        $img = !empty($row['profile_image']) ? '../' . $row['profile_image'] : '../images/profile/default.jpg';
                                        ?>
                                        <img src="<?php echo htmlspecialchars($img); ?>" alt="Profile" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                    </td>
                                    <td class="fw-bold text-dark"><?php echo htmlspecialchars($row['fullname'] ?? $row['username'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td class="text-end pe-4">
                                        <a href="manage_users.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fas fa-trash-alt"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
