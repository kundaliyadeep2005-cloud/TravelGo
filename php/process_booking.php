<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    die("Error: Unauthorized access.");
}
include 'db.php';

// Validate & Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$packageDuration = isset($_POST['packageDuration']) ? trim($_POST['packageDuration']) : '';
$packageName = isset($_POST['packageName']) ? trim($_POST['packageName']) : '';
$guests = isset($_POST['guests']) ? trim($_POST['guests']) : '';
$startDate = isset($_POST['startDate']) ? trim($_POST['startDate']) : '';
$endDate = isset($_POST['endDate']) ? trim($_POST['endDate']) : '';

// Check if required fields are empty
if (empty($name) || empty($email) || empty($phone) || empty($packageDuration) || empty($packageName) || empty($guests) || empty($startDate) || empty($endDate)) {
    die("Error: All fields are required.");
}

// Check if the booking already exists
$checkQuery = "SELECT * FROM bookings WHERE email = ? AND start_date = ?";
$stmt = $conn->prepare($checkQuery);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("ss", $email, $startDate);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Error: You have already booked this package.";
} else {
    // **Verify column name before inserting**
    $columnQuery = "SHOW COLUMNS FROM bookings LIKE 'package_name'";
    $columnResult = $conn->query($columnQuery);

    if ($columnResult->num_rows == 0) {
        die("Error: Column 'package_name' does not exist in the database. Please check your table structure.");
    }

    // Insert new booking
    $insertQuery = "INSERT INTO bookings (name, email, phone, package_duration, package_name, guests, start_date, end_date) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($insertQuery);
    
    if (!$stmt) {
        die("Error preparing insert statement: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $name, $email, $phone, $packageDuration, $packageName, $guests, $startDate, $endDate);

    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
