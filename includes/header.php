<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'TravelGo'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php if(isset($custom_css)) { echo '<link rel="stylesheet" href="'.$custom_css.'">'; } ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="home.php">TravelGo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'home.php') ? 'active' : ''; ?>" href="home.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'package.php') ? 'active' : ''; ?>" href="package.php">Packages</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'booking.php') ? 'active' : ''; ?>" href="booking.php">Book Now</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'our-story.php') ? 'active' : ''; ?>" href="our-story.php">Our Story</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($current_page == 'past_booking.php') ? 'active' : ''; ?>" href="past_booking.php">Past Bookings</a></li>
                <?php endif; ?>
            </ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn btn-outline-light ms-3 btn-sm">Logout</a>
            <?php else: ?>
                <a href="sign-in.php" class="btn btn-outline-light ms-3 btn-sm">Sign-Up/Sign-in</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
