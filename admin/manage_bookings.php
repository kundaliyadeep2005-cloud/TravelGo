<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'database.php';

// Handle booking deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('Booking deleted successfully.'); window.location.href='manage_bookings.php';</script>";
    }
    $stmt->close();
}

// Fetch Bookings
$sql = "SELECT * FROM bookings ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-calendar-check text-primary me-2"></i> Manage Bookings</h2>
    </div>

    <!-- Booking Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Customer Info</th>
                            <th>Package Name</th>
                            <th>Dates</th>
                            <th>Guests</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?php echo $row['id']; ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($row['name']); ?></div>
                                        <div class="text-muted small"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($row['email']); ?></div>
                                        <div class="text-muted small"><i class="fas fa-phone"></i> <?php echo htmlspecialchars($row['phone']); ?></div>
                                    </td>
                                    <td><span class="badge bg-info text-dark rounded-pill px-3 py-2"><?php echo htmlspecialchars($row['package_name'] ?? 'N/A'); ?></span></td>
                                    <td>
                                        <div class="small"><span class="fw-bold text-success">In:</span> <?php echo htmlspecialchars($row['start_date'] ?? 'N/A'); ?></div>
                                        <div class="small"><span class="fw-bold text-danger">Out:</span> <?php echo htmlspecialchars($row['end_date'] ?? 'N/A'); ?></div>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['guests'] ?? 'N/A'); ?> <i class="fas fa-user-friends text-muted"></i></td>
                                    <td class="text-end pe-4">
                                        <a href="manage_bookings.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this booking?');"><i class="fas fa-trash-alt"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No bookings found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
