<?php
// Database connection
include 'db.php';

// Fetch all sections from the our_story table
$sql = "SELECT * FROM our_story ORDER BY id"; // Sort by ID instead of section
$result = $conn->query($sql);




$our_story_data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $our_story_data[] = $row;
    }
}
?>

<?php 
$page_title = 'Our Story - TravelGo';
$custom_css = '../css/our-story.css';
include '../includes/header.php'; 
?>
<br>

<!-- About Us Section -->
<section class="about-us py-5">
    <div class="container">
        <?php
        foreach ($our_story_data as $about) {
            if ($about['section'] == 'About Us') {
                echo '<h2 class="text-center mb-4">' . $about['title'] . '</h2>';
                echo '<p class="text-center mb-5">' . $about['content'] . '</p>';
            }
        }
        ?>
        <div class="row">
            <?php
            foreach ($our_story_data as $feature) {
                if ($feature['section'] == 'Features') {
                    echo '<div class="col-md-6 col-lg-3 mb-4">
                            <div class="info-box p-4 text-center shadow-sm">
                                <h4>' . $feature['title'] . '</h4>
                                <p>' . $feature['content'] . '</p>
                            </div>
                          </div>';
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Next Adventure Section -->
<section class="next-adventure py-5">
    <div class="container text-center">
        <?php
        foreach ($our_story_data as $adventure) {
            if ($adventure['section'] == 'Next Adventure') {
                echo '<h2 class="display-4 mb-4">' . $adventure['title'] . '</h2>';
                echo '<p class="mb-4">' . $adventure['content'] . '</p>';
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="package.php" class="btn btn-success btn-lg">' . $adventure['extra_info'] . '</a>';
                }
            }
        }
        ?>
    </div>
</section>

<?php include '../includes/footer.php'; ?>

<?php
// Close database connection
$conn->close();
?>
