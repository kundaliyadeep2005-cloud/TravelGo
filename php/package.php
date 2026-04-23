<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: sign-in.php");
    exit();
}
include 'db.php';

// Handle review form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $package_name = $conn->real_escape_string($_POST['package_name']);
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $rating = intval($_POST['rating']);
    $review_text = $conn->real_escape_string($_POST['review_text']);

    $insertSql = "INSERT INTO reviews (package_name, user_name, rating, review_text) 
                  VALUES ('$package_name', '$user_name', $rating, '$review_text')";
    if ($conn->query($insertSql)) {
        header("Location: package.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch reviews summary
$reviewsSummary = [];
$reviewSql = "SELECT package_name, AVG(rating) as avg_rating, COUNT(*) as total_reviews FROM reviews GROUP BY package_name";
$reviewResult = $conn->query($reviewSql);

if ($reviewResult->num_rows > 0) {
    while ($row = $reviewResult->fetch_assoc()) {
        $reviewsSummary[$row['package_name']] = [
            'avg_rating' => round($row['avg_rating'], 1),
            'total_reviews' => $row['total_reviews']
        ];
    }
}

// Fetch latest reviews
$latestReviews = [];
$fetchLatestReviews = "SELECT * FROM reviews ORDER BY id DESC LIMIT 100"; 
$latestResult = $conn->query($fetchLatestReviews);

if ($latestResult->num_rows > 0) {
    while ($row = $latestResult->fetch_assoc()) {
        $package = $row['package_name'];
        if (!isset($latestReviews[$package])) {
            $latestReviews[$package] = [];
        }
        if (count($latestReviews[$package]) < 3) {
            $latestReviews[$package][] = $row;
        }
    }
}
?>

<style>
    .review-item {
        background: #f8f9fa;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
    }
    .star {
        color: gold;
    }
</style>
<?php 
$page_title = 'TravelGo - Packages';
$custom_css = '../css/package.css';
include '../includes/header.php'; 
?>

<br><br><br>

<div class="text-center">
    <h1 class="heading-box">Our Packages</h1>   
</div><br>

<!-- Search and Filter Form (Centered with Increased Breadth and Max Price) -->
<div class="container mb-4 d-flex justify-content-center">
    <form method="GET" class="row g-3 justify-content-center w-75">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control form-control-lg" placeholder="Search by package name..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        </div>
        <div class="col-md-2">
            <input type="number" name="min_rating" class="form-control form-control-lg" placeholder="Min Rating (1-5)" min="1" max="5" value="<?= isset($_GET['min_rating']) ? htmlspecialchars($_GET['min_rating']) : '' ?>">
        </div>
        <div class="col-md-2">
            <input type="number" name="max_price" class="form-control form-control-lg" placeholder="Max Price" min="1" value="<?= isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : '' ?>">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary btn-lg">Apply Filters</button>
        </div>
        <div class="col-md-2 d-grid">
            <a href="package.php" class="btn btn-secondary btn-lg">Reset</a>
        </div>
    </form>
</div>


<!-- Packages -->
<div class="container">
    <div class="row">

<?php
// Fetch all packages from the database
$dbPackages = [];
$packageQuery = "SELECT * FROM packages";
$pkgResult = $conn->query($packageQuery);
if ($pkgResult && $pkgResult->num_rows > 0) {
    while ($row = $pkgResult->fetch_assoc()) {
        $dbPackages[] = [
            $row['name'], 
            $row['price'], 
            $row['image'],
            $row['id'] // ID for booking linking
        ];
    }
}

// Get filter values
$searchTerm = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$minRating = isset($_GET['min_rating']) && $_GET['min_rating'] !== '' ? floatval($_GET['min_rating']) : 0;
$maxPrice = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? floatval($_GET['max_price']) : PHP_INT_MAX;


$filteredPackages = [];

foreach ($dbPackages as $package) {
    $packageName = $package[0];
    $price = $package[1];

    $matchesSearch = $searchTerm === '' || strpos(strtolower($packageName), $searchTerm) !== false;
    $matchesRating = true;
    if ($minRating > 0) {
        $avgRating = isset($reviewsSummary[$packageName]) ? $reviewsSummary[$packageName]['avg_rating'] : 0;
        $matchesRating = $avgRating >= $minRating;
    }
    $matchesPrice = $price <= $maxPrice;

    if ($matchesSearch && $matchesRating && $matchesPrice) {
        $filteredPackages[] = $package;
    }
}

if (empty($filteredPackages)) {
    echo "<div class='col-12 text-center'><p class='text-muted fs-4'>No packages found matching your criteria in the database.</p></div>";
}

foreach ($filteredPackages as $package) {
    $packageName = $package[0];
    $price = $package[1];
    $image = $package[2];
    $packageId = $package[3];

    $avgRating = isset($reviewsSummary[$packageName]) ? $reviewsSummary[$packageName]['avg_rating'] : "No ratings";
    $totalReviews = isset($reviewsSummary[$packageName]) ? $reviewsSummary[$packageName]['total_reviews'] : "0";

    // Extract just the filename (e.g. package1.jpg) and prepend the correct directory
    $filename = basename($image);
    $imgPath = "../images/packages/{$filename}";

    echo "
    <div class='col-md-6 mb-4'>
        <div class='card package-card h-100 shadow-sm'>
            <img src='{$imgPath}' class='card-img-top' alt='{$packageName}' style='height: 250px; object-fit: cover;'>
            <div class='card-body d-flex flex-column'>
                <h5 class='card-title fw-bold'>{$packageName} - ₹" . number_format($price) . " per person</h5>
                <p class='mb-2'><strong>Rating:</strong> " . (is_numeric($avgRating) ? str_repeat('⭐', round($avgRating)) . " ({$avgRating})" : $avgRating) . "</p>
                <p class='mb-3 text-muted small'><strong>Reviews:</strong> {$totalReviews}</p>

                <h6 class='fw-bold'>Package Includes:</h6>
                <ul class='text-muted small'>
                    <li>Transportation</li>
                    <li>Accommodations</li>
                    <li>Meals</li>
                    <li>Activities & Attractions</li>
                    <li>Travel Insurance</li>
                </ul>
                <a href='booking.php?pkg_name=" . urlencode($packageName) . "' class='btn btn-success w-100 mb-2 mt-auto fw-bold'>Book Now</a>

                <button class='btn btn-outline-primary w-100 fw-bold mb-3' data-bs-toggle='modal' data-bs-target='#reviewModal' data-package='{$packageName}'>Write a Review</button>

                <div class='mt-2 border-top pt-3'>
                    <h6 class='fw-bold'>Recent Reviews:</h6>";

                    if (isset($latestReviews[$packageName])) {
                        foreach ($latestReviews[$packageName] as $review) {
                            echo "
                            <div class='review-item shadow-sm border border-light'>
                                <strong>" . htmlspecialchars($review['user_name']) . "</strong> <span class='text-warning'>" . str_repeat('⭐', $review['rating']) . "</span> <br>
                                <small class='text-muted'>" . htmlspecialchars($review['review_text']) . "</small>
                            </div>";
                        }
                    } else {
                        echo "<p class='text-muted small'>No reviews yet. Be the first to review!</p>";
                    }

                echo "</div>
            </div>
        </div>
    </div>";
}
?>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
          <div class="modal-header">
              <h5 class="modal-title">Write a Review</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="package_name" id="package_name">
              <div class="mb-3">
                  <input type="text" name="user_name" class="form-control" placeholder="Your Name" required>
              </div>
              <div class="mb-3">
                  <input type="number" name="rating" class="form-control" placeholder="Rating (1-5)" min="1" max="5" required>
              </div>
              <div class="mb-3">
                  <textarea name="review_text" class="form-control" rows="3" placeholder="Write your review..." required></textarea>
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" name="submit_review" class="btn btn-primary">Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
<script>
    // Set the package name dynamically for the review modal
    var reviewButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    reviewButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var packageName = this.getAttribute('data-package');
            document.getElementById('package_name').value = packageName;
        });
    });
</script>
