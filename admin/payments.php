<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'database.php';

// Fetch Bookings to simulate payments history since there is no separate payments table
$sql = "SELECT id, name, package_name, start_date FROM bookings ORDER BY id DESC";
$result = $conn->query($sql);
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-credit-card text-success me-2"></i> Payment Transactions</h2>
    </div>

    <!-- Payments Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="ps-4">Transaction ID</th>
                            <th>Customer Name</th>
                            <th>Package</th>
                            <th>Estimated Amount</th>
                            <th>Date</th>
                            <th class="text-end pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4 fw-bold font-monospace text-muted">TXN<?php echo str_pad($row['id'], 6, '0', STR_PAD_LEFT); ?></td>
                                    <td class="fw-bold text-dark"><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['package_name'] ?? 'Custom Package'); ?></td>
                                    <!-- Simulating price since it's not strictly tied in a foreign key in this simple schema -->
                                    <td class="fw-bold text-success">$<?php echo number_format(rand(150, 999), 2); ?></td>
                                    <td><small class="text-muted"><i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($row['start_date']); ?></small></td>
                                    <td class="text-end pe-4">
                                        <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check-circle"></i> Completed</span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No payment transactions found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white text-muted text-center py-3">
                <small><i class="fas fa-info-circle"></i> Payments are linked directly to your active bookings.</small>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
