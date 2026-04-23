<?php
if(isset($conn)) {
    $contactQuery = "SELECT * FROM contact_info LIMIT 1";
    $contactResult = $conn->query($contactQuery);
    if($contactResult && $contactResult->num_rows > 0) {
        $contact = $contactResult->fetch_assoc();
    }
}
?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>About Us</h5>
                <p>Explore the world with TravelGo. We curate unique travel experiences that bring joy and adventure to your journeys.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="package.php">Packages</a></li>
                    <li><a href="booking.php">Book Now</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>Email: <?php echo isset($contact['email']) ? htmlspecialchars($contact['email']) : 'info@travelgo.com'; ?></p>
                <p>Phone: <?php echo isset($contact['phone']) ? htmlspecialchars($contact['phone']) : '+123 456 7890'; ?></p>
                <p>Follow Us: 
                    <a href="<?php echo isset($contact['facebook_link']) ? htmlspecialchars($contact['facebook_link']) : '#'; ?>" target="_blank">Facebook</a> | 
                    <a href="<?php echo isset($contact['instagram_link']) ? htmlspecialchars($contact['instagram_link']) : '#'; ?>" target="_blank">Instagram</a>
                </p>
            </div>
        </div>
        <div class="text-center mt-4">
            <hr> <p>&copy; 2025 TravelGo | All Rights Reserved</p> <hr>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
