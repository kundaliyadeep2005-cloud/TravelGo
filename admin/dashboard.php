<?php 
include 'includes/header.php'; 
include 'includes/sidebar.php'; 
include 'database.php'; // Required for dynamic queries

// Fetch dynamic counts from DB
// 1. Total Users
$usersQuery = "SELECT COUNT(*) as count FROM users";
$usersResult = $conn->query($usersQuery);
$totalUsers = $usersResult ? $usersResult->fetch_assoc()['count'] : 0;

// 2. Total Bookings
$bookingsQuery = "SELECT COUNT(*) as count FROM bookings";
$bookingsResult = $conn->query($bookingsQuery);
$totalBookings = $bookingsResult ? $bookingsResult->fetch_assoc()['count'] : 0;

// 3. Recent Bookings (fetch latest 5)
$recentBookingsQuery = "SELECT * FROM bookings ORDER BY id DESC LIMIT 5";
$recentBookingsResult = $conn->query($recentBookingsQuery);
?>

<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Dashboard Overview</h2>
        <span class="text-muted"><i class="fas fa-clock"></i> <?php echo date("F d, Y"); ?></span>
    </div>

    <!-- Stat Cards Row -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stat bg-primary text-white h-100 shadow-sm overflow-hidden position-relative">
                <div class="card-body p-4">
                    <h5 class="card-title text-uppercase fw-semibold mb-1 opacity-75">Total Users</h5>
                    <p class="display-5 fw-bold mb-0"><?php echo $totalUsers; ?></p>
                    <i class="fas fa-users icon-bg"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stat bg-success text-white h-100 shadow-sm overflow-hidden position-relative">
                <div class="card-body p-4">
                    <h5 class="card-title text-uppercase fw-semibold mb-1 opacity-75">Total Bookings</h5>
                    <p class="display-5 fw-bold mb-0"><?php echo $totalBookings; ?></p>
                    <i class="fas fa-calendar-check icon-bg"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stat bg-warning text-dark h-100 shadow-sm overflow-hidden position-relative">
                <div class="card-body p-4">
                    <h5 class="card-title text-uppercase fw-semibold mb-1 opacity-75">Revenue</h5>
                    <p class="display-5 fw-bold mb-0">$12,450</p>
                    <i class="fas fa-dollar-sign icon-bg"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stat bg-danger text-white h-100 shadow-sm overflow-hidden position-relative">
                <div class="card-body p-4">
                    <h5 class="card-title text-uppercase fw-semibold mb-1 opacity-75">Pending</h5>
                    <p class="display-5 fw-bold mb-0">5</p>
                    <i class="fas fa-clock icon-bg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-list text-primary me-2"></i> Recent Bookings</h5>
            <a href="manage_bookings.php" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Customer Name</th>
                            <th>Package</th>
                            <th>Dates</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($recentBookingsResult && $recentBookingsResult->num_rows > 0): ?>
                            <?php while ($row = $recentBookingsResult->fetch_assoc()): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?php echo $row['id']; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                                <?php echo strtoupper(substr($row['name'], 0, 1)); ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?php echo htmlspecialchars($row['name']); ?></div>
                                                <div class="text-muted small"><?php echo htmlspecialchars($row['email']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-info text-dark rounded-pill px-3 py-2"><?php echo htmlspecialchars($row['package_name'] ?? 'N/A'); ?></span></td>
                                    <td>
                                        <div class="small"><i class="fas fa-calendar-alt text-muted"></i> <?php echo htmlspecialchars($row['start_date'] ?? 'N/A'); ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-check-circle"></i> Confirmed</span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No recent bookings found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
