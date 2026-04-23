<?php
$servername = "localhost"; // or your server IP
$username = "root"; // your DB username
$password = ""; // your DB password (leave empty if using XAMPP default)
$dbname = "travelgo_db"; // ensure this is correct
$port = 3306; // your MySQL port

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
