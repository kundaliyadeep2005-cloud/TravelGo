<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: sign-in.php");
    exit();
}
include 'db.php';

$successMessage = '';
$errorMessage = '';

// Escape input data to prevent SQL injection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and escape form data
    $name             = $conn->real_escape_string($_POST['name']);
    $email            = $conn->real_escape_string($_POST['email']);
    $phone            = $conn->real_escape_string($_POST['phone']);
    $packageDuration  = $conn->real_escape_string($_POST['packageDuration']);
    $guests           = $conn->real_escape_string($_POST['guests']);
    $startDate        = $conn->real_escape_string($_POST['startDate']);
    $endDate          = $conn->real_escape_string($_POST['endDate']);
    $packageName      = $conn->real_escape_string($_POST['packageName']);

    // Check if the user has already booked
    $checkBookingSql = "SELECT * FROM bookings WHERE email = '$email'";
    $result = $conn->query($checkBookingSql);

    if ($result->num_rows > 0) {
        // If the user has already booked
        $errorMessage = "You have already booked a package. You cannot book again.";
    } else {
        // Insert new booking with package name
        $sql = "INSERT INTO bookings (name, email, phone, package_name, package_duration, guests, start_date, end_date)
                VALUES ('$name', '$email', '$phone', '$packageName', '$packageDuration', '$guests', '$startDate', '$endDate')";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Booking successful!";
        } else {
            $errorMessage = "Error: " . $conn->error;
        }
    }
    $conn->close();
}
?>

<?php 
$page_title = 'TravelGo - Book Now';
$custom_css = '../css/booking.css';
include '../includes/header.php'; 
?>

<main class="container mt-5 d-flex justify-content-center">
    <div class="booking-container col-md-10 col-lg-8 col-xl-7">
        <?php if ($successMessage): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <?php echo $successMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <?php echo $errorMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="booking-card animate-up">
            <div class="booking-header">
                <h2>Book Your Adventure</h2>
                <p>Fill out the form below to secure your travel package.</p>
            </div>
            <form action="booking.php" method="POST" class="booking-form-content">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="john@example.com" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="10-digit number" pattern="[0-9]{10}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="guests" class="form-label">Number of Guests</label>
                        <input type="number" id="guests" name="guests" class="form-control" min="1" max="7" placeholder="e.g. 2" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="packageName" class="form-label">Package Name</label>
                        <select id="packageName" name="packageName" class="form-select" required>
                            <option value="" disabled selected>Select a package...</option>
                            <?php
                            $selectedPkg = isset($_GET['pkg_name']) ? urldecode($_GET['pkg_name']) : '';
                            $pkgListQuery = "SELECT name FROM packages ORDER BY name ASC";
                            $pkgListResult = $conn->query($pkgListQuery);
                            if ($pkgListResult && $pkgListResult->num_rows > 0) {
                                while ($pRow = $pkgListResult->fetch_assoc()) {
                                    $pName = htmlspecialchars($pRow['name']);
                                    $isSelected = ($pRow['name'] === $selectedPkg) ? 'selected' : '';
                                    echo "<option value=\"{$pName}\" {$isSelected}>{$pName}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="packageDuration" class="form-label">Duration</label>
                        <select id="packageDuration" name="packageDuration" class="form-select" required>
                            <option value="" disabled selected>Select duration</option>
                            <option value="2">2 Days</option>
                            <option value="3">3 Days</option>
                            <option value="4">4 Days</option>
                            <option value="5">5 Days</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="startDate" class="form-label">Check-in Date</label>
                        <input type="date" id="startDate" name="startDate" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="endDate" class="form-label">Check-out Date</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-booking w-100 mt-3">Confirm Booking</button>
            </form>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
