<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'database.php';

// Check if reviews table exists
$table_check = $conn->query("SHOW TABLES LIKE 'reviews'");
$reviews_exist = $table_check->num_rows > 0;

$result = null;
if ($reviews_exist) {
    // Handle review deletion
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);
        $delete_sql = "DELETE FROM reviews WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            echo "<script>alert('Review deleted successfully.'); window.location.href='reviews.php';</script>";
        }
        $stmt->close();
    }
    
    // Fetch Reviews
    $sql = "SELECT * FROM reviews ORDER BY id DESC";
    $result = $conn->query($sql);
}
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-star text-warning me-2"></i> User Reviews</h2>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Reviewer Name</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($reviews_exist && $result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?php echo $row['id']; ?></td>
                                    <td class="fw-bold text-dark">
                                        <?php echo htmlspecialchars($row['user_name'] ?? 'Anonymous'); ?><br>
                                        <small class="text-muted fw-normal">Package: <?php echo htmlspecialchars($row['package_name']); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $rating = intval($row['rating'] ?? 5);
                                        for ($i = 0; $i < $rating; $i++) echo '<i class="fas fa-star text-warning"></i>';
                                        for ($i = $rating; $i < 5; $i++) echo '<i class="far fa-star text-warning"></i>';
                                        ?>
                                    </td>
                                    <td><small class="text-muted"><?php echo htmlspecialchars($row['review_text'] ?? 'No comment provided.'); ?></small></td>
                                    <td class="text-end pe-4">
                                        <a href="reviews.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this review?');"><i class="fas fa-trash-alt"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <?php echo !$reviews_exist ? 'Reviews table does not exist in the database.' : 'No reviews found.'; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
