<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: sign-in.php");
    exit();
}
?>

<?php
$page_title = 'Past Bookings | TravelGo';
$custom_css = '../css/package.css';
include '../includes/header.php';
?>

<br><br><br>

<div class="text-center">
    <h1 class="best-places-heading">My Past Bookings</h1>
</div><br>

<div class="container">
    <div class="row">

        <!-- Booking Card 1 -->
        <div class="col-md-4 mb-4">
            <div class="horizontal-card">
                <img src="../images/packages/package1.jpg" class="card-img-top" alt="Shimla Tour">
                <div class="card-body">
                    <h5 class="card-title">Shimla Tour Package, India</h5>
                    <p class="card-text">Duration: 5 Days | Guests: 2 | ₹5,000</p>
                    <p class="card-text"><small>Date: 15 Jan 2025 – 20 Jan 2025</small></p>
                    <span class="badge bg-success">Confirmed</span>
                </div>
            </div>
        </div>

        <!-- Booking Card 2 -->
        <div class="col-md-4 mb-4">
            <div class="horizontal-card">
                <img src="../images/packages/package13.jpg" class="card-img-top" alt="Goa">
                <div class="card-body">
                    <h5 class="card-title">Goa, India</h5>
                    <p class="card-text">Duration: 4 Days | Guests: 3 | ₹9,000</p>
                    <p class="card-text"><small>Date: 5 Mar 2025 – 9 Mar 2025</small></p>
                    <span class="badge bg-success">Confirmed</span>
                </div>
            </div>
        </div>

        <!-- Booking Card 3 -->
        <div class="col-md-4 mb-4">
            <div class="horizontal-card">
                <img src="../images/packages/package20.jpg" class="card-img-top" alt="Taj Mahal">
                <div class="card-body">
                    <h5 class="card-title">Taj Mahal, Agra, India</h5>
                    <p class="card-text">Duration: 3 Days | Guests: 2 | ₹11,000</p>
                    <p class="card-text"><small>Date: 10 Apr 2025 – 13 Apr 2025</small></p>
                    <span class="badge bg-warning text-dark">Upcoming</span>
                </div>
            </div>
        </div>

        <!-- Booking Card 4 -->
        <div class="col-md-4 mb-4">
            <div class="horizontal-card">
                <img src="../images/packages/package15.jpg" class="card-img-top" alt="Kedarnath">
                <div class="card-body">
                    <h5 class="card-title">Kedarnath Temple, Uttarakhand</h5>
                    <p class="card-text">Duration: 6 Days | Guests: 4 | ₹12,000</p>
                    <p class="card-text"><small>Date: 20 May 2025 – 26 May 2025</small></p>
                    <span class="badge bg-secondary">Pending</span>
                </div>
            </div>
        </div>

        <!-- Booking Card 5 -->
        <div class="col-md-4 mb-4">
            <div class="horizontal-card">
                <img src="../images/packages/package17.jpg" class="card-img-top" alt="Andaman">
                <div class="card-body">
                    <h5 class="card-title">Andaman and Nicobar Islands</h5>
                    <p class="card-text">Duration: 7 Days | Guests: 2 | ₹9,000</p>
                    <p class="card-text"><small>Date: 1 Jun 2025 – 8 Jun 2025</small></p>
                    <span class="badge bg-success">Confirmed</span>
                </div>
            </div>
        </div>

        <!-- Booking Card 6 -->
        <div class="col-md-4 mb-4">
            <div class="horizontal-card">
                <img src="../images/packages/package2.jpg" class="card-img-top" alt="Kerala">
                <div class="card-body">
                    <h5 class="card-title">Alappuzha Backwaters, Kerala</h5>
                    <p class="card-text">Duration: 5 Days | Guests: 2 | ₹10,000</p>
                    <p class="card-text"><small>Date: 12 Jul 2025 – 17 Jul 2025</small></p>
                    <span class="badge bg-success">Confirmed</span>
                </div>
            </div>
        </div>

    </div><!-- end row -->

    <div class="text-center mt-4 mb-5">
        <a href="package.php" class="btn btn-primary" style="border-radius: 30px; padding: 12px 35px; background-color: #f76c5e; border: none; font-size: 16px; text-transform: uppercase;">Book More Packages</a>
    </div>

</div><!-- end container -->

<?php include '../includes/footer.php'; ?>
