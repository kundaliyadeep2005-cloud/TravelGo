<!-- Sidebar -->
<nav class="sidebar flex-shrink-0 shadow-sm" style="width: 260px; overflow-y: auto;">
    <div class="p-3">
        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
        <ul class="nav flex-column gap-2 mt-2">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="manage_packages.php" class="nav-link <?php echo ($current_page == 'manage_packages.php') ? 'active' : ''; ?>"><i class="fas fa-box-open"></i> Packages</a>
            </li>
            <li class="nav-item">
                <a href="manage_bookings.php" class="nav-link <?php echo ($current_page == 'manage_bookings.php' || $current_page == 'view_bookings.php') ? 'active' : ''; ?>"><i class="fas fa-calendar-check"></i> Bookings</a>
            </li>
            <li class="nav-item">
                <a href="manage_users.php" class="nav-link <?php echo ($current_page == 'manage_users.php') ? 'active' : ''; ?>"><i class="fas fa-users"></i> Users</a>
            </li>
            <li class="nav-item">
                <a href="payments.php" class="nav-link <?php echo ($current_page == 'payments.php') ? 'active' : ''; ?>"><i class="fas fa-credit-card"></i> Payments</a>
            </li>
            <li class="nav-item">
                <a href="reviews.php" class="nav-link <?php echo ($current_page == 'reviews.php') ? 'active' : ''; ?>"><i class="fas fa-star"></i> Reviews</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Main Content Wrapper Starts Here (Closed in footer) -->
<main class="main-content bg-light">
